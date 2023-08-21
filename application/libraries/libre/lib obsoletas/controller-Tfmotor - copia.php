<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tfmotor extends CI_Controller {

    private $texto="";

    private function librerias()
    {
       $this->load->library('libre/Complejo');
       $this->load->library('libre/DerivadaP');
       $this->load->library('libre/FracParcial');
       $this->load->library('libre/Raices');
       $this->load->library('libre/LimiteP');
       $this->load->library('libre/Paragrafica');
       $this->load->library('libre/Raices2poligrup');
       $this->load->library('libre/Stringlatex');
       $this->load->library('libre/Textbox2tf');
       $this->load->library('libre/Polinomio');
       $this->load->library('libre/Bode');
       $this->load->library('libre/Tf');
       $this->load->library('libre/Rlocus');
       $this->load->library('Menu1');
       $this->load->library('libre/Motordc');
       // $this->librerias();
    }

    public function pidmotor(){
      $this->librerias();
      $motor= new Motordc();
        $this->texto['menux']=new Menu1($this->menu,"PID posición");
        
        $this->texto['tf']= $motor->TmfmotorPos();
        if($this->input->post("enviado")!=1){
          $this->texto['motor_j']=$motor->J;
          $this->texto['motor_b']=$motor->b;
          $this->texto['motor_ke']=$motor->Ke;
          $this->texto['motor_r']=$motor->R;
          $this->texto['motor_l']=$motor->L;
          $this->texto['kp']=1;
          $this->texto['ki']=0;
          $this->texto['kd']=0;
          $this->texto['motor_num']=0;
          $this->texto['motor_den']=0;
        }else{
          $motor->J=$this->input->post("motor_j");
          $motor->b=$this->input->post("motor_b");
          $motor->Ke=$this->input->post("motor_ke");
          $motor->R=$this->input->post("motor_r");
          $motor->L=$this->input->post("motor_l");
          $kp=$this->input->post("kp");
          $ki=$this->input->post("ki");
          $kd=$this->input->post("kd");
          $a=$this->input->post("alpha");



          $this->texto['motor_j']=$motor->J;
          $this->texto['motor_b']=$motor->b;
          $this->texto['motor_ke']=$motor->Ke;
          $this->texto['motor_r']=$motor->R;
          $this->texto['motor_l']=$motor->L;
          $this->texto['kp']=$kp;
          $this->texto['ki']=$ki;
          $this->texto['kd']=$kd;

          
          $data=$motor->LC($motor->TmfmotorPosOperada(),$motor->pid($kp, $kd, $ki,$a));
          $this->texto['polinomio']=$motor->TmfmotorPosOperada();
          $this->texto['pid']=$motor->pid($kp, $kd, $ki,$a);
          $this->texto['ps']=$data;
          list($this->texto['motor_num'],$this->texto['motor_den'])=$motor->tf2tbox($data);
        }





        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('modelosTF/tf_motordc',$this->texto);
            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('interface/cabecera1');
            $this->load->view('modelosTF/tf_motordc',$this->texto);
            $this->load->view('interface/pie1');     
       }
    }


    public function pidmotorcc(){
      $this->librerias();
      $this->texto['menux']=new Menu1($this->menu,"PID posición");
      $motor= new Motordc();
        
        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('modelosTF/tf_mot',$this->texto);
            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('interface/cabecera1');
            $this->load->view('modelosTF/tf_mot',$this->texto);
            $this->load->view('interface/pie1');    
       }
    }






    public function __construct(){

         parent::__construct();
           $this->menu=[
            base_url()."tfmotor/pidmotor"=>"PID posición",
            //base_url()."tfmotor/tfmotorVE"=>"Representacion en Variables Estado",
            base_url()."tfmotor/teoria"=>"Teoria del Sistema",
            ]; 
    }

 public function index(){
    $this->load->library('Menu1');
 	  $this->texto['menux']=new Menu1($this->menu,"Teoria del Sistema");

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $this->load->view('modelosTF/dcmotor',$this->texto);
        $this->load->view('logeado/ehtml');  
        if($this->input->get('logout')=='ok'){
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }else{
        $this->load->view('interface/head1');  
        $this->load->view('interface/cabecera1');
        $this->load->view('modelosTF/dcmotor',$this->texto);
        $this->load->view('interface/pie1');     
	 }
  }





public function tfmotorVE(){
    $this->librerias();
    $this->texto['menux']=new Menu1($this->menu,"Representacion en Variables Estado");
    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
       $this->load->view('modelosTF/tf_motordc',$this->texto);
        $this->load->view('logeado/ehtml');  
        if($this->input->get('logout')=='ok'){
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }else{
        $this->load->view('interface/head1');  
        $this->load->view('interface/cabecera1');
        $this->load->view('modelosTF/tf_motordc',$this->texto);
        $this->load->view('interface/pie1');     
   }
  }






  public function teoria(){
    $this->librerias();
    $this->texto['menux']=new Menu1($this->menu,"Teoria del Sistema");
    if(isset($this->session->email)){
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $this->load->view('modelosTF/dcmotor', $this->texto);
        $this->load->view('logeado/ehtml');  
        if($this->input->get('logout')=='ok'){
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }else{
        $this->load->view('interface/head1');  
        $this->load->view('interface/cabecera1');
        $this->load->view('modelosTF/dcmotor', $this->texto);
        $this->load->view('interface/pie1'); 
    }

  }
}
?>