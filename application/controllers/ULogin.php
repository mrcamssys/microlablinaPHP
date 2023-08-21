<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class ULogin extends CI_Controller {
  public $texto;
    public function __construct(){
         parent::__construct();
    }

    
 public function index(){
  $this->texto['error']=0;
     $this->texto['tipo']="";
    $this->texto['mensaje']="";
  

       if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');

            $this->load->view('actualizar',   $this->texto); 

            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('login',   $this->texto); 
            $this->load->view('interface/pie1');    
        }   





                  
  }

  public function entrar(){
  	 if(isset($_POST['password'])){
    	$this->load->model("Tabla_de_datos");
    	if($this->Tabla_de_datos->logr($_POST['username'],md5($_POST['password']))) {
    		$this->session->email=$_POST['username'];
    		$loger=array('estado'=>1);
    		echo json_encode($loger);
    	}else{
    		$loger=array('estado'=>0);
    		echo json_encode($loger);
    	} 
 	}
  }

  public function registrar(){
    $correo=trim($this->input->post("email"));
    $nombre=ucfirst($this->input->post("nombre"));
    $apellido=ucfirst($this->input->post("apellido"));
    $cargo=$this->input->post("cargo");
    $clave1=$this->input->post("clave1");
    $clave2=$this->input->post("clave2");
    $institucion=$this->input->post("institucion");

    if(empty($correo)||empty($nombre)||empty($apellido)||empty($cargo)||empty($clave1)||empty($clave2)||empty($institucion)){
            $this->texto['error']=1;
            $this->texto['tipo']='Error ';
            $this->texto['mensaje']='Al parecer hay datos en blanco'; 
    }else{
      if($clave1==$clave2){
          $this->texto['tipo']="";
          $this->texto['mensaje']="";

            $this->load->model("Tabla_de_datos");
            $valor=$this->Tabla_de_datos->verificar_usuario($correo);
            if($valor==1){
                $this->texto['error']=1;
                $this->texto['tipo']='Error ';
                $this->texto['mensaje']=' Este usuario '.$correo.' ya existe.';
            }else{
             $this->Tabla_de_datos->registrousuario($correo, $nombre, $apellido, $clave1, $cargo,$institucion );
              $this->texto['error']=2;
              $this->texto['tipo']='= >';
              $this->texto['mensaje']='= >';
            }
      }else{
            $this->texto['error']=1;
            $this->texto['tipo']='Error ';
            $this->texto['mensaje']='Claves Erradas';  
      }
      
    }

      if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');

            $this->load->view('actualizar',   $this->texto); 

            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('login',   $this->texto); 
            $this->load->view('interface/pie1');    
        }

  }



public function actualizar(){
    $correo=trim($this->input->post("email"));
    $nombre=ucfirst($this->input->post("nombre"));
    $apellido=ucfirst($this->input->post("apellido"));
    $cargo=$this->input->post("cargo");
    $clave1=$this->input->post("clave1");
    $clave2=$this->input->post("clave2");
    $institucion=$this->input->post("institucion");

    if(empty($correo)||empty($nombre)||empty($apellido)||empty($cargo)||empty($clave1)||empty($clave2)||empty($institucion)){
            $this->texto['error']=1;
            $this->texto['tipo']='Error ';
            $this->texto['mensaje']='Al parecer hay datos en blanco'; 
    }else{
      if($clave1==$clave2){
          $this->texto['tipo']="";
          $this->texto['mensaje']="";

            $this->load->model("Tabla_de_datos");
            $valor=$this->Tabla_de_datos->verificar_usuario($correo);
            if($valor==1){
                $this->texto['error']=1;
                $this->texto['tipo']='Error ';
                $this->texto['mensaje']=' Este usuario '.$correo.' ya existe.';
            }else{
             $this->Tabla_de_datos->registrousuario($correo, $nombre, $apellido, $clave1, $cargo,$institucion );
              $this->texto['error']=2;
              $this->texto['tipo']='= >';
              $this->texto['mensaje']='= >';
            }
      }else{
            $this->texto['error']=1;
            $this->texto['tipo']='Error ';
            $this->texto['mensaje']='Claves Erradas';  
      }
      
    }

      if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');

            $this->load->view('actualizar',   $this->texto); 

            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('login',   $this->texto); 
            $this->load->view('interface/pie1');    
        }

  }



}
?>