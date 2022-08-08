<?php

header('X-Robots-Tag: noindex, nofollow');
date_default_timezone_set('Asia/Jakarta');

$biller_name = 'SEKOLAH UTSMAN'; // UBAH VARIABEL INI
$secret_key = 'Ut5m4nxWeQSDEraxvftnabsyeirytcnsaVBFSH'; // UBAH VARIABEL INI
$mysql_host = 'localhost'; // UBAH VARIABEL INI
$mysql_username = 'u8514965_panel'; // UBAH VARIABEL INI
$mysql_password = '9wgO+0t#?%'; // UBAH VARIABEL INI
$mysql_dbname = 'u8514965_panel_utsman'; // UBAH VARIABEL INI

$allowed_collecting_agents = array('BSM');
$allowed_channels = array('TELLER', 'IBANK', 'ATM', 'MBANK', 'FLAGGING');
$log_directory = './logs/'; // Direktori ini harus bisa ditulis oleh Apache PHP user

function debugLog($o) {
// Fungsi ini untuk menulis seluruh log ke File
    $file_debug = $GLOBALS['log_directory'] . 'debug-h2h-' . date("Y-m-d") . '.log.txt';
    ob_start();
    var_dump(date("Y-m-d H:i:s"));
    var_dump($o);
    $c = ob_get_contents();
    ob_end_clean();
    $f = fopen($file_debug, "a");
    fputs($f, "$c\n");
    fflush($f);
    fclose($f);
}

function clearLog() {
    // Fungsi ini untuk clear log
    $file_debug = $GLOBALS['log_directory'] . 'debug-h2h-' . date("Y-m-d") . '.log.txt';
    file_put_contents($file_debug, "") or die("Could not clear file!");
}

$request = file_get_contents('php://input');
debugLog('REQUEST_CONFIG: ' . $request);
$_JSON = json_decode($request, true);
?>