<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gestor extends CI_Controller {

 public function index(){
 
    

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        
        $this->load->model("Preguntas");

        $texto['mypin']=$this->Preguntas->mipin($this->session->email);


        //$this->load->view('welcome_message_usaer',$texto);
        $this->load->view('preguntas/portada',$texto);


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


  public function verpreguntas(){

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        //$this->load->model("Tabla_de_datos");
        $texto['msg']="";
        $this->load->model("Preguntas");
        $texto['mypin']=$this->Preguntas->mipin($this->session->email);
        $texto['preguntasz']=$this->Preguntas->extraer_contenido($texto['mypin']);

        //$texto['usuario']=$this->Tabla_de_datos->extraer_nombreuser();

        //$this->load->view('welcome_message_usaer',$texto);
        $this->load->view('preguntas/verpreguntas',$texto);


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

  public function elim(){

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $this->load->model("Preguntas");
        $texto['msg']='<div class="alert alert-danger" role="alert">
 La pregunta con el identificador: '.$this->input->get('id').', para la referencia: '.$this->input->get('pin').' no pudo ser eliminada.   </div>';
        $texto['mypin']=$this->Preguntas->mipin($this->session->email);
        $texto['preguntasz']=$this->Preguntas->extraer_contenido($texto['mypin']);

        if($this->input->get('pin')!=null && $this->input->get('id')!=null){
            if($this->input->get('pin')===$this->Preguntas->mipin($this->session->email)){
                $this->Preguntas->delete($this->input->get('id'));
                 $texto['msg']='<div class="alert alert-success" role="alert">
 La pregunta con el identificador: '.$this->input->get('id').', para la referencia: '.$this->input->get('pin').' ha eliminada.   </div>';
            }
        }


        $this->load->view('preguntas/verpreguntas',$texto);
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





  public function elim2(){

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $this->load->model("Preguntas");

        if($this->input->get('pin')!=null){
            $this->Preguntas->delete2($this->input->get('pin'));
           redirect(base_url().'Gestor/listar');
        }else{
            $this->load->view('preguntas',$texto);
        }

        

        
       
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







   public function nueva(){

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $texto['msg']="";

        $this->load->model("Preguntas");
       // $texto['msg']='<div class="alert alert-danger" role="alert"> La pregunta con el identificador: '.$this->input->get('id').', para la referencia: '.$this->input->get('pin').' no pudo ser eliminada.   </div>';
        $texto['mypin']=$this->Preguntas->mipin($this->session->email);
        //$texto['preguntasz']=$this->Preguntas->extraer_contenido($texto['mypin']);

        if($this->input->post('titulo')!=null && $this->input->post('url')!=null){
            $titulo=$this->input->post('titulo');
            $url=$this->input->post('url');
            $this->Preguntas->nuevapregunta($texto['mypin'],$titulo,$url); 
             $texto['msg']='<div class="alert alert-success" role="alert"> El formulario fue registrado con exito  </div>';
        }
         

        $this->load->view('preguntas/vnuevo',$texto);
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


  public function listar(){

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $texto['msg']="";



        $this->load->model("Preguntas");
        $pin=$this->Preguntas->mipin($this->session->email);
        
        $validar=$this->Preguntas->buscar($pin);



        // $texto['msg']='<div class="alert alert-danger" role="alert"> La pregunta con el identificador: '.$this->input->get('id').', para la referencia: '.$this->input->get('pin').' no pudo ser eliminada.   </div>';
                
        if($validar==null){
            $texto['msg']='<div class="alert alert-danger" role="alert">Al parecer no cuentas con un pin de acceso para acceder a las preguntas de vuestro tutor.</div>';
                  $texto['registro']=0;
                if($this->input->post('pinx')!=null){
                    $texto['registro']=0;
                    $npin=$this->Preguntas->pines($this->input->post('pinx'));
                    if($npin==true){
                        if($pin!=$this->input->post('pinx')){
                            $this->Preguntas->crear($pin,$this->input->post('pinx'));
                             $texto['registro']=1;
                            redirect(base_url().'Gestor/listar');

                        }else{
                            $texto['msg']='<div class="alert alert-danger" role="alert">no puede hacer auto registro... '.$pin.' = '.$this->input->post('pinx').'</div>';
                        }


                    }else{
                        $texto['msg']='<div class="alert alert-danger" role="alert">El codigo no existe</div>';
                    }
                }else{
                     

                }

$this->load->view('preguntas/vinculos',$texto);

        }else{
            $vinculado=$this->Preguntas->Buscarvin($validar);
             $texto['msg']='<div class="alert alert-primary" role="alert">Bienvenido usted esta vinculado con: '.$vinculado.'
             <a href="'.base_url().'Gestor/elim2?pin='.$pin.'" class="btn-warning">Terminar Vinculo</a>
             </div>';
            $texto['registro']=1;

            $texto['preguntasz']=$this->Preguntas->extraer_contenido($validar);
            $this->load->view('preguntas/verpreguntas2',$texto);
        }


        


       


        


        

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