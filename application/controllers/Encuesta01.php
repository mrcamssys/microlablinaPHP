<?php

defined('BASEPATH') OR exit('No direct script access allowed');


//namespace NumPHPTest\LinAlg\LinAlg;

use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP;
use NumPHP\LinAlg\LinAlg;
use NumPHP\LinAlg\LinAlg\LUDecomposition;
use NumPHPTest\Core\Framework\TestCase;
use MCordingley\LinearAlgebra\Matrix;

class Encuesta01 extends CI_Controller {

 public function index(){
 	$this->load->view('interface/head1');  

	$this->load->view('vencuesta'); 
 	$this->load->view('interface/pie1');                     
  }


}
?>













