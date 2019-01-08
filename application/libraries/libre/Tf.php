<?php

class Tf{
        public $num;
        public $den;
        private $ident;
        
        public function __construct($num=0,$den=0,$ident="H(s)") {
          if(is_array($num)==true && is_array($den)==true){
              $this->num=new Polinomio($num);
              $this->den=new Polinomio($den);
          }    
          if(is_object($num)==true && is_object($den)==true){
              $this->num=$num;
              $this->den=$den;
          } 
          $this->ident=$ident;
        }
        
        
        
        public function getcerostf(){
            return Raices::calculaRaices($this->num->polinomio);
        }
        
        public function getpolostf(){
            return Raices::calculaRaices($this->den->polinomio);
        }
        
        public function getzp(){
            $polos=$this->getpolostf();
            $ceros=$this->getcerostf();
            if($this->num->grado()>=1)
            {
              $p=count($polos)-count($ceros);
              $texto['raices'][0] = "<br>Ceros del sistema   ".Stringlatex::ImpRoos($ceros)."   <br>";
              $texto['raices'][0] = $texto['raices'][0]."<div class=\"alert alert-info\"><center>Adicionalmente el sistema tiene [".$p."] ceros en el infinito </center></div>";
            }
            else {
                $texto['raices'][0] =  "<div class=\"alert alert-info\">sistema tiene ".count($polos). " ceros en el infinito </div>";
                $mag=$this->getcerostf()[0];
                $ceros=0;
            }
            $texto['raices'][1] = "<br>Polos del sistema   ".Stringlatex::ImpRoos($polos)." ceros=".$this->num->grado()."<br>";
            return array($polos,$ceros, $texto['raices']);
        }
        
        
        private function respusys(){
            //identificacion del polo mas lento
            //para la identificacion de sistemas dinamicos
            list($polos,$ceros)=$this->getzp();
            $k=0;
            $por=array();
            for($i=0; $i <count($this->getpolostf()); $i++)
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
            	if(min($por)>0)$tiempo_respuesta=10/min($por);
				else  $tiempo_respuesta=5/min($por);
            	//echo $tiempo_respuesta;
        	}
            else{
              $tiempo_respuesta=pow($this->den->polinomio[count($polos)],1/count($polos));
              $tiempo_respuesta=(2*3.141592)/$tiempo_respuesta;
            }

        	
            $muestras=200;
            
            return array($tiempo_respuesta/($muestras),$tiempo_respuesta);
            //fin del timpo de respuesta
        }
        
        private function fracparcial(){
            return new FracParcial($this->num->polinomio,$this->den->polinomio);
        }
        
        public function getfracpar(){
            $pruebafracpar=$this->fracparcial();
            $pruebafracpar->OutFracPar();
          $texto['Fparciales']="";
          $texto['inversaplace']="";
            for($p=0;$p<count($pruebafracpar->OutFracPar());$p++)
            {
                $texto['Fparciales'] = $texto['Fparciales']. "   Fraccion parcial A".$p."<br>".stringlatex::latexPrintTF($pruebafracpar->OutFracPar()[$p][0],$pruebafracpar->OutFracPar()[$p][1],1);
                
                $datopruba1=new paragrafica();
                $datopruba1->datosgrafica($pruebafracpar->OutFracPar(),0);
                $datopruba1->ilaplace($p,1);
                $texto['inversaplace'] = $texto['inversaplace']."Solucion".$datopruba1->String();
             }
             
             return array($texto['Fparciales'],$texto['inversaplace']);
        }
        
        
        
        
        public function getbode(){
            $bode=Bode::plotBode($this->num->polinomio,$this->den->polinomio);
        	$fase=Bode::plotFase($this->num->polinomio,$this->den->polinomio);
            return array($bode,$fase);
        }
        
        
        public function impulsotf(){
                $dibujar=array();
                $tiempos=array();
                $contenedor=array(array());
                $dibujar[0]=0;
                $datopruba1=new Paragrafica();
                $datopruba1->datosgrafica($this->fracparcial()->OutFracPar(),0);
                list($muestreo,$tiempo_respuesta)=$this->respusys();
                for($p=0;$p<count($this->fracparcial()->OutFracPar());$p++){
                    $tx=0;
                    $t=0;
                    do{
                        $contenedor[$t][$p]=$datopruba1->ilaplace($p,$tx);
                        $tiempos[$t]=round($tx,1);
                        $tx=$tx+$muestreo;
                        $t++;
                    }while ($tx <= $tiempo_respuesta);
                 }
                 $dato=count($contenedor);
                 for($t=0;$t<$dato; $t++){
                 	if(count($this->fracparcial()->OutFracPar())<=1){
            			$dibujar[$t]=$contenedor[$t][0];
                 	}else {
            	        for($p=1; $p<count($this->fracparcial()->OutFracPar());$p++){
            	            $datox=$contenedor[$t][$p-1];
            	            $datox=$datox+$contenedor[$t][$p];
            	            $dibujar[$t]=$datox;
            	        }
                    }
                 }
                 //$texto['puntos_grafica']= json_encode($dibujar);     
                 //$texto['tiempos']= (json_encode($tiempos));
                 return array("[".implode(',',$dibujar)."]","[".implode(",",$tiempos)."]");
        }
        
        
        
        public function gettf(){
            return array($this->num,$this->den);
        }
        
        public function __toString(){
            return '$$ '.$this->ident.'=\frac{'. stringlatex::latexpoli($this->num->polinomio).'}{'. stringlatex::latexpoli($this->den->polinomio).'} $$';
        }
     
}
?>
