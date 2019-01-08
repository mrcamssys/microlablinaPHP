<?php
if (!defined('BASEPATH'))   exit('No direct script access allowed');
class Error404 extends CI_Controller { 
   public function index(){
   	echo "no veo nada";
    $this->load->view('interface/head1');  
	$this->load->view('404'); 
 	$this->load->view('interface/pie1');
   }
}