<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Present extends CI_Controller {

	 public function index(){
		if(isset($this->session->email)){

            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('Presentacion'); 
            $this->load->view('interface/pieporta2');  

            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('interface/cabecera1');
            $this->load->view('Presentacion'); 
            $this->load->view('interface/pieporta2');   
       }
		

	}
		

}
?>
