<?php
class Bode{
    public static function plotFase($num,$den){
	    $polos=Raices::calculaRaices($den);
	    $ceros=Raices::calculaRaices($num);
	    $frecs=self::frecuencias($polos);
$maxF = max($frecs);
        $ninF = min($frecs);  
        $a=$ninF/1000;
        $b=$maxF*20;
	    if($ninF==0){
	        $a=1/$b;
            //$b=$maxF+$b;
	    }
	    $a=abs($b-$a)/10000;
	   // echo  " esta aqui ".$a." b=".$b."  div ".$b/$a;
           $bode='[';
           $hcx=0; 
           $hcc=0;
            $frec=$a/10000;
           if(count($num)>1){
        	    do{
                  //echo $b."  iter=".$a."  frec=".$frec." | ";
                  $bode=$bode.","; 
        	      $num = self::calculador1($ceros,$frec);
        	      $den = self::calculador1($polos,$frec); 
                  $Hs=-$num+$den;
        	      $frec=$frec+$a;
        	      //echo " ".$frec." | ".$a." | ";
        	      $hc=round(self::rad2deg($Hs),4);
        	      $bode=$bode."{x:$frec,y:$hc,}";
        	    }while($frec<$b);   
        	}else{
        	    $mag=$num[0];
        	    $numx=new Complejo($mag,0);
        	    do{
                      $bode=$bode.","; 
                      $num = atan($numx->i/$numx->r);
                      $den = self::calculador1($polos,$frec);
            	      $frec=$frec+$a;
            	      //echo " ".$frec." | ".$a." | ";
            	      $hc=-round(self::rad2deg($num),4)+round(self::rad2deg($den),4);
            	      $bode=$bode."{x:$frec,y:$hc,}";
        	    }while($frec<=$b); 
        	}
        	$bode= $bode."]";
        	return $bode;
	}
	
	
	private static function frecuencias($polos) {
        if($polos==null) $polos=$this->polos;
        $z0=array();
        $z0_c=array();
        $real=array();
        $x=0;
        $frecuencias=array();
        for($i=0; $i<count($polos); $i++){
            if($polos[$i][1]>0){
                $z0[]=new Complejo($polos[$i][0],$polos[$i][1]);
            }else if($polos[$i][1]<0){
                $z0_c[]=new Complejo($polos[$i][0],$polos[$i][1]);
            }else if($polos[$i][1]==0) $real[]=$polos[$i][0];
        }
        
        if(count($z0)==count($z0_c)){
            //unset($zo_c);
            //echo "entro  ";
            for($x=0;$x<count($z0);$x++){
                $a=Complejo::add($z0[$x],new Complejo($z0[$x]->r,-$z0[$x]->i));
                $b=Complejo::mul($z0[$x],new Complejo($z0[$x]->r,-$z0[$x]->i));
                $frecuencias[]=abs(round(sqrt($b->r),4));
            }
        }
        for($x=0;$x<count($real);$x++){
                $frecuencias[]=abs($real[$x]);
        }
        return $frecuencias;
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
    
    
    //no tocar 
    
    private static function rad2deg($arg) {
        return $arg*360/(2*pi());
    }

    private static function calculador2($arr,$frec,$sig=0){
        $hcc=0;
        for($ii=0; $ii<count($arr); $ii++){
            $sumax=Complejo::add(new Complejo($arr[$ii][0],$arr[$ii][1]),new Complejo(0,$frec));
            
            //$p=Complejo::abs($sumax);
            $p=sqrt( ($sumax->r*$sumax->r)+($sumax->i*$sumax->i) );
            if($p==0) $hcc=$hcc;
            elseif($sig===0) $hcc=$hcc+20*log10($p);
            else $hcc=$hcc-20*log10($p);
        }
        return $hcc;
    }


	public static function plotBode($num,$den){
	    $polos=Raices::calculaRaices($den);
	    $ceros=Raices::calculaRaices($num);
	    $frecs=self::frecuencias($polos);
        $maxF = max($frecs);
        $ninF = min($frecs);  
        $a=$ninF/1000;
        $b=$maxF*20;
	    if($ninF==0){
	        $a=1/$b;
            //$b=$maxF+$b;
	    }
	    $a=abs($b-$a)/5000;
	   // echo  " esta aqui ".$a." b=".$b."  div ".$b/$a;
           $bode='[';
           $hcx=0;
           $hcc=0;
            $frec=$a/10000;
           if(count($num)>1){
        	    do{
        	        
        	       $bode=$bode.",";
                   $hcc=self::calculador2($ceros,$frec);    
        	       $hcx=self::Calculador2($polos,$frec,1);
        	      // echo $hcc." -- ".$hcx." | ";
        	       $frec=$frec+$a;
        	      // echo " ".$frec." | ".$b." |- ";
        	       $hc=round($hcc+$hcx,3);
        	       //echo'<script>alert("$hc: '.$hc.'");</script>';
        	       $bode=$bode."{x:$frec,y:$hc,}";
        	        
        	    }while($frec<=($b));     
        	}else{
        	   // echo $num[0];
        	    $mag=$num[0];
        	    $h=20*log10(abs($mag));
        	    do{
        	       $hcx=0;
        	       $bode=$bode.",";        	        
        	       $hcx=self::Calculador2($polos,$frec,1);
        	       $frec=$frec+$a;
        	       //echo " | ".$frec." + ".$a." =  ".$b." |- ";
        	       $hc=round($h+$hcx,3);
        	       $bode=$bode."{x:$frec,y:$hc,}";
        	      
        	    }while($frec<$b);  
        	}
        	$bode= $bode."]";
        	return $bode;
	}
	
	
	
}
?>