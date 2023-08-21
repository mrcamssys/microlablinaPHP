<?php



class Paragrafica{

    private $polinomios;
    private $tiempo;
    public $texto;
   
    /*public function __construct($polinomios=array(), $tiempomax=0){
        $this->polinomios=$polinomios;
        $this->tiempo=$tiempomax;
    }*/
    
    public function datosgrafica($polinomios, $tiempocom=0){
        $this->polinomios=$polinomios;
        $this->tiempo=$tiempocom;
    }

    public function ilaplace($npol,$t){
        $resultado=0;
        $cantnum=count($this->polinomios[$npol][0]);
        $cantden=count($this->polinomios[$npol][1]);
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $data=count((array)$this->polinomios[$npol]);
        if($data>2) $cantnum=3; //numeros reales repetidos

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

        if($cantnum==3){
            //$this->texto="Exerimental";
            //$resultado=3*$t;
            $resultado=$this->nfatalaN($npol,$t, $this->polinomios[$npol][3]);

        }else{
            //$resultado=$this->ilexcossinsin($npol,$t);
            //$resultado=$this->ilexcos($npol,$t);
            //$resultado=$this->ilsen($npol,$t);
            //$this->texto=$this->texto."<div class=\"alert alert-info\"><center>Al parecer el dato para esta variable no</center></div>";
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
        $a=   $num[1]  ;
        $b=   $den[2]  ;
        $k=    $a/sqrt($b)  ;
        $this->texto= "<div class=\"table-responsive\"> $$ h_{$npol}(t)=  (".sprintf('%.2e', number_format($k,15)).") \sin(\sqrt{(".   sprintf('%.2e', number_format(-$b,15) ) .")} t) $$ </div>";
        return $k*sin(sqrt($b)*$t);
    }

    public function ilcos($npol,$t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=   $num[1]  ;
        $b=   $den[2]  ;
        if($b>0){ $k= $a/sqrt($b);

        $this->texto= "<div class=\"table-responsive\"> $$ h_{$npol}(t)=  (".sprintf('%.2e', number_format($k,15)).") \cos(\sqrt{(". sprintf('%.2e', number_format(-$b,15) ) .")} t) $$</div>";
            return $k*cos(sqrt($b)*$t);
        }

        return 0;
    }

    
    public function ilexp($npol, $t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $k=   $num[0]  ;
        $p=   $den[1]  ;
        
        $this->texto= "<div class=\"table-responsive\"> $$ h_{$npol}(t)=   (".sprintf('%.1e', number_format($k,15)).")  e^{(".  sprintf('%.2e', number_format(-$p,15) ) .")t} $$ </div>";
        return $k*exp(-$p*$t);
    }
    
    public function ilt($npol, $t){
        $num=$this->polinomios[$npol][0];
        //$den=$this->polinomios[$npol][1];
        $k=   $num[0]   ;
        //$p=$den[1];
        


        $this->texto= "<div class=\"table-responsive\"> $$ h_{$npol}(t)=  (".  sprintf('%.2e', number_format(-$k,15) ) .") t $$</div>";
        return -$k*$t;
        
    }
    
    public function ilexsen($npol,$t){
        
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        
        //$a=$num[0];
        $b=$num[1];
        $c=$den[1];
        $d=$den[2];
        
        $p=   $c/2  ;
        $w=   sqrt($d-$p*$p)  ;
        $arg=    $b/$w  ;        
     
        $this->texto= "<div class=\"table-responsive\"> $$ h_{$npol}(t)=   (".sprintf('%.2e', number_format($arg,15)).")  e^{(". sprintf('%.2e', number_format(-$p,15) )   .") t} \sin(". sprintf('%.2e', number_format($w,15) )  ."t)  $$</div>";
        //echo exp(-$p*$t)*$arg*sin($w*$t)."<br>";
        return exp(-$p*$t)*$arg*sin($w*$t);
    } 
    
    
    public function ilexcos($npol,$t){
        
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=   $num[0]  ;
        $b=   $num[1]  ;
        $c=   $den[1]  ;
        $d=   $den[2]  ;
        
        $k=   $c/2  ;
        $m=   $b/$a  ;
        $p=   $d-$k*$k  ;
        
        $w=   sqrt($p)  ;
        $arg=   $a*($k-$m)/$w  ;
        
        //$pp=$a*$c*$c;
        $cos = "<div class=\"table-responsive\"> $$ h_{$npol}(t)=  e^{(".   sprintf('%.2e', number_format(-$k,15) )    .")t} ($a \cos(\sqrt{(".   sprintf('%.2e', number_format($P,15) )   .") t}) $$</div>";
        $texto=$cos;

        $this->texto=$texto;
        return exp(-$k*$t)*($a*cos($w*$t)+$arg*sin($w*$t));
        
    }    
    
    public function ilexcossinsin($npol,$t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=   $num[0]  ;
        $b=$num[1];
        
        $c=$den[1];
        $d=$den[2];
		$aa=   -$c/2   ;
        $texto="<div class=\"table-responsive\">Problemas con el sistema</>";
		$bb=   sqrt($d-($c*$c)/4)   ;
		if($bb>0){  
    		$cc=   (1/$bb)*($b-($a*$c)/2)   ;
    		
    		$this->texto="<div class=\"table-responsive\"> $$ h_{$npol}(t)=  e^{(".   sprintf('%.2e', number_format($aa,15) )  .")t}(";
    		if($a!=0) $this->texto=$this->texto."(". sprintf('%.2e', number_format($a,15) ) .')\cos{('.   sprintf('%.2e', number_format($bb,15) )  .') t}';
    		if($cc>0) $this->texto=$this->texto."+(".   sprintf('%.2e', number_format($cc,15) )   .")\sin{(".sprintf('%.2e', number_format($bb,15) ) .") t})$$ </div>";
    		if($cc<0) $this->texto=$this->texto."-(".   sprintf('%.2e', number_format(-$cc,15) )   .")\sin{(".   sprintf('%.2e', number_format($bb,15) )  .") t})$$ </div>";
            if($cc==0) $this->texto=$this->texto.")$$ </div>";

    		return exp($aa*$t)*($a*cos($bb*$t)+$cc*sin($bb*$t));

        }else return 0;

    }    
/*
    public function ilexcossinsin($npol,$t){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $a=   $num[0]  ;
        $b=$num[1];
        $pp="";


        $c=$den[1];
        $d=$den[2];
        $aa=   -$c/2   ;
    
        $bb=   sqrt($d-($c*$c)/4)   ;
        
        $cc=   (1/$bb)*($b-($a*$c)/2)   ;
        
        if($aa!=0){
           $this->texto="e^{".   $aa  ."t}(";
           $pp=")";
        }else{
            $this->texto="";
        }

        
        if($a!=0) $this->texto=$this->texto.   $a  .'\cos{'.   $bb  .' t}';
        if($cc>0) $this->texto=$this->texto."+".   $cc  ."\sin{".   $bb  ." t}";
        if($cc<0) $this->texto=$this->texto."".   $cc  ."\sin{".   $bb  ." t}";
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

    public function nfatalaN($npol,$t, $grado){
        $num=$this->polinomios[$npol][0];
        $den=$this->polinomios[$npol][1];
        $dato="";
        //$funcion=0;
        $pot=$grado-2;
        $elevado=self::nfactorial($pot);
        $k=1/$elevado;
        $k=$k*$num[0];
        $polo=-$den[1];
        if($den[1]==0){
            $dato="<div class=\"table-responsive\"> $$ h_{$npol}(t)= "; 
            $dato=$dato."".$k."t^{".$pot."}";
            $dato=$dato."$$ </div>";
            $funcion= $k*pow($t, $pot);
        }else{
            $dato="<div class=\"table-responsive\"> $$ h_{$npol}(t)= "; 
            $dato=$dato."(".$k.") t^{".$pot."} e^{".$polo."t}";
            $dato=$dato."$$ </div>";
            $funcion=$k*$t**$pot*exp($polo*$t);
        }

        

        $this->texto=$dato;

        return $funcion;
    }


//caso especial $npol polos reaales repetidos en el sistema
    public function iltnExp($npol,$t){
        $num=$this->polinomios[$npol][0];
        $denelev=$this->polinomios[$npol][1];

        $elevado=$denelev[0];
        $den=$denelev[1];

        $a=   $num[0]  ;
        $b=$num[1];

        $c=$den[1];
        $d=$den[2];



        $aa=   -$c/2   ;
    
        $bb=   sqrt($d-($c*$c)/4)   ;
        
        $cc=   (1/$bb)*($b-($a*$c)/2)   ;

        $this->texto="<div class=\"table-responsive\"> $$ h_{$npol}(t)=  e^{".$aa."t}(";
        if($a!=0) $this->texto=$this->texto."(". sprintf('%.2e', number_format($a,15)) .')\cos{('.  sprintf('%.2e', number_format($bb,15)) .') t}'."$$ </div>";
        if($cc>0) $this->texto=$this->texto."+(". sprintf('%.2e', number_format($cc,15)) .")\sin{(".  sprintf('%.2e', number_format($bb,15)) .") t})$$ </div>";
        if($cc<0) $this->texto=$this->texto."(". sprintf('%.2e', number_format($cc,15)) .")\sin{(".  sprintf('%.2e', number_format($bb,15)) .") t})$$ </div>";
        
        return exp($aa*$t)*($a*cos($bb*$t)+$cc*sin($bb*$t));

    }    

    


    public function String(){
        //$this->texto; 
      return $this->texto;
    }

}





?>