<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require './vendor/autoload.php';

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Printer_helper
{
    public function __construct()
    {
        $this->_ci = &get_instance(); // Set variabel _ci dengan Fungsi2-fungsi dari Codeigniter
    }

    public function set_printer($data)
    {
        $connector = new WindowsPrintConnector("POS58");
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Tiket Parkir\n");
        $testStr = ("SEKOLAH UTSMAN");
        $printer->feed();
        $hri = array(
            Printer::BARCODE_TEXT_BELOW => "TESTING",
        );
        foreach ($hri as $position => $caption) {
            $printer->text($caption . "\n");
            $printer->setBarcodeTextPosition($position);
            $printer->barcode($testStr, Printer::BARCODE_CODE93);
            $printer->feed();
        }
        $printer->selectPrintMode();
        $printer->text("SIMPANLAH TIKET DENGAN AMAN ");
        $printer->text("KERUSAKAN DAN KEHILANGAN BARANG BUKAN TANGGUNG JAWAB PENGELOLA");
        $printer->text("KEHILANGAN TIKET PARKIR DI KENAKAN DENDA Rp.10.000,-");
        $printer->feed();
        $printer->text("----------------------------------------\n");
        $printer->cut();
        $printer->close();
    }
}
