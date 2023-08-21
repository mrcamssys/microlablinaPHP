<?php




defined('BASEPATH') OR exit('No direct script access allowed');


//namespace NumPHPTest\LinAlg\LinAlg;

use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP;
use NumPHP\LinAlg\LinAlg;
use NumPHP\LinAlg\LinAlg\LUDecomposition;
use NumPHPTest\Core\Framework\TestCase;
use MCordingley\LinearAlgebra\Matrix;


class Modelossys extends CI_Controller {

    public function __construct(){
         parent::__construct();
         $sys=$this->input->get("sys");
         $this->menu=[
            base_url()."modelossys/calcular?id=1&sys=".$sys." "=>"Análisis del Modelo",
            base_url()."modelossys/calcular?id=2&sys=".$sys." "=>"Gráfico Impulso",
            base_url()."modelossys/calcular?id=3&sys=".$sys." "=>"Gráfico Escalón",
            base_url()."modelossys/calcular?id=4&sys=".$sys." "=>"Gráfico Rampa",
            base_url()."modelossys/Bode?id=".$this->input->get("id")."&sys=".$sys." "=>"Diagrama de bode",
            base_url()."modelossys/VE?id=".$this->input->get("id")."&sys=".$sys." "=>"Espacio de Estados",
            //base_url()."modelossys/RH?id=".$this->input->get("id")."&sys=".$sys." "=>"Ruth Hurwits",
            //base_url()."help/tf"=>"Ayuda en la seccion",
         ];  
    }


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
       $this->load->library('libre/fraccion');
       $this->load->library('libre/Imptabla');
       $this->load->library('libre/Formascanonicas');
       $this->load->library('libre/Ruth');
       $this->load->library('Menu2');
    }

     public function index(){
        $texto['misceros']=$texto['mispolos']="";  
        $texto['modelar']=0;
       
        $this->load->model("Modelos");
        $sys=$this->input->get("sys");

        $texto['cant']=$this->Modelos->listar_modelos();
        //$texto['titulo']=$this->Modelos->extraer_nombremodelo($sys);
        // $texto['contenido']=$this->Modelos->extraer_contenido($sys);
        //list($texto['variables'],$variablesjs)=$this->Modelos->extraer_listavariables($sys);
        //list($a,$b)=$this->Modelos->extraer_TFmodelo($sys);

        //$texto['comandjs']=$variablesjs."\n\t".$a."\n\t".$b."\n\t"; 

        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');

            $this->load->view('modelosTF/modelos', $texto);


            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
            $this->load->view('interface/cabecera1');
            
            //$this->load->view('welcome_message');
            $this->load->view('modelosTF/modelos', $texto);


           $this->load->view('interface/pie1');        
    	}                   
      }



    public function calcular()
    {

        $texto['modelar']=1;

$texto['misceros']=$texto['mispolos']="";


$sys=$this->input->get("sys");
        
        $this->load->model("Modelos");

        $texto['titulo']=$this->Modelos->extraer_nombremodelo($sys);
         $texto['contenido']=$this->Modelos->extraer_contenido($sys);
        list($texto['variables'],$variablesjs)=$this->Modelos->extraer_listavariables($sys);
        list($a,$b)=$this->Modelos->extraer_TFmodelo($sys);

        $texto['comandjs']=$variablesjs."\n\t".$a."\n\t".$b."\n\t"; 

        $this->librerias();
        
        $texto['Error']=NULL;
        
        $pCeros=$this->input->post("ceros1");
        $pPolos=$this->input->post("polos1");
        

        $pCeros2=$this->input->post("ceros2");
        $pPolos2=$this->input->post("polos2");
        
if (!empty($_POST['hidden'])) {
    $estado="Respuesta total del Sistema en lazo cerrado con controlador ";
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denpB=new Polinomio($this->textbox2tf->arpolos());
    $numpA=new Polinomio($a);

    $this->textbox2tf->campotexto2arreglo($pCeros2, $pPolos2);
    $x=$this->textbox2tf->arceros();
    if(!is_array($x)) $x=array($this->textbox2tf->arceros());
    $denpD=new Polinomio($this->textbox2tf->arpolos());
    $numpC=new Polinomio($x);
    
    $Controlador=new Tf($numpC,$denpD,"C(S)");
    $texto['tf2']='<div class="alert alert-success ">Al parecer el controlador PID, esta activado, en este momento esta viendo la planta en lazo cerrado y la planta que se muestra en la parte superior es el resultado de operar el lazo cerrado.</div>';
    $texto['tf2']=$texto['tf2'].'<div class="alert alert-primary ">El sistema cuenta con el controlador activado, el análisis del sistema es en lazo Cerrado y la función del transferencia del controlador es:'.$Controlador.'</div>';
    
    $planta=new Tf($numpA,$denpB, "G(S)");
    $texto['tf2']=$texto['tf2'].'<div class="alert alert-primary ">La Función de transferencia de la planta a modelar es'.$planta.'</div>';

    $nump=$numpA->mulPor($numpC);

     $planta2=new Tf($numpA,$denpB, "G(S)");
    $texto['tf1']='<div class="alert alert-warning ">En este momento la planta se encuentra activa en modo de lazo cerrado, los cálculos que ve en esta sección son solo para contrastar resultados, <b>aqui usted ve el sistema como se comporta de manera natural sin una acción de re-alimentación</b> <br> planta en lazo abierto es:'.$planta2.'</div>';


 $texto['tf2']=$texto['tf2'].'<div class="alert alert-primary ">
    <p>La siguiente ecuación, es la evaluación de un sistema en cascada</p>
        $$Y(s)=G(s)*C(s)$$
    <p>la ecuación de comparación entre la entrada y la salida es:</p>
        $$e(s)=U(s)-Y(s)$$
    <p>Al remplazar e(s) de la primera ecuación, con la secunda, se logra tener una nueva funcion de transferencia que se da la nomenclatura H(s)</p>
        $$ H(s)=\frac{Y(s)}{U(s)}=\frac{1}{\frac{1}{G(s)*C(s)}+1} $$   
    esta nueva función de transferencia sera considerada como un nuevo sistema, el resultado de este lo encuentra en el recuadro verde de la sección superior.  
 </div>';

    //$a=$numpC->mulPor($numpA);
    $b=$denpB->mulPor($denpD);
    $denp=$b->sumPor2($nump);
    $texto['control']=1;
} else {
    $estado="Respuesta total del Sistema en lazo abierto sin controlador ";
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denp=new Polinomio($this->textbox2tf->arpolos());
    $nump=new Polinomio($a);
    if($this->input->post("ceros1")){
     
    $planta=new Tf($nump,$denp, "G(S)");
    $planta2=new Tf($nump,$denp, "H(S)");
           $texto['control']=0;
    $texto['tf1']="<div class=\"alert alert-success\">
    La funcion de transferencia del sistema modelado es:
    ".$planta."

    </div>";
     $texto['tf2']='<div class="alert alert-warning ">El sistema no tiene un controlador activado, el análisis del sistema es en lazo abierto, la función de transferencia que se esta modelando es la que se encuentra en la parte superior en el recuadro verde.</div>';
    }

}

$texto['misceros']=implode(',', (array)$nump->polinomio);
$texto['mispolos']=implode(',', (array)$denp->polinomio);

        

        if($denp->grado()>$nump->grado() || $denp->grado()>=2) {
        $texto['valsys']=0;
        switch((int)$this->input->get("id")) {
            case 2:
            $texto['menux']=new Menu2($this->menu,"Gráfico Impulso");
                # code... 
            list($texto['puntos_grafica'],$texto['tiempos'])=$planta->impulsotf();
            $tranferencia=new Tf($nump,$denp);
            $texto['tf']='<p><b>'.$estado.'-> Entrada Impulso: </b></p>'.$tranferencia.' ';
            list($texto['puntos_grafica2'],$texto['tiempos2'])=$tranferencia->impulsotf();
            $texto['tabla']=$tranferencia->getzptabla();
                break;
            case 3:
            $texto['menux']=new Menu2($this->menu,"Gráfico Escalón");

            $denx=$planta->den->polinomio;
            array_push($denx,0);
            $denn=new Polinomio($denx);
            $plantax=new Tf($planta->num,$denn);           
            list($texto['puntos_grafica'],$texto['tiempos'])=$plantax->impulsotf();

            array_push($denp->polinomio,0);
            $denp=new Polinomio($denp->polinomio);
            $tranferencia=new Tf($nump,$denp);
            $texto['tf']='<p><b>'.$estado.'-> Entrada Escalón</b></p>'.$tranferencia.' ';
            list($texto['puntos_grafica2'],$texto['tiempos2'])=$tranferencia->impulsotf();
            $texto['tabla']=$tranferencia->getzptabla();

                break;
            case 4:
            $texto['menux']=new Menu2($this->menu,"Gráfico Rampa");
                # code...
            $denx=$planta->den->polinomio;
            array_push($denx,0,0);
            $denn=new Polinomio($denx);
            $plantax=new Tf($planta->num,$denn);           
            list($texto['puntos_grafica'],$texto['tiempos'])=$plantax->impulsotf();


            array_push($denp->polinomio,0,0);
            $denp=new Polinomio($denp->polinomio);
            $tranferencia=new Tf($nump,$denp);
            $texto['tf']='<p><b>'.$estado.'-> Entrada Rampa:</b></p>'.$tranferencia.' ';
            list($texto['puntos_grafica2'],$texto['tiempos2'])=$tranferencia->impulsotf();
            $texto['tabla']=$tranferencia->getzptabla();

                break;
            case 1:
            $texto['valsys']=1;

            #aqui se coloca todo lo relacionado con la extraccion del modelo
            $texto['menux']=new Menu2($this->menu,"Análisis del Modelo");
                # code... 
            $tranferencia=$planta2;
            $texto['tf']='<p><b>'.$estado.'-> Entrada Impulso: </b></p>'.$tranferencia.' ';
            list(,,$texto['raices'])=$tranferencia->getzp();
            list($texto['Fparciales'],$texto['inversaplace'])=$tranferencia->getfracpar();
            $texto['tabla']=$tranferencia->getzptabla();
         
         if($texto['control']==1){
            $tranferencia2=new Tf($nump,$denp);
            $texto['tf']='<p><b>'.$estado.'-> Entrada Impulso: </b></p>'.$tranferencia2.' ';
            list(,,$texto['raices2'])=$tranferencia2->getzp();
            list($texto['Fparciales2'],$texto['inversaplace2'])=$tranferencia2->getfracpar();
            $texto['tabla2']=$tranferencia2->getzptabla();
         }
            break;


            default:
                # code...
             $texto['Error']="<div class=\"alert alert-worng\">Recuerde que:<br>debe dar en los botones <b>ver solo sistema</b> o <b>ver lazo cerrado y PID</b> para continuar...</div>"; 
                break;
        }
           
        
          // $texto['inversaplace']="";
        }elseif($pCeros==NULL &&  $pPolos==NULL) {
           $texto['Error'] = "<div class=\"alert alert-warning\">
           <span class='glyphicon glyphicon-fire'></span>
           <h3>En hora Buena!</h3>Por favor modifique los parámetros del sistema, esto le permitirá ver los cambios que se generan en la función de transferencia del modelo que esta simulando.<br></div><h2>Información Teórica del Modelo</h2>";
           $texto['Error']=$texto['Error'].$this->Modelos->extraer_contenido($sys);
        }
        else $texto['Error'] = "<div class=\"alert alert-danger\"><h3>Ops!</h3>El sistema que esta tratando de modelar tiene parámetros que hacen imposible su funcionamiento, verifique e intente de nuevo.<br></div>";
        
        
       
        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('modelosTF/vMdelos', $texto);
            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
           $this->load->view('modelosTF/vMdelos', $texto);
            $this->load->view('interface/pie1');    
        
        }   


    }




    public function bode(){
        $texto['modelar']=1;
  
        $texto['misceros']=$texto['mispolos']="";     
        $this->load->model("Modelos");
        
        $sys=$this->input->get("sys");

        $texto['titulo']=$this->Modelos->extraer_nombremodelo($sys);

         $texto['contenido']=$this->Modelos->extraer_contenido($sys);
        list($texto['variables'],$variablesjs)=$this->Modelos->extraer_listavariables($sys);
        list($a,$b)=$this->Modelos->extraer_TFmodelo($sys);

        $texto['comandjs']=$variablesjs."\n\t".$a."\n\t".$b."\n\t"; 

        $this->librerias();
        $texto['Error']=NULL;
  

/*****************************************/


        $pCeros=$this->input->post("ceros1");
        $pPolos=$this->input->post("polos1");
        

        $pCeros2=$this->input->post("ceros2");
        $pPolos2=$this->input->post("polos2");
        
if (!empty($_POST['hidden'])) {
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denpB=new Polinomio($this->textbox2tf->arpolos());
    $numpA=new Polinomio($a);

    $this->textbox2tf->campotexto2arreglo($pCeros2, $pPolos2);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denpD=new Polinomio($this->textbox2tf->arpolos());
    $numpC=new Polinomio($a);
    
    $Controlador=new Tf($numpC,$denpD);
    $texto['tf2']='<div class="alert alert-primary ">El sistema cuenta  controlador activado, el análisis del sistema es en lazo Cerrado y la función del transferencia del controlador es:'.$Controlador.'</div>';
    
    $planta=new Tf($numpA,$denpB);
    $texto['tf2']=$texto['tf2'].'<div class="alert alert-primary ">La función de transferencia de la planta a modelar es'.$planta.'</div>';

    $nump=$numpA->mulPor($numpC);
    $a=$numpA->mulPor($numpC);
    $b=$denpB->mulPor($denpD);
    $denp=$a->sumPor2($b);
    $closeLoop=1;
} else {
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denp=new Polinomio($this->textbox2tf->arpolos());
    $nump=new Polinomio($a);
    $texto['tf2']="<div class=\"alert alert-warning\">El sistema no tiene Ningún controlador activado, el analisis del sistema es en lazo abierto</div>";
    $closeLoop=0;
}


if($closeLoop==0)
$texto['reco']='El sistema que usted esta usando no tiene el controlador activado por tanto se realiza el traficado de la función de transferencia de la planta en lazo abierto, la función de transferencia a trazar se encuentra en la sección verde de la parte superior. ';    
else
$texto['reco']='<p>Usted esta usando el sistema con un controlador C(s) activado, se realiza el diagrama de bode de la planta en forma de lazo cerrado con re-alimentación negativa como se muestra a continuación.</p>
    <p>La siguiente ecuación, es la evaluación de un sistema en cascada</p>
        $$Y(s)=G(s)*C(s)$$
    <p>la ecuación de comparación entre la entrada y la salida es:</p>
        $$e(s)=U(s)-Y(s)$$
    <p>Al remplazar e(s) de la primera ecuación, con la secunda, se logra tener una nueva función de transferencia que se da la nomenclatura H(s)</p>
        $$ H(s)=\frac{Y(s)}{U(s)}=\frac{1}{\frac{1}{G(s)*C(s)}+1} $$   
    esta nueva función de transferencia sera considerada como un nuevo sistema, el resultado de este lo encuentra en el recuadro verde de la sección superior.     
';        
        
        if($denp->grado()>=$nump->grado()) {
            $texto['misceros']=implode(",", $nump->polinomio);
$texto['mispolos']=implode(",", $denp->polinomio);
            $tranferencia=new Tf($nump,$denp);
            $texto['tf']='<p>Impul$closeLoop=1;so</p>'.$tranferencia.' ';
            //list($texto['bode'],$texto['fase'])=$tranferencia->getbode(); 
            $texto['datos']=$tranferencia->getbode(); 

        }elseif($pCeros==NULL &&  $pPolos==NULL) {
             $texto['Error'] = "<div class=\"alert alert-danger\"><h3>Ops!</h3>El sistema que esta tratando de modelar tiene parámetros que hacen imposible su funcionamiento, verifique e intente de nuevo.<br></div>";
        }
        else $texto['Error'] = "<b><span style=\"color:#FF5733;\">Recuerde que:<br>Un sistema real modelado, <br>el orden del numerador no puede ser mayor o igual al orden del denominador</b>";
        
          $texto['menux']=new Menu2($this->menu,"Diagrama de bode");
        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('modelosTF/vMdelos2', $texto);
            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
           $this->load->view('modelosTF/vMdelos2', $texto);
            $this->load->view('interface/pie1');    
        
        }   

    }






public function RH(){
        $texto['modelar']=1;
  
        $texto['misceros']=$texto['mispolos']="";     
        $this->load->model("Modelos");
        
        $sys=$this->input->get("sys");

        $texto['titulo']=$this->Modelos->extraer_nombremodelo($sys);

         $texto['contenido']=$this->Modelos->extraer_contenido($sys);
        list($texto['variables'],$variablesjs)=$this->Modelos->extraer_listavariables($sys);
        list($a,$b)=$this->Modelos->extraer_TFmodelo($sys);

        $texto['comandjs']=$variablesjs."\n\t".$a."\n\t".$b."\n\t"; 

        $this->librerias();
        $texto['Error']=NULL;
  

/*****************************************/


        $pCeros=$this->input->post("ceros1");
        $pPolos=$this->input->post("polos1");
        

        $pCeros2=$this->input->post("ceros2");
        $pPolos2=$this->input->post("polos2");
        
if (!empty($_POST['hidden'])) {
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denpB=new Polinomio($this->textbox2tf->arpolos());
    $numpA=new Polinomio($a);

    $this->textbox2tf->campotexto2arreglo($pCeros2, $pPolos2);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denpD=new Polinomio($this->textbox2tf->arpolos());
    $numpC=new Polinomio($a);
    
    $Controlador=new Tf($numpC,$denpD);
    $texto['tf2']='<div class="alert alert-primary ">El sistema cuenta  controlador activado, el análisis del sistema es en lazo Cerrado y la función del transferencia del controlador es:'.$Controlador.'</div>';
    
    $planta=new Tf($numpA,$denpB);
    $texto['tf2']=$texto['tf2'].'<div class="alert alert-primary ">La Función de transferencia de la planta a modelar es'.$planta.'</div>';

    $nump=$numpA->mulPor($numpC);
    $a=$numpA->mulPor($numpC);
    $b=$denpB->mulPor($denpD);
    $denp=$a->sumPor2($b);

} else {
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denp=new Polinomio($this->textbox2tf->arpolos());
    $nump=new Polinomio($a);
    $texto['tf2']="<div class=\"alert alert-warning\">El sistema no tiene Ningún controlador activado, el analisis del sistema es en lazo abierto</div>";
}


$texto['misceros']=implode(",", $nump->polinomio);
$texto['mispolos']=implode(",", $denp->polinomio);
        
        if($denp->grado()>=$nump->grado()) {
            $tranferencia=new Tf($nump,$denp);
            $texto['tf']='<p>Variable de estado de la función de transferencia</p>'.$tranferencia.' ';
            //list($texto['bode'],$texto['fase'])=$tranferencia->getbode(); 

            $ruthh=new Ruth($tranferencia->den);
            $texto['datos']=new Imptabla($ruthh->ensambladortabla());

        }elseif($pCeros==NULL &&  $pPolos==NULL) {
             $texto['Error'] = "<div class=\"alert alert-danger\"><h3>Ops!</h3>El sistema que esta tratando de modelar tiene parámetros que hacen imposible su funcionamiento, verifique e intente de nuevo.<br></div>";
        }
        else $texto['Error'] = "<b><span style=\"color:#FF5733;\">Recuerde que:<br>Un sistema real modelado, <br>el orden del numerador no puede ser mayor o igual al orden del denominador</b>";
        
        $texto['menux']=new Menu2($this->menu,"Ruth Hurwits");
        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('modelosTF/vMdelos4', $texto);
            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
           $this->load->view('modelosTF/vMdelos4', $texto);
            $this->load->view('interface/pie1');    
        
        }   

    }


public function VE(){
        $texto['modelar']=1;
  
        $texto['misceros']=$texto['mispolos']="";     
        $this->load->model("Modelos");
        
        $sys=$this->input->get("sys");

        $texto['titulo']=$this->Modelos->extraer_nombremodelo($sys);

         $texto['contenido']=$this->Modelos->extraer_contenido($sys);
        list($texto['variables'],$variablesjs)=$this->Modelos->extraer_listavariables($sys);
        list($a,$b)=$this->Modelos->extraer_TFmodelo($sys);

        $texto['comandjs']=$variablesjs."\n\t".$a."\n\t".$b."\n\t"; 

        $this->librerias();
        $texto['Error']=NULL;
  

/*****************************************/


        $pCeros=$this->input->post("ceros1");
        $pPolos=$this->input->post("polos1");
        

        $pCeros2=$this->input->post("ceros2");
        $pPolos2=$this->input->post("polos2");
        
if (!empty($_POST['hidden'])) {
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denpB=new Polinomio($this->textbox2tf->arpolos());
    $numpA=new Polinomio($a);

    $this->textbox2tf->campotexto2arreglo($pCeros2, $pPolos2);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denpD=new Polinomio($this->textbox2tf->arpolos());
    $numpC=new Polinomio($a);
    
    $Controlador=new Tf($numpC,$denpD);
    $texto['tf2']='<div class="alert alert-primary ">El sistema cuenta  controlador activado, el análisis del sistema es en lazo Cerrado y la función del transferencia del controlador es:'.$Controlador.'</div>';
    
    $planta=new Tf($numpA,$denpB);
    $texto['tf2']=$texto['tf2'].'<div class="alert alert-primary ">La función de transferencia de la planta a modelar es'.$planta.'</div>';

    $nump=$numpA->mulPor($numpC);
    $a=$numpA->mulPor($numpC);
    $b=$denpB->mulPor($denpD);
    $denp=$a->sumPor2($b);

} else {
    $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
    $a=$this->textbox2tf->arceros();
    if(!is_array($a)) $a=array($this->textbox2tf->arceros());
    $denp=new Polinomio($this->textbox2tf->arpolos());
    $nump=new Polinomio($a);
    $texto['tf2']="<div class=\"alert alert-warning\">El sistema no tiene Ningún controlador activado, el análisis del sistema es en lazo abierto</div>";
}


$texto['misceros']=implode(",", $nump->polinomio);
$texto['mispolos']=implode(",", $denp->polinomio);
        
        if($denp->grado()>=$nump->grado()) {
            $tranferencia=new Tf($nump,$denp);
            $texto['tf']='<p>Variable de estado de la función de transferencia</p>'.$tranferencia.' ';
            //list($texto['bode'],$texto['fase'])=$tranferencia->getbode(); 
            $texto['datos']=new Formascanonicas($tranferencia); 

        }elseif($pCeros==NULL &&  $pPolos==NULL) {
             $texto['Error'] = "<div class=\"alert alert-danger\"><h3>Ops!</h3>El sistema que esta tratando de modelar tiene parámetros que hacen imposible su funcionamiento, verifique e intente de nuevo.<br></div>";
        }
        else $texto['Error'] = "<b><span style=\"color:#FF5733;\">Recuerde que:<br>Un sistema real modelado, <br>el orden del numerador no puede ser mayor o igual al orden del denominador</b>";
        
        $texto['menux']=new Menu2($this->menu,"Espacio de Estados");
        if(isset($this->session->email)){       
            $this->load->view('logeado/head1');  
            $this->load->view('logeado/cabecera1');
            $this->load->view('modelosTF/vMdelos3', $texto);
            $this->load->view('logeado/ehtml');  
            if($this->input->get('logout')=='ok'){
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }else{
            $this->load->view('interface/head1');  
           $this->load->view('modelosTF/vMdelos3', $texto);
            $this->load->view('interface/pie1');    
        
        }   

    }




}


?>