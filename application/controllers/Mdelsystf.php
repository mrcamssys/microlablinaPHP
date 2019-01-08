
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mdelsystf extends CI_Controller {

 public function index(){
 	$this->load->view('interface/head1');  
 	$this->load->view('modelosTF/modelos');


 	$this->load->view('interface/pie1');                     
  }


}
?>