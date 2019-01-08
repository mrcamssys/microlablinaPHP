<?php



class Paragrafica{

    private $polinomios;
    private $tiempo;
    public $texto;
    private $polelev;
   
    /*public function __construct($polinomios=array(), $tiempomax=0){
        $this->polinomios=$polinomios;
        $this->tiempo=$tiempomax;
    }*/
    
    public function datosgrafica($polinomios, $tiempomax,$polelev=null){
        $this->polinomios=$polinomios;
        $this->tiempo=$tiempomax;
        $this->polelev=$polelev;
    }

    public function ilaplace($npol,$t){
        $resultado=0;
        $cantnum=count($this->polinomios[$npol][0]);
        $cantden=count($this->polinomios[$npol][1]);
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];


        //seleccion de denominadores 

        if($cantnum==1){
            if($cantden==1) $this->texto="<br><font color=red>Error: num 1 den 1</font><hr>"; //por programar
            if($cantden==2) $resultado=$this->ilexp($npol, $t);
            if($cantden==3){
                if($den[1]==0) $resultado=$this->ilsen($npol,$t);
                else $resultado=$this->ilexsen($npol,$t);
               
           }
        }

        if($cantnum==2){
            if($cantden==1) $this->texto="<br><font color=red>Error: num 2 den 1</font><hr>"; //por programar
            if($cantden==2) $this->texto="<br><font color=red>Error: num 2 den 2</font><hr>";//por grogramar
            if($cantden==3){
                if($den[1]==0 && $num[1]==0) $resultado=$this->ilcos($npol,$t);
                if($den[1]!=0 && $num[1]==0) $resultado=$this->ilexcos($npol,$t);
                if($num[0]==0 && $den[1]==0) $resultado=$this->ilsen($npol,$t);
                else  $resultado=$this->ilexcossinsin($npol,$t);
               //$this->texto=$this->texto."<font color=red>entro aqui</font><hr>";
           }
        }


        if($this->polelev!=null){
            $this->iltnExp($npol,$t);
        }

        return $resultado;
    }




//pasa la funcion de tranferencia a ecuaciones en diferencias    
    public function ztrasn($npol,$t){
       $resultado=0;
        return $resultado;
    }

//fin del trazpazo


    public function ilsen($npol,$t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=round($num[1],5);
        $b=round($den[2],5);
        $k= round($a/sqrt($b),5);
        $this->texto= "$$ $k \sin(\sqrt{".round($b,3)."} t) $$";
        return $k*sin(sqrt($b)*$t);
    }

    public function ilcos($npol,$t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=round($num[1],5);
        $b=round($den[2],5);
        $k= round($a/sqrt($b),5);
        $this->texto= "$$ $k \sin(\sqrt{".round($b,3)."} t) $$";
        return $k*cos(sqrt($b)*$t);
    }

    
    public function ilexp($npol, $t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $k=round($num[0],5);
        $p=round($den[1],5);
        
        $this->texto= "$$ $k e^{".round(-$p,3) ."t} $$";
        return $k*exp(-$p*$t);
    }
    
    public function ilt($npol, $t){
        $num=$this->polinomios[$npol][0];
        //$den=$this->polinomios[$npol][1];
        $k=round($num[0],4);
        //$p=$den[1];
        
        $this->texto= "$$ ".round($k,3)." t $$";
        return $k*$t;
        
    }
    
    public function ilexsen($npol,$t){
        
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        
        //$a=$num[0];
        $b=$num[1];
        $c=$den[1];
        $d=$den[2];
        
        $p=round($c/2,5);
        $w=round(sqrt($d-$p*$p),5);
        $arg= round($b/$w,5);        
     
        $this->texto= "$$ $arg e^{".round(-$p,3)." t} \sin($w t)  $$";
        //echo exp(-$p*$t)*$arg*sin($w*$t)."<br>";
        return exp(-$p*$t)*$arg*sin($w*$t);
    } 
    
    
    public function ilexcos($npol,$t){
        
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=round($num[0],5);
        $b=round($num[1],5);
        $c=round($den[1],5);
        $d=round($den[2],5);
        
        $k=round($c/2,5);
        $m=round($b/$a,5);
        $p=round($d-$k*$k,5);
        
        $w=round(sqrt($p),5);
        $arg=round($a*($k-$m)/$w,5);
        
        //$pp=$a*$c*$c;
        $cos = "$$ e^{".round(-$k,3) ."t} ($a \cos(\sqrt{".round($p,3)." t) $$";
        $texto=$cos;

        $this->texto=$texto;
        return exp(-$k*$t)*($a*cos($w*$t)+$arg*sin($w*$t));
        
    }    
    
    public function ilexcossinsin($npol,$t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=round($num[0],5);
        $b=$num[1];
        
        $c=$den[1];
        $d=$den[2];
		$aa=round(-$c/2,4);
	
		$bb=round(sqrt($d-($c*$c)/4),4);
		
		$cc=round((1/$bb)*($b-($a*$c)/2),4);
		
		$this->texto="$$ e^{".round($aa,3)."t}(";
		if($a!=0) $this->texto=$this->texto.round($a,3).'\cos{'.round($bb,3).' t}';
		if($cc>0) $this->texto=$this->texto."+".round($cc,3)."\sin{".round($bb,3)." t})$$";
		if($cc<0) $this->texto=$this->texto."".round($cc,3)."\sin{".round($bb,3)." t})$$";
        if($cc==0) $this->texto=$this->texto.")$$";

		return exp($aa*$t)*($a*cos($bb*$t)+$cc*sin($bb*$t));

    }    
/*
    public function ilexcossinsin($npol,$t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=round($num[0],5);
        $b=$num[1];
        $pp="";


        $c=$den[1];
        $d=$den[2];
        $aa=round(-$c/2,4);
    
        $bb=round(sqrt($d-($c*$c)/4),4);
        
        $cc=round((1/$bb)*($b-($a*$c)/2),4);
        
        if($aa!=0){
           $this->texto="e^{".round($aa,3)."t}(";
           $pp=")";
        }else{
            $this->texto="";
        }

        
        if($a!=0) $this->texto=$this->texto.round($a,3).'\cos{'.round($bb,3).' t}';
        if($cc>0) $this->texto=$this->texto."+".round($cc,3)."\sin{".round($bb,3)." t}";
        if($cc<0) $this->texto=$this->texto."".round($cc,3)."\sin{".round($bb,3)." t}";
        if($cc==0) $this->texto=$this->texto.$pp;
        
        $this->texto="$$".$this->texto.$pp."$$";

        return exp($aa*$t)*($a*cos($bb*$t)+$cc*sin($bb*$t));
    }
*/

    public static function nfactorial($n){
        $r=1;
        if($n==0){
            $r=1;
        }else{
            for($k=1;$k<=$n; $k++){
                $r=$r*$k;
            }
        }
        return $r;
    }

//caso especial $npol polos reaales repetidos en el sistema
    public function iltnExp($npol,$t){
        $num=$this->polinomios[$npol][0];
        $denelev=$this->polinomios[$npol][1];

        $elevado=$denelev[0];
        $den=$denelev[1];

        $a=round($num[0],5);
        $b=$num[1];

        $c=$den[1];
        $d=$den[2];



        $aa=round(-$c/2,4);
    
        $bb=round(sqrt($d-($c*$c)/4),4);
        
        $cc=round((1/$bb)*($b-($a*$c)/2),4);
        
        $this->texto="$$ e^{".$aa."t}(";
        if($a!=0) $this->texto=$this->texto.$a.'\cos{'.$bb.' t}';
        if($cc>0) $this->texto=$this->texto."+".$cc."\sin{".$bb." t})$$";
        if($cc<0) $this->texto=$this->texto."".$cc."\sin{".$bb." t})$$";
        
        return exp($aa*$t)*($a*cos($bb*$t)+$cc*sin($bb*$t));

    }    

    


    public function String(){
        //$this->texto; 
      return $this->texto;
    }

}





?>