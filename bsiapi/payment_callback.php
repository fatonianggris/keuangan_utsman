<?php

require 'config.php';
header('X-Robots-Tag: noindex, nofollow');
date_default_timezone_set('Asia/Jakarta');

//debugLog($_JSON);

// PARAMATER DI BAWAH INI ADALAH VARIABEL YANG DITERIMA DARI BSI (WAJIB)
$kodeBank = $_JSON['kodeBank'];
$kodeChannel = $_JSON['kodeChannel'];
$kodeBiller = $_JSON['kodeBiller'];
$kodeTerminal = $_JSON['kodeTerminal'];
$nomorPembayaran = $_JSON['nomorPembayaran'];
$idTagihan = $_JSON['idTagihan'];
$tanggalTransaksi = $_JSON['tanggalTransaksi'];
$idTransaksi = $_JSON['idTransaksi'];
$totalNominal = $_JSON['totalNominal'];
$nomorJurnalPembukuan = $_JSON['nomorJurnalPembukuan'];
$statusValidasi = $_JSON['statusValidasi'];

// PARAMATER OPSIONAL
$nama = $_JSON['nama'];
$informasi = $_JSON['informasi'];
$rincian = $_JSON['rincian'];
$catatan = "-";

// PERIKSA APAKAH SELURUH PARAMETER SUDAH LENGKAP
if (empty($kodeBank) || empty($kodeChannel) || empty($kodeTerminal) || empty($nomorPembayaran) || empty($tanggalTransaksi) || empty($idTransaksi) || empty($totalNominal) || empty($nomorJurnalPembukuan)) {
    $response = json_encode(array(
        'status' => false,
        'msg' => 'Invalid Message Format'
    ));
    debugLog('RESPONSE: ' . $response);
    echo $response;
    exit();
}

// PERIKSA APAKAH KODE BANK DIIZINKAN MENGAKSES WEBSERVICE INI
if (!in_array($kodeBank, $allowed_collecting_agents)) {
    $response = json_encode(array(
        'status' => false,
        'msg' => 'Collecting agent is not allowed by ' . $biller_name
    ));
    debugLog('RESPONSE: ' . $response);
    echo $response;
    exit();
}

// PERIKSA APAKAH KODE CHANNEL DIIZINKAN MENGAKSES WEBSERVICE INI
if (!in_array($kodeChannel, $allowed_channels)) {
    $response = json_encode(array(
        'status' => false,
        'msg' => 'Channel is not allowed by ' . $biller_name
    ));
    debugLog('RESPONSE: ' . $response);
    echo $response;
    exit();
}

// PERIKSA APAKAH CHECKSUM VALID
if (sha1($_JSON['idTransaksi'] . $secret_key . $_JSON['tanggalTransaksi']) != $_JSON['checksum']) {
    $response = json_encode(array(
        'status' => false,
        'msg' => 'H2H Checksum is invalid'
    ));
    debugLog('RESPONSE: ' . $response);
    echo $response;
    exit();
}

//// DB CONNECT /////
$conn = mysqli_init();
$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 3);
$conn->options(MYSQLI_OPT_READ_TIMEOUT, 7);
$status = $conn->real_connect($mysql_host, $mysql_username, $mysql_password, $mysql_dbname);

if (!$status) {
    $response = json_encode(array(
        'status' => false,
        'msg' => 'MySQL NOT CONNECTED'
    ));
    debugLog('MYSQL: ' . mysqli_connect_error());
    echo $response;
    exit();
}

//// PAYMENT /////
debugLog("START PAYMENT");
try {
    if (substr($idTagihan, 0, 2) == "DU") {
        //// get th ajaran/////
        $status_ta = 1;
        $sql1 = $conn->prepare("SELECT * FROM tahun_ajaran WHERE status_tahun_ajaran=?");
        $sql1->bind_param('s', $status_ta);
        $sql1->execute();
        $result_th = $sql1->get_result();
        $data_th_ajaran = $result_th->fetch_array(MYSQLI_ASSOC);
      
        //// get data siswa/////
        $status_pembayaran = "MENUNGGU";
        $sql2 = $conn->prepare("SELECT * FROM tagihan_pembayaran_du WHERE nomor_siswa=? AND status_pembayaran=? AND id_invoice=? ORDER BY tanggal_invoice DESC LIMIT 1");
        $sql2->bind_param('sss', $nomorPembayaran, $status_pembayaran, $idTagihan);
        $sql2->execute();
        $result_cek = $sql2->get_result();
       
        if ($result_cek) {
            debugLog('CEK-DU: UPDATE');
           
            $conn->begin_transaction();
            $waktuPembayaran = date("Y-m-d H:i:s");
            
            $sql4 = $conn->prepare("UPDATE tagihan_pembayaran_du set status_pembayaran=?, nomor_jurnal_pembukuan=?, waktu_transaksi=?, channel_pembayaran=? WHERE id_invoice=?");
            $sql4->bind_param('sssss', strtoupper($statusValidasi), $nomorJurnalPembukuan, $waktuPembayaran, $kodeChannel, $idTagihan);
            $sql4->execute();
            $conn->commit();
        } else {
            
            debugLog('CEK-DU: INSERT');
            $id_invoice_du = explode("/",$idTagihan);
            $status_pembayaran_du = "SUKSES";
            
            $sql5 = $conn->prepare("SELECT * FROM tagihan_pembayaran_du WHERE nomor_siswa=? AND id_invoice=? AND status_pembayaran=? ORDER BY tanggal_invoice DESC LIMIT 1");
            $sql5->bind_param('ss', $nomorPembayaran, $id_invoice_du[0], $status_pembayaran_du);
            $sql5->execute();
            $result_pembayaran = $sql5->get_result();
           
            if($result_pembayaran){
                $data_pembayaran = $result_pembayaran->fetch_array(MYSQLI_ASSOC);
                
                $conn->begin_transaction();
               
                $sql3 = $conn->prepare("INSERT INTO tagihan_pembayaran_du(id_invoice, id_siswa, id_kelas, id_tingkat, level_tingkat, tipe_tagihan, tanggal_invoice, nomor_siswa, nama, nominal_tagihan, informasi, rincian, catatan, nomor_jurnal_pembukuan, th_ajaran, waktu_transaksi, channel_pembayaran, status_pembayaran)
                                                             VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $waktuPembayaran = date("Y-m-d H:i:s");
                $sql3->bind_param('ssssssssssssssssss', $idTagihan, $data_pembayaran['id_siswa'], $data_pembayaran['id_kelas'], $data_pembayaran['id_tingkat'], $data_pembayaran['level_tingkat'], $data_pembayaran['tipe_tagihan'], $tanggalTransaksi, $idTransaksi, $nama, $totalNominal, $informasi, $rincian, $catatan, $nomorJurnalPembukuan, $data_th_ajaran['id_tahun_ajaran'], $waktuPembayaran, $kodeChannel, strtoupper($statusValidasi));
                $sql3->execute();
                $conn->commit();
            } else {
                $response = json_encode(array(
                    'status' => false,
                    'msg' => 'Informasi gagal disimpan di dalam database'
                ));
                debugLog("DATA TIDAK DITEMUKAN: ".$id_invoice_du[0]);
                echo $response;
                exit();
            }
        }
    } else {
        
        debugLog('CEK-DPB: UPDATE');
        $conn->begin_transaction();
        $status = "SUKSES";
        $waktuPembayaran = date("Y-m-d H:i:s");
        
        $sql = $conn->prepare("UPDATE tagihan_pembayaran_dpb set status_pembayaran=?, nomor_jurnal_pembukuan=?, waktu_transaksi=?, channel_pembayaran=? WHERE id_invoice=?");
        $sql->bind_param('sssss', $status, $nomorJurnalPembukuan, $waktuPembayaran, $kodeChannel, $idTagihan);
        $sql->execute();
        $conn->commit();
    }
} catch (Exception $e) {
    $mysqli->rollback();
    $response = json_encode(array(
        'status' => false,
        'msg' => 'Informasi gagal disimpan di dalam database'
    ));
    debugLog('DB Rollback');
    echo $response;
    $conn->close();
    exit();
}

debugLog("END PAYMENT");
$response = json_encode(array(
    'status' => true,
    'msg' => 'Informasi sukses diterima dan di-update di dalam database'
));
header('Content-Type: application/json');
echo $response;
exit();
?>