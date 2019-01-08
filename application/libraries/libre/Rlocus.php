<?php
class Rlocus{
        private $cpolos; //numero de polos
        private $cceros; //numero de ceros
        private $polos; //polos del sistema
        private $ceros; //ceros del sistema
        private $kdib; // k de movimento de polos
        private $N; //numero de polos mmenos numero de ceros;
        private $trans;
        
        public function __construct($num=array(),$den=array(),$tc="G(s)H(s)") {
          $this->trans=new Tf($num,$den,$tc);
          $this->getpolosyceros();
          $this->kdib=array();
        }
        
//seccion de pasos para graficado:
        //caso 1 (encontrar los polos y ceros del sistema)
        public function getpolosyceros(){
            $datoscliente="";
            $this->polos= $this->trans->getpolostf();
            if(count($this->trans->num->polinomio)==1){
                $this->ceros= null;
                $this->cceros=0;
            }else{
                $this->ceros= $this->trans->getcerostf();
                $this->cceros=count($this->ceros);
            }
            
            $this->cpolos=count($this->polos);
            $this->N=($this->cpolos)-($this->cceros);
            return $datoscliente;
        }
//------fin caso-----        

        //caso 2 Centroide y angulo de las asisntotas
        public function centroide(){
            $sumpolos=new Complejo();
            for($i=0;$i<$this->cpolos;$i++){
                $sumpolos=$sumpolos::add($sumpolos,new Complejo($this->polos[$i][0],$this->polos[$i][1]));
            }
            
            //suma de CEROS
            $sumceros=new Complejo();
            if(count($this->ceros)>1){
                for($i=0;$i<$this->cpolos;$i++){
                    $sumceros=$sumceros::add($sumceros,new Complejo($this->ceros[$i][0],-$this->ceros[$i][1]));
                }
            }
            
            $cenum=$sumpolos::sub($sumpolos,$sumceros);
            return -round($cenum->r/$this->N,4);
        }
        
        public function cAngulos(){
            $texto['phi']="";
            $angulos=array();
            for($i=0;$i<abs($this->N-1);$i++){
               $phix=(180/$this->N)*(2*$i+1);
               $phix=$phix/180;
               $phix=substr( $phix, strpos( $phix, "." ) );
               $phix=abs(round(180*$phix,4));
               $texto['phi']=$texto['phi']."$$ \phi_{$i} =\pm".$phix."°$$";
               $angulos[]=$phix;
            }
            return array($texto['phi'], $angulos);
        }
//------fin caso-----


        //caso 3: puntos de corte con el eje imaginario
        public function puntoscorte(){
            $poli=$this->trans->den->polinomio;
            $cpoli=$this->trans->den->grado();
            
            
        }
//-----fin caso------
        
        
        
        //fin de pasos para graficado
        
        public function __toString(){
            return '$$ '.$this->ident.'=\frac{'. stringlatex::latexpoli($this->num->polinomio).'}{'. stringlatex::latexpoli($this->den->polinomio).'} $$';
        }
     
}
?>

