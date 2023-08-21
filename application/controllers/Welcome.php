<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

 public function index(){
 
   

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $this->load->model("Tabla_de_datos");

        $texto['usuario']=$this->Tabla_de_datos->extraer_nombreuser();
        $this->load->view('welcome_message_usaer',$texto);
        $this->load->view('logeado/ehtml');  
        if($this->input->get('logout')=='ok'){
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }else{
        $this->load->view('interface/head1');  
        $this->load->view('interface/cabecera1');
        $this->load->view('welcome_message');
        $this->load->view('interface/pieporta');     
	}                   
  }
}
?>