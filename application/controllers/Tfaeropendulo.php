<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tfaeropendulo extends CI_Controller {

    private $texto=array();

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
       $this->load->library('libre/aeropendulo');
       // $this->librerias();
    }
/*
            (g\)  = Aceleracion Gravitacional  \([9.8 k_g/m^2]\)</li>
            (\beta\)  = Angulo de engranaje servomotor \([rad]\)</li>
            (\gamma\) = Cordenada de la esfera   \([met]\)</li>
            (\alpha\) = Coordenada del angulo del haz   \([rad]\)</li>
            (d\)  = Desplazamiento del sigueñal en el motor   \([met]\)</li>
            (m\)  = Masa de la esfera   \([k_g]\)</li>
            (J\)  = Momento inercia esfera  \([k_gm^2]\)</li>
            (R\)  = Radio Esfera  \([met]\)</li>

*/
    public function pidaeropendulo(){
      $this->librerias();
      $ballbeam= new aeropendulo();
        $this->texto['menux']=new Menu1($this->menu,"PID posición");
        
        
        if($this->input->post("enviado")!=1){
           $this->texto['arpen_l']=$ballbeam->l;
          $this->texto['arpen_mg']=$ballbeam->mg;
          $this->texto['arpen_k']=$ballbeam->k;
          $this->texto['arpen_c']=$ballbeam->c;


          $this->texto['kp']=1;
          $this->texto['ki']=0;
          $this->texto['kd']=0;
          $this->texto['arpen_num']=0;
          $this->texto['arpen_den']=0;
        }else{
          $l=floatval($this->input->post("arpen_l"));
          $mg=floatval($this->input->post("arpen_mg"));
          $k=floatval($this->input->post("arpen_k"));
          $c=floatval($this->input->post("arpen_c"));

          
          $ballbeam->nuevosParametros($l,$mg,$k,$c);


          $kp=$this->input->post("kp");
          $ki=$this->input->post("ki");
          $kd=$this->input->post("kd");
          $a=$this->input->post("alpha");
       

          $this->texto['arpen_l']=$ballbeam->l;
          $this->texto['arpen_mg']=$ballbeam->mg;
          $this->texto['arpen_k']=$ballbeam->k;
          $this->texto['arpen_c']=$ballbeam->c;




          $this->texto['kp']=$kp;
          $this->texto['ki']=$ki;
          $this->texto['kd']=$kd;

          
          $data=$ballbeam->LC($ballbeam->TmfmotorPosOperada(),$ballbeam->pid($kp, $kd, $ki,$a));
          $this->texto['polinomio']=$ballbeam->TmfmotorPosOperada();
          $this->texto['pid']=$ballbeam->pid($kp, $kd, $ki,$a);
          $this->texto['ps']=$data;
          list($this->texto['arpen_num'],$this->texto['arpen_den'])=$ballbeam->tf2tbox($data);
        }

        $this->texto['tf']= $ballbeam.$ballbeam->TmfmotorPos();



        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('modelosTF/aeropendulotp',$this->texto);
            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('interface/cabecera1');
            $this->load->view('modelosTF/aeropendulotp',$this->texto);
            $this->load->view('interface/pie1');     
       }
    }








    public function __construct(){

         parent::__construct();
           $this->menu=[
            base_url()."tfaeropendulo/pidaeropendulo"=>"PID posición",
            //base_url()."tfballbeam/tfmotorVE"=>"Representacion en Variables Estado",
            base_url()."tfaeropendulo/teoria"=>"Teoria del Sistema",
            ]; 
    }

 public function index(){
    $this->load->library('Menu1');
 	  $this->texto['menux']=new Menu1($this->menu,"Teoria del Sistema");

    if(isset($this->session->email)){       
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $this->load->view('modelosTF/aeropendulo',$this->texto);
        $this->load->view('logeado/ehtml');  
        if($this->input->get('logout')=='ok'){
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }else{
        $this->load->view('interface/head1');  
        $this->load->view('interface/cabecera1');
        $this->load->view('modelosTF/aeropendulo',$this->texto);
        $this->load->view('interface/pie1');     
	 }
  }



/*

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

*/




  public function teoria(){
    $this->librerias();
    $this->texto['menux']=new Menu1($this->menu,"Teoria del Sistema");
    if(isset($this->session->email)){
        $this->load->view('logeado/head1');  
        $this->load->view('logeado/cabecera1');
        $this->load->view('modelosTF/aeropendulo', $this->texto);
        $this->load->view('logeado/ehtml');  
        if($this->input->get('logout')=='ok'){
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }else{
        $this->load->view('interface/head1');  
        $this->load->view('interface/cabecera1');
        $this->load->view('modelosTF/aeropendulo', $this->texto);
        $this->load->view('interface/pie1'); 
    }

  }
}
?>