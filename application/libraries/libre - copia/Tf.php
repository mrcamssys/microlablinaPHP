<?php

class Tf{
        public $num;
        public $den;
        private $ident;
        
        public function __construct($num=0,$den=0,$ident="H(s)") {
          $num1=array();
          $den1=array();  
          if(is_array($num)==true && is_array($den)==true){
              //algoritmo de correccion de error
              $div=reset($den);
              for($i=0; $i<count((array)$num); $i++){
                $num1[]=$num[$i]/$div;
              }
              for($i=0; $i<count((array)$den); $i++){
                $den1[]=$den[$i]/$div;
              }
              //fin de algoritmo de correccion  
              $this->num=new Polinomio($num1);
              $this->den=new Polinomio($den1);
          }    
          if(is_object($num)==true && is_object($den)==true){

              $div=reset($den->polinomio);
              for($i=0; $i<count((array)$num->polinomio); $i++){
                $num1[]=$num->polinomio[$i]/$div;
              }
              for($i=0; $i<count((array)$den->polinomio); $i++){
                $den1[]=$den->polinomio[$i]/$div;
              }
              $num= new polinomio($num1);
              $den= new polinomio($den1);
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
              $texto['raices'][0] = "<br>Ceros del sistema   ".Stringlatex::ImpRoos((array)$ceros)."   <br>";
              $texto['raices'][0] = $texto['raices'][0]."<div class=\"alert alert-info\"><center>Adicionalmente el sistema tiene [".$p."] ceros en el infinito </center></div>";
            }
            else {
                $texto['raices'][0] =  "<div class=\"alert alert-info\">sistema tiene ".count((array)$polos). " ceros en el infinito </div>";
                $mag=$this->getcerostf()[0];
                $ceros=0;
            }
            $texto['raices'][1] = "<br>Polos del sistema   ".Stringlatex::ImpRoos((array)$polos)."<br>";
            return array($polos,$ceros, $texto['raices']);
        }
        
        public function getzptabla(){
            $polos=$this->getpolostf();
            $tabla=array();
            $polos=array_merge($polos);
            for($i=0; $i<count((array)$polos); $i++){
              $tabla[0][$i]="".round($polos[$i][0],4)."";
              if($polos[$i][0]!=0){
                $tabla[1][$i]=abs(round(3/$polos[$i][0],4));
                $tabla[2][$i]=abs(round(4/$polos[$i][0],4));
                $tabla[3][$i]=abs(round(5/$polos[$i][0],4));
              }else{
                $tabla[1][$i]="$$ \infty $$";
                $tabla[2][$i]="$$ \infty $$";
                $tabla[3][$i]="$$ \infty $$";
              }
            }  
            return $tabla;
        }

        //reparar sistema
        private function respusys(){
            //identificacion del polo mas lento
            //para la identificacion de sistemas dinamicos
            list($polos,$ceros)=$this->getzp();
            $k=0;
            $por=array();
            for($i=0; $i <count((array)$this->getpolostf()); $i++)
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
              $tiempo_respuesta=pow($this->den->polinomio[count((array)$polos)],1/count((array)$polos));
              if($tiempo_respuesta==0){
                $tiempo_respuesta=99.91;
              }else{
                if(count($polos)==2){
                    $tiempo_respuesta=1.85*((2*3.141592)/$tiempo_respuesta);
                }else $tiempo_respuesta=((2*3.141592)/$tiempo_respuesta);
              }
              
            }

        	
            $muestras=100;
            $muestras=0.55*$tiempo_respuesta/$muestras;
            $maximotiempo=0.55*$tiempo_respuesta;
            return array($muestras,$maximotiempo);
            //fin del timpo de respuesta
        }
        
        private function fracparcial(){
            return new FracParcial($this->num->polinomio,$this->den->polinomio);
        }
        
        public function getfracpar(){
            /**/
            $pruebafracpar=$this->fracparcial();
            $pruebafracpar->OutFracPar();
            $texto['Fparciales']="";
            $texto['inversaplace']="";
            $maxi=count((array)$pruebafracpar->OutFracPar());
            for($p=0;$p<$maxi;$p++)
            {   

                if(count((array)$pruebafracpar->OutFracPar()[$p])>2){
                    $texto['Fparciales'] = $texto['Fparciales']. "<div class=\"table-responsive\"> ".stringlatex::latexPrintTF($pruebafracpar->OutFracPar()[$p][0],$pruebafracpar->OutFracPar()[$p][1],2,$pruebafracpar->OutFracPar()[$p][2]-1,$p)."</div><hr>";
                }else{
                $texto['Fparciales'] = $texto['Fparciales']. "<div class=\"table-responsive\"> ".stringlatex::latexPrintTF($pruebafracpar->OutFracPar()[$p][0],$pruebafracpar->OutFracPar()[$p][1],1,0,$p)."</div><hr>";
                }
                
                $datopruba1=new paragrafica();
                $datopruba1->datosgrafica($pruebafracpar->OutFracPar(),0);
                $datopruba1->ilaplace($p,1);
                $texto['inversaplace'] = $texto['inversaplace'].$datopruba1->String()."<hr>";
             }
             $maxi=$maxi-1;
            $texto['Fparciales'] = $texto['Fparciales'].'<div class="alert alert-info" role="alert">Recuerde que para encontrar la funcion tranferencia equivalente el en mundo de la frecuencia debe aplicar: $$ H(s)=\sum_{k=0}^{'.$maxi.'} H_k(S) $$ </div>';


            $texto['inversaplace'] = $texto['inversaplace'].'<div class="alert alert-info" role="alert">Recuerde que para encontrar la solucion en el tiempo del sistema debe aplicar: $$ h(t)=\sum_{k=0}^{'.$maxi.'} h_k(t) $$ </div>';
            return array($texto['Fparciales'],$texto['inversaplace']);
        }
        
        public function getbode(){
            //$bode=Bode::plotBode($this->num->polinomio,$this->den->polinomio);
        	//$fase=Bode::plotFase($this->num->polinomio,$this->den->polinomio);
            $sys=new Bode($this->getcerostf(), $this->getpolostf(), $this->num, $this->den);
            //return array($bode,$fase);
            return $sys;
        }
        
        public function impulsotf(){
                $dibujar=array();
                $tiempos=array();
                $dibujar[0]=0;
                $datopruba1=new Paragrafica();
                $datopruba1->datosgrafica($this->fracparcial()->OutFracPar());
                list($muestreo,$tiempo_respuesta)=$this->respusys();
                $i=0;
                $sumas=0;
                $a=0;
                for($t=0; $t<=$tiempo_respuesta; $t=$t+$muestreo){
                    for($p=0;$p<count((array)$this->fracparcial()->OutFracPar());$p++){
                        $sumas=$sumas+$datopruba1->ilaplace($p,$t);
                    }
                    $dibujar[$a]=$sumas;
                    $tiempos[$a]=round($t,3);//$t;
                    $sumas=0;
                    $a++;
                }
                 return array("[".implode(',',$dibujar)."]","[".implode(",",$tiempos)."]");
        }
        
        
        
        public function gettf(){
            return array($this->num,$this->den);
        }
        
        

        
        public function __toString(){
            return '<div class="table-responsive ">$$ '.$this->ident.'=\frac{'. stringlatex::latexpoli($this->num->polinomio).'}{'. stringlatex::latexpoli($this->den->polinomio).'} $$</div>';
        }
     
}
?>
