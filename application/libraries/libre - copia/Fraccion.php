<?php 

class Fraccion{

    public $numpol;
    public $denpol;
    public $varx;

    public $a,$b;
    public function __construct($numpolx=array(0,0),$denpolx=array(0,1),$var="k"){
        //$this->numpol=$numpolx;
        //$this->denpol=$denpolx;
        $this->varx=$var;
        //verifica si es un objeto
        if(is_object($numpolx) && is_object($denpolx)){
            if(get_class($numpolx)=="Polinomio" && get_class($denpolx)=="Polinomio"){
                if($numpolx->grado()==1 && $denpolx->grado()==1){
                    if($numpolx->polinomio[0]==0){
                        $this->numpol=new Polinomio(array(0,$numpolx->polinomio[1]/$denpolx->polinomio[1]));
                        $this->denpol=new Polinomio(array(0,1));
                        //$this->numpol=$numpolx;
                        //$this->denpol=$denpolx;
                    }else{
                        $this->numpol=$numpolx;
                        $this->denpol=$denpolx;
                    }
                }else{
                    $this->numpol=$numpolx;
                    $this->denpol=$denpolx;
                }
            }
        }else{
            //$this->numpol=$numpolx;
            //$this->denpol=$denpolx;
        }
    }

    public function fracSumar($fraccion){
        $a=$this->numpol;
        $b=$this->denpol;
        $c=$fraccion->numpol;
        $d=$fraccion->denpol;

        $m = $b->mulPor($c);
        $x = $a->mulPor($d);

        $num= $m->sumPor($x);
        $den = $b->mulPor($d);
        return $this->simplificar(new Fraccion($num,$den,$this->varx));
    } 

    public function fracRes($fraccion){
        $a=$this->numpol;
        $b=$this->denpol;
        $c=$fraccion->numpol;
        $d=$fraccion->denpol;
        $num = $b->mulPor($c)->resPor($a->mulPor($d));
        $den = $b->mulPor($d);
        return $this->simplificar(new Fraccion($num,$den,$this->varx));
    }

    public function fracMul($fraccion){
        $a=$this->numpol;
        $b=$this->denpol;
        $c=$fraccion->numpol;
        $d=$fraccion->denpol;
        $num = $a->mulPor($c);
        $den = $b->mulPor($d);
        return $this->simplificar(new Fraccion($num,$den,$this->varx));
    }

    private function simplificar($fraccion){
        //es importante hacer sustitucion 
        $numpol=$fraccion->numpol->polinomio;
        $denpol=$fraccion->denpol->polinomio;
        $num=array();
        $den=array();
        
        $this->a=$fraccion->numpol->grado();
        $this->b=$fraccion->denpol->grado();

        return new Fraccion($fraccion->numpol,$fraccion->denpol,$this->varx);
    }

    public function fracDiv($fraccion){
        $a=$this->numpol;
        $b=$this->denpol;
        $c=$fraccion->numpol;
        $d=$fraccion->denpol;
        $num = $a->mulPor($d);
        $den = $b->mulPor($c);
        return $this->simplificar(new Fraccion($num,$den,$this->varx));
    }

    public function __toString(){
        //$this->load->library('libre/Stringlatex2');
        $a=$this->denpol->var=$this->varx;
        $b=$this->numpol->var=$a=$this->denpol->var;
        $b=$this->numpol->polinomio;
        $a=$this->denpol->polinomio;
        $contarnum=count($a);
        $contarden=count($b);
        //if($b=$this->numpol->polinomio[1]!=0){ 
             //return "orden mun= ".count()." ordenden= ".$this->numpol->grado();
             return '$$ \frac{'.$this->numpol."}{".$this->denpol.'}  $$';
        //}
        //else return "0";

	}
}

?>