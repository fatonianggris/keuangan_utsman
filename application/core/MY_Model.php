<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $default_db;
    protected $secondary_db;

    public function __construct()
    {
        parent::__construct();
        // Load file database.php supaya bisa baca $db array
        include APPPATH . 'config/database.php';

        // Ambil schema dari koneksi db1, misal sebagai default_db
        $this->default_db = isset($db['db1']['schema']) ? $db['db1']['schema'] : '';

        // Ambil schema dari koneksi db2, misal sebagai secondary_db
        $this->secondary_db = isset($db['db2']['schema']) ? $db['db2']['schema'] : '';

        // Jika tidak ada schema, bisa di-set default
        if (empty($this->default_db)) {
            $this->default_db = 'panel_utsman'; // default jika schema kosong
        }
        if (empty($this->secondary_db)) {
            $this->secondary_db = 'keuangan_utsman'; // default jika schema kosong
        }
    }

    // Optional: method untuk mengubah prefix secara global
    public function set_prefixes($default_db = null, $secondary_db = null)
    {
        if ($default_db !== null) {
            $this->default_db = $default_db;
        }
        if ($secondary_db !== null) {
            $this->secondary_db = $secondary_db;
        }
    }
}
