<?php 
//require "complejo.php";

class Raices{
	const EPSS= 1e-7;
	const MR= 8;
	const MT= 10;
	const MAXIT = 80;
	const EPS   = 2.0e-6;
	const MAXM  = 100;
	
	private static function laguer($a, $m, $x){
		$err=0;
		$frac = array(0.0,0.5,0.25,0.75,0.13,0.38,0.62,0.88,1.0);
		//bandera error en php $x
		for ($iter=1;$iter<=80;$iter++) {
			$b=$a[$m];
			$err=Complejo::abs($b);
			$d=new Complejo(0,0);
			$f=new Complejo(0,0);
			$abx=Complejo::abs($x);
			for($j=$m-1;$j>=0;$j--) {
				$f=Complejo::add(Complejo::mul($x,$f),$d);
				$d=Complejo::add(Complejo::mul($x,$d),$b);
				$b=Complejo::add(Complejo::mul($x,$b),$a[$j]);
				$err=Complejo::abs($b)+$abx*$err;
				//echo "<br> errz  ". $err;
			}
			$err = $err*1e-7;
			//echo "<br> err". $err;
			//echo "<br> EPSS"+self::EPSS;
			
			if (Complejo::abs($b) <= $err){
				return ;
			}
		
			$g=Complejo::div($d,$b);
			$g2=Complejo::mul($g,$g);
			
			$h=Complejo::sub($g2,Complejo::muldo(2,Complejo::div($f,$b)));
			
			$sq=Complejo::sqrtz(Complejo::muldo(($m-1),Complejo::sub(Complejo::muldo($m,$h),$g2)));
			
			$gp=Complejo::add($g,$sq);
			$gm=Complejo::sub($g,$sq);
			$abp=Complejo::abs($gp);
			$abm=Complejo::abs($gm);
			if($abp < $abm) $gp=$gm;
			
			//$dx=((self::FMAX($abp,$abm) > 0.0 ? Complejo::div(new Complejo(($m,0.0),$gp) : )));
			if(self::FMAX($abp,$abm) > 0.0){
				$rata=new Complejo($m,0.0);
				$dx=Complejo::div($rata,$gp);
			}else{
				$rata2x=new Complejo(cos($iter),sin($iter));
				$dx=Complejo::mul(1+$abx, $rata2x);
			}
			
			$x1=Complejo::sub($x,$dx);
			if ($x->r == $x1->r && $x->i == $x1->i){
				return ;
				//break;
			}
			if($iter % 10!=0){
				$x->r=$x1->r;
				$x->i=$x1->i;
			}else{
				$temp=Complejo::sub($x,Complejo::mul($frac[$iter/10],$dx));
				//echo "<br> iteracion ".self::MT;
				//echo "<br> ->>>>>>>>>> iter ".$iter/10;
				$x->r=$temp->r;
				$x->i=$temp->i;
			}
		}
		echo "<br>demasiadas iteraciones en laguer";
		return;
	}

	
	//ok
    public static function FMAX($a, $b){
		if($a>$b) return $a; else return $b;
	}
    
	public static function evalx($coef){
		 $a=array();
        $raices=array(array());
		for($i=0; $i<count($coef); $i++){
		    $a[count($coef)-1-$i]=new Complejo($coef[$i], 0.0);
		}
		$roots=static::zroots($a,count($a)-1,true);
		for ($i=1;$i<count($roots);$i++){
		// echo "<br>".$i."p   ".$roots[$i]->r."   ".-$roots[$i]->i;
		//$raices[$i-1][0]=round($roots[$i]->r, 3);
		//$raices[$i-1][1]=-round($roots[$i]->i, 3);
		$raices[$i-1][0]=$roots[$i]->r;
		$raices[$i-1][1]=-$roots[$i]->i;
		}
		return $raices; 
	}


	public static function calculaRaices($coef){
       $raices=0;
        //echo '<script type="text/javascript">alert("varianza '.json_encode($coef).'");</script>';
        if(is_array($coef)){
			if(count($coef)>1){   
				if($coef!=null){
				    $raices=static::evalx($coef); 
				    //echo '<script type="text/javascript">alert("esta vacio'.empty($coef).'");</script>';
				}
			}else{
				//echo '<script type="text/javascript">alert("no se puese sacar polos de un entero");</script>';
			}
	    }	    
		return $raices;
    }

//metodo trabajando trabajando correctamente
    public static  function zroots($a, $m, $polish){
		$roots=array();
		$ad=array();  
        $contaobj=count($a);
		//ok
        for ($i=0;$i<$contaobj;$i++){
              $roots[$i]=new Complejo();
		}
        //ok
		for($j=0; $j< 100; $j++){
			$ad[$j]=new Complejo();
        }
       //ok
        for ($j=0;$j<=$m;$j++){ 
			$ad[$j]=$a[$j];
		}
		
		//funciona sin laguer
        for ($j=$m;$j>=1;$j--) {
			$x=new Complejo();
			static::laguer($ad,$j, $x);
			$rrata=2*2e-6*abs($x->r);  
			if (abs($x->i) <= $rrata) $x->i=0;
			$roots[$j]=$x;
			$b=$ad[$j];
			//codigo correcto sin laguer()
			
			//for ok
			for ($jj=$j-1;$jj>=0;$jj--) {
				$c=$ad[$jj];
				$ad[$jj]=$b;
				$b=Complejo::add(Complejo::mul($x,$b),$c);
			} 
		}
	    
		//condicion funciona sin laguer
		if($polish==true){
			for($j=1;$j<=$m;$j++){
				static::laguer($a,$m,$roots[$j]);
			} 
		}
        
		//ok
		for ($j=2;$j<=$m;$j++) {
			  $x=$roots[$j];
			  for ($i=$j-1;$i>=1;$i--) {
					if ($roots[$i]->r <= $x->r){
						break;
					}
					$roots[$i+1]=$roots[$i];
			  }
			  $roots[$i+1]=$x;
        }
        return $roots;
	} 
	//fin de la clase raices
}

//$coef=array(1,1,1,1,0,-4,3);
//raices::calculaRaices($coef);
//echo count($coef);
//$xComplejo=new Complejo(2,1);
//$xComplejo2=new Complejo(4,3);
//echo "<br>holamundo ".$xComplejo." ".Complejo::mul($xComplejo,$xComplejo2);
?>
