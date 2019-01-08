<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//use NumPHP\Core\NumArray;
//use NumPHP\LinAlg\LinAlg;
//use NumPHP\Core\NumPHP;

class carlos extends CI_Controller{

	//public $texto=array(array()); 

    public function __construct(){

        $this->texto['Error']='<b>Bienvenido:<br>recuerde que una funcion de tranferencia es de la forma $$ H(s)= \frac{p_{num}}{P_{den}}=\frac{as^x+bs^{x-1}+bs^{x-2}+...+cs^2+ds+c}{as^n+bs^{n-1}+bs^{n-2}+...+cs^2+ds+c} $$';
        $this->texto['Error']=$this->texto['Error'].'donde: \(x <  n.\) siendo x y n el grado de los polinomios en un sistema real modelado<br><b>'; 
        $this->texto['raices'][0]=""; 
        $this->texto['raices'][1]=""; 
        $this->texto['tf']="";
        $this->texto['Fparciales']="";
        $this->texto['inversaplace']="";
        $this->texto['puntos_grafica']=array();
        $this->texto['tiempos']=array();
        $this->texto['pCeros']=0;
        $this->texto['pPolos']=0;
         parent::__construct();
    }

	public function index()
	{

		//$this->calcular();
		$this->load->view('portadacarlos',$this->texto); 
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
        //redirect("error404");
    }

	public function calcular()
    {


        $this->librerias();
        $this->texto['Error']=NULL;
        $pCeros=$this->input->post("ceros");
        $pPolos=$this->input->post("polos");
        $this->texto['pCeros']=$pCeros;
        $this->texto['pPolos']=$pPolos;
        $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
        $camsz=new polinomio(array(2,5));
        $operador=new polinomio(array(4,3,5,0,5,1));//8,6,10,0,10,2
        echo $camsz->mulPor($operador);

       
        if(count($this->textbox2tf->arpolos())>count($this->textbox2tf->arceros()))
        {
           $polos=Raices::calculaRaices($this->textbox2tf->arpolos());

            if(count($this->textbox2tf->arceros())>1)
            {
              $ceros=Raices::calculaRaices($this->textbox2tf->arceros());
              $this->texto['raices'][0] = "<br>Ceros del sistema   ".stringlatex::ImpRoos($ceros)."   <br>";
            }
            else $this->texto['raices'][0] =  "sistema tiene ".count($polos). " ceros en el infinito";
            $this->texto['raices'][1] = "<br>Polos del sistema   ".stringlatex::ImpRoos($polos)."   <br>";
        	//identificacion de el polo dominante de sistema para la identificacion de sistemas dinamicos
            $k=0;
            $por=array();
            for($i=0; $i <count($polos); $i++)
            {
            	 $porno=$polos[$i][0];
            	 if($porno!=0)
                 {	
            	 	$por[$k]=abs($porno);
            	 	$k++;
            	 }
            }
            if(count($por)>=1)
            {
            	$tiempo_respuesta=4/min($por);
            	echo $tiempo_respuesta;
        	}
            else $tiempo_respuesta=pow($this->textbox2tf->arpolos()[count($polos)],1/count($polos))+10;
        	
            $muestras=99;
            $muestreo= $tiempo_respuesta/$muestras;

            $obj=new Raices2poligrup($polos);
            $this->texto['tf'] =  "   Funcion de tranferencia expresada de la forma<br>".stringlatex::latexPrintTF($this->textbox2tf->arceros(),$this->textbox2tf->arpolos(),1);
            $pruebafracpar=new FracParcial($this->textbox2tf->arceros(),$this->textbox2tf->arpolos());
            $pruebafracpar->OutFracPar();
          
            for($p=0;$p<count($pruebafracpar->OutFracPar());$p++)
            {
                $this->texto['Fparciales'] = $this->texto['Fparciales']. "   Fraccion parcial A".$p."<br>".stringlatex::latexPrintTF($pruebafracpar->OutFracPar()[$p][0],$pruebafracpar->OutFracPar()[$p][1],1);
                
                $datopruba1=new paragrafica();
                $datopruba1->datosgrafica($pruebafracpar->OutFracPar(),0);
                $datopruba1->ilaplace($p,1);
                $this->texto['inversaplace'] = $this->texto['inversaplace']."Solucion".$datopruba1->String();
             }
          //seccion de graficado  
    $dibujar=array();
    $tiempos=array();
    $contenedor=array(array());
    $dibujar[0]=0;
    $datopruba1=new Paragrafica();
    $datopruba1->datosgrafica($pruebafracpar->OutFracPar(),0);
    for($p=0;$p<count($pruebafracpar->OutFracPar());$p++){
       //echo var_dump($pruebafracpar->OutFracPar()[$p])."<br>";    
        $tx=0;
        $t=0;
        do{
            $contenedor[$t][$p]=$datopruba1->ilaplace($p,$tx);
           // echo $contenedor[$t][$p]." $t <br>";
            $tiempos[$t]=round($tx,1);
            $tx=$tx+$muestreo;
            $t++;
        }while ($tx <= $tiempo_respuesta);
     }
     $dato=count($contenedor);
     //echo "<hr>$dato<hr>";
     for($t=0;$t<$dato; $t++){
     	if(count($pruebafracpar->OutFracPar())<=1){
			//echo $contenedor[$t][0]."<br>";
			$dibujar[$t]=$contenedor[$t][0];
     	}else {
	        for($p=1; $p<count($pruebafracpar->OutFracPar());$p++){
	            $datox=$contenedor[$t][$p-1];
	            $datox=$datox+$contenedor[$t][$p];
	            //$contenedor[$t][$p]."<br>";
	            $dibujar[$t]=$datox;
	        }
        }
     }
         $this->texto['puntos_grafica']= json_encode($dibujar);     
         $this->texto['tiempos']= (json_encode($tiempos));
         
         
        }elseif($pCeros==NULL &&  $pPolos==NULL) $this->texto['Error'] = "<b>Bienvenido:<br> Ingrese los valores para poder calcular los datos de la funcion<br><b>";
        else $this->texto['Error'] = "<b><span style=\"color:red;\">Recuerde que:<br>Un sistema real modelado, <br>el orden del numerador no puede ser mayor o igual al orden del denominador</b>";
            $this->load->view('portadacarlos',$this->texto); 
	
	}


}
