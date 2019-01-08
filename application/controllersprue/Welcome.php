<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

 public function index(){
    $this->load->view('welcome_message');                
  }


  public function formulario(){
    $cams=$this->input->post("cams");
    echo $cams."<br>";
    $this->load->view('welcome_message'); 
  }

}
?>



