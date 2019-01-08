<?php
if (!defined('BASEPATH'))   exit('No direct script access allowed');
class Alert  extends CI_Controller { 
   public function index(){
	   	echo "no veo nada";
	    $this->load->view('interface/head1');
		$look=$this->input->get('tipo');
		switch($look){
			case 401:
				$mensaje=$this->err401();
			break;
			default:
				$mensaje=$this->err404();
			break;
		}
		$this->load->view('vAlert',$mensaje); 
	 	$this->load->view('interface/pie1');
   }

   private function err401(){
	    $mensaje['abrtitulo']="401" ; 
	    $mensaje['abrmsg']="Error HTTP: No autorizado" ; 
	    $mensaje['titulo']='<span class="icon-lock"></span>&nbsp'."No Autorizado" ; 
	    $mensaje['mensaje']="La pagina o archivo al cual usted quiere ingresar no esta activada o fue modificada para uso externo" ; 
   	return $mensaje;
   }


   private function err404(){
	   	$mensaje['abrtitulo']="404" ; 
	    $mensaje['abrmsg']="Error HTTP: Pagina No Encontrada" ; 
	    $mensaje['titulo']='<span class="icon-embed2"></span>&nbsp'." Error en el link" ; 
	    $mensaje['mensaje']="La pagina o archivo al cual usted quiere ingresar no se encuentra en este servidor" ; 
	   	return $mensaje;
   }

   public function myerr404(){
   		$this->load->view('interface/head1');
	  	$mensaje=$this->err404();
		$this->load->view('vAlert',$mensaje); 
 		$this->load->view('interface/pie1');
   }
}