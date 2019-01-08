<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Operador extends CI_Controller {

    private function librerias()
    {
       $this->load->library('libre/Complejo');
       $this->load->library('libre/DerivadaP');
       $this->load->library('libre/FracParcial2');
       $this->load->library('libre/Raices');
       $this->load->library('libre/LimiteP');
      // $this->load->library('libre/Paragrafica');
       $this->load->library('libre/Raices2poligrup');
       $this->load->library('libre/Stringlatex');
       $this->load->library('libre/Textbox2tf');
     //  $this->load->library('libre/Polinomio');
      // $this->load->library('libre/Bode');
      // $this->load->library('libre/Tf');
       //$this->load->library('libre/Rlocus');
      // $this->load->library('Menu1');

        //redirect("error404");
    }



    public function __construct(){
         parent::__construct();
    }

    public function index()
    {

        //$this->calcular();
        //$this->librerias();

        $this->load->view('interface/head1');  

        $sys['mensaje']="<br><br>espere";
        $this->load->view('vOperador',$sys); 
        $this->load->view('interface/pie1');    
        
    }


    public function mostrar(){

        $this->librerias();
        $this->texto['Error']=NULL;
        $pCeros=$this->input->post("ceros");
        $pPolos=$this->input->post("polos");
        $this->texto['pCeros']=$pCeros;
        $this->texto['pPolos']=$pPolos;
        $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
        $a=$this->textbox2tf->arceros();
        $b=$this->textbox2tf->arpolos();
        if(!is_array($a)) $a=array($this->textbox2tf->arceros());
       // $denp=new Polinomio($this->textbox2tf->arpolos());
       // $nump=new Polinomio($a);

        $cams=new FracParcial2($a,$b);
        $this->load->view('interface/head1');  

        $sys['mensaje']="<hr>Resultado<hr>".$cams->printR();
        $this->load->view('vOperador',$sys); 
        $this->load->view('interface/pie1');    
        
    }





}
?>













