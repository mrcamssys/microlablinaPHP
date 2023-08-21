<?php
class DerivadaP{
	
	public static function derivCoef($coef=array(),$grado=0){
		$coefm=$coef*$grado;
		return $coefm;
	}
    
    //entrada tipo array
	public static function derivPol($polinomio){
		$grado=count($polinomio);
		$poldev=array();
		$gradox=$grado-1;
		$gradod=0;
		for($i=0;$i<$grado;$i++){
			if($gradod<=($grado-2)) $poldev[$gradod]=self::derivCoef($polinomio[$i],$gradox);
			$gradod +=1;	
			$gradox -=1;
		}
		return $poldev;
	}
	
	//entradas de objeto polinomio salidas de tipo Array
	public static function derivfrac($polix,$poli2){
	    $ap=new Polinomio(self::derivPol($polix->polinomio));
	    $bp=new Polinomio(self::derivPol($poli2->polinomio));
	   
	    $a=$polix;
	    $b=$poli2;
	    
	    $numpi=$ap->mulPor($b)->resPor($bp->mulpor($a));
	    
	    $denpi=$b;
	    $denpi=$denpi->mulPor($b);
	    
	    $fraccion=array($numpi->polinomio,$denpi->polinomio);
	    
	    return $fraccion;
	}

//entradas de objeto polinomio salidas de tipo Array
	public static function derivadanpot($Polnum,$Polden, $orden){
		//salen arregos entran objetos tipo polinomio
		list($numx,$denx)=self::derivfrac($Polnum,$Polden);
		if($orden>1){
			$numxa=$numx;
			$denxa=$denx;
			for($i=2;$i<=$orden;$i++){
				list($numxa,$denxa)=self::derivfrac(new Polinomio($numxa),new Polinomio($denxa));
			}
			return array($numxa,$denxa);
		}else{
			if($orden==0){
				return array($Polnum->polinomio,$Polden->polinomio);
			}else return array($numx,$denx);
		}

	}
	
}
?>