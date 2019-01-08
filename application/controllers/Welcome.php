<?php

defined('BASEPATH') OR exit('No direct script access allowed');


//namespace NumPHPTest\LinAlg\LinAlg;

use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP;
use NumPHP\LinAlg\LinAlg;
use NumPHP\LinAlg\LinAlg\LUDecomposition;
use NumPHPTest\Core\Framework\TestCase;
use MCordingley\LinearAlgebra\Matrix;

class Welcome extends CI_Controller {

 public function index(){
 	$this->load->view('interface/head1');  
 	$this->load->view('interface/cabecera1');

 	$numArray = new NumArray([
            [ 2,  0,    2, 0.6,0.22],
            [ 3,  3,    4,  -2,32],
            [ 5,  5,    4,   2,1],
            [-1, -2,  3.4,  -1,0],
            [ 12,  10,    112, 10.6,22],
        ]);

        
    list($pMatrix, $lMatrix, $uMatrix) = LinAlg::lud($numArray);


    $pi=LinAlg::inv($pMatrix);
    $piA=$pi->dot($numArray);
    $piAp=$piA->dot($pMatrix);

    $det=LinAlg::det($uMatrix); 


 /*$matrix = new matrix([
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8]
]);*/
    $this->texto['pnada']="<br>A ".$numArray." <br> L= ".$lMatrix."<br> U= ".$uMatrix."<br> P= ".$pMatrix."<br> Det= ";
//$this->texto['pnada']=$numArray;
	$this->load->view('welcome_message', $this->texto); 
 	$this->load->view('interface/pieporta');                     
  }


}
?>













