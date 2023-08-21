<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Fuente extends CI_Controller {

 public function index(){
 	$this->load->view('interface/head1');  
 	$this->load->view('interface/cabecera1');


    $this->texto['pnada']="";
//$this->texto['pnada']=$numArray;
	$this->load->view('welcome_message', $this->texto); 
 	$this->load->view('interface/pie1');                     
  }
}
?>