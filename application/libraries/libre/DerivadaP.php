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
			//echo "<br>  Coeficientederivado= ".$poldev[$i]." grado= ".$gradox."  coef= ".$polinomio[$i]."<br>";
			$gradod +=1;	
			$gradox -=1;
		}
		return $poldev;
	}
	
	//entradas de objeto polinomio 
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
	
}
?>