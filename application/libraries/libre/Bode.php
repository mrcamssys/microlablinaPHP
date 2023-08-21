<?php
class Bode{
    private $tf;
    //dos entradas de objetos de tipo polinomio
    public function __construct($num="",$den=""){
        if($num!="" & $den!=""){
            $this->tf=new tf($num,$den);

        }
       //$this->puntosgrafica();
    }

    public function puntosgrafica(){
        $texto="";
        $frec=array();
        $mysistema=$this->tf;
        $cantpolos=count((array) $mysistema->fracparcial())-1;
        $cantceros=count((array) $mysistema->getcerostf());
        $cantrep=$mysistema->fracparcial()->cantrepetidas();
        $Fmin=pow(10, -$cantceros);
        //$Fmax=pow(10, $cantpolos-$cantrep);
        
        //$frec[]=$Fmin;


        $datospolos=$mysistema->fracparcial();

        for($p=0;$p<count((array)$datospolos->OutFracPar()); $p++){
            $canterm=count((array)$datospolos->OutFracPar()[$p][1])."<br>";
            if($canterm==2){
                $frecu=abs($datospolos->OutFracPar()[$p][1][1]);

                //$frecu=abs($datospolos->OutFracPar()[$p][1][1])+0.8*$frecu=abs($datospolos->OutFracPar()[$p][1][1]);
                if($frecu==0) $frec[]=1;
                else{
                   $frec[]=$frecu; 
                } 
                //$texto=$texto.$frecu."<hr>";    
            }elseif($canterm==3){
                $frecu=sqrt(abs($datospolos->OutFracPar()[$p][1][2]));
                //$frec[]=$frecu;
                $frec[]=abs($frecu-$frecu*0.0000001);
                $frec[]=abs($frecu-$frecu*0.00001);
                $frec[]=abs($frecu-$frecu*0.001);
                $frec[]=abs($frecu-$frecu*0.01);
                $frec[]=abs($frecu+$frecu*0.0000001);
                $frec[]=abs($frecu+$frecu*0.00001);
                $frec[]=abs($frecu+$frecu*0.001);
                $frec[]=abs($frecu+$frecu*0.01);
                $zeta=abs(sqrt($datospolos->OutFracPar()[$p][1][1]))/(2*$frecu);
                $frec[]=abs($frecu-$frecu*0.3);
                $frec[]=abs($frecu+$frecu*0.4);
                //$texto=$texto.$frecu." zeta= ". $zeta."<hr>";
            }
        }

        $Fmax=pow(10,(int)strlen((int)max($frec))+1);
        $frec[]=pow(10,(int)strlen((int)max($frec)));
        $Fmin=pow(10,-(int)strlen((int)min($frec))-1);
        $frec[]=pow(10,-(int)strlen((int)min($frec)));
       /* $data=$Fmin;
        $Fmin2=$Fmin/10;
        for($i=$Fmin; $i<$Fmax; $i++){
            $frec[]=$data+$Fmin2;
        }*/

        $m=$Fmin;
        //$incre=abs($Fmax-$Fmin)/50;    
        $incre=abs($Fmin)*10; 
        do{
           $m=$m+$incre;
           $frec[]=$m;
        }while($m<$Fmax);

        $frec[]=$Fmax;
        $frec[]=$Fmin;

        sort($frec);
/*
        for($i=0; $i<count((array)$frec); $i++){
            $texto=$texto.$frec[$i]."<hr>";
        }
*/
        $this->texto =$texto." Max=".$Fmax." min=".$Fmin." rep=".$cantrep." raiz=".sqrt(7.4627e-3);
        return $frec;
    }    

    private function array2complejo($matriz){
        $po=array();

        for($i=0; $i<count((array)$matriz); $i++){
            $po[$i]=new Complejo(-$matriz[$i][0],-$matriz[$i][1]);
            //$texto=$texto.$po[$i]."<hr>";
        }
        return $po;
    }

    public function magnitud(){
        $texto="";
        $mysistema=$this->tf;
        $num=$mysistema->num->polinomio;
        $den=$mysistema->den->polinomio;
        $texto=$texto."<h3>Preparando Algoritmos---</h3>";
        $wn=$this->puntosgrafica();//arreglo con valores reales
        $mag=array();
        $jw=0;
        $datos="";
        for($s=0; $s<count((array)$wn); $s++){
            $jw=new Complejo(0,$wn[$s]);
            $n=limiteP::limitePolCoplex($num,$jw);
            $d=limiteP::limitePolCoplex($den,$jw);
            $mag[$s]=20*log10( Complejo::abs($n))-20*log10(sqrt(pow($d->r, 2)+pow($d->i, 2)));
            $datos=$datos."{x:".$wn[$s].", y:".$mag[$s]."}";
            if($s<count((array)$wn)-1)  $datos=$datos.",";    
        }
        return "[".$datos."]";
    }

    private static function rad2deg($arg) {
        return $arg*360/(2*pi());
    }

    private static function calculador1($arr,$frec){
        $sumador=0;
        for($ii=0; $ii<count($arr); $ii++){
            $sumax=Complejo::add(new Complejo($arr[$ii][0],$arr[$ii][1]),new Complejo(0,$frec));
            if($sumax->r!=0)  $sumador=$sumador+atan($sumax->i/$sumax->r);
            else if($sumax->i < 0) $sumador=$sumador+1.57079;//tan(inf)
            else if($sumax->i > 0) $sumador=$sumador-1.57079;//tan(-inf)
            else if($sumax->r == 0)  $sumador=$sumador+1.57079;//tan(+inf)
            //else if($sumax->r > 0) $sumador=$sumador-1.57079;//tan(-inf)
            else $sumador=$sumador+atan($sumax->i/$sumax->r);
            
        }
        return $sumador;
    }

     public function fase(){
        $mysistema=$this->tf;
        $ceros=$mysistema->getcerostf();
        $polos=$mysistema->getpolostf();
        $wn=$this->puntosgrafica();
           $bode='[';
           if(count((array)$mysistema->num->polinomio)>1){
                for($s=0; $s<count((array)$wn); $s++){
                  //echo $b."  iter=".$a."  frec=".$frec." | ";
                  $bode=$bode.","; 
                  $num = self::calculador1($ceros,$wn[$s]);
                  $den = self::calculador1($polos,$wn[$s]); 
                  $Hs=-$num+$den;
                  //echo " ".$frec." | ".$a." | ";
                  $hc=   self::rad2deg($Hs)   ;
                  $bode=$bode."{x:".$wn[$s].",y:$hc}";
                } 
            }else{
                $mag=$mysistema->num->polinomio[0];
                $numx=new Complejo($mag,0);
                 for($s=0; $s<count((array)$wn); $s++){
                      $bode=$bode.","; 
                      $num = atan($numx->i/$numx->r);
                      $den = self::calculador1($polos,$wn[$s]);
                     
                      //echo " ".$frec." | ".$a." | ";
                      $hc=-   self::rad2deg($num)   +   self::rad2deg($den)   ;
                      $bode=$bode."{x:".$wn[$s].",y:$hc}";
                } 
            }
            $bode= $bode."]";
            return $bode;
    }


    public function __toString(){
        $this->magnitud();
        return $this->texto;
    }

}


?>



