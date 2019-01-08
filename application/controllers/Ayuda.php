<?php

defined('BASEPATH') OR exit('No direct script access allowed');


//namespace NumPHPTest\LinAlg\LinAlg;

use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP;
use NumPHP\LinAlg\LinAlg;
use NumPHP\LinAlg\LinAlg\LUDecomposition;
use NumPHPTest\Core\Framework\TestCase;
use MCordingley\LinearAlgebra\Matrix;

class Ayuda extends CI_Controller {
    public $texto=array();
    public function index(){
        $this->load->view('interface/head1');  
    	//$this->load->view('interface/cabecera1');

        $this->texto['salida']="";
    	$this->load->view('help/helptf',$this->texto); 
     	$this->load->view('interface/pie1');                     
    }

    public function TranferFuncion(){
        $this->load->view('interface/head1');  
        $this->texto['salida']="funcion de transferencia";
        $this->load->view('help/helptf',$this->texto); 
        $this->load->view('interface/pie1');
    }

}
?>