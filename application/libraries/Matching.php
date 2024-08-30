<?php

defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';

use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;

class Matching
{

    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance(); // Set variabel _ci dengan Fungsi2-fungsi dari Codeigniter
    }

    public function single_text_match($actual_text, $expected_text)
    {
        $fuzz = new Fuzz();
        $result_precentage = $fuzz->ratio($actual_text, $expected_text);

        return $result_precentage;
    }

	public function array_text_match($actual_text, $expected_text)
    {
		$fuzz = new Fuzz();
		$process = new Process($fuzz); 

        $result_precentange = $process->extract($actual_text, $expected_text, null, null, 2);

        return $result_precentange->toArray();
    }



}
