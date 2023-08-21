<?php

class LimiteP{

	
	//entrar el polinomio como arreglo  y entrar la tendencia como objeto complejo
	
	public static function limitePolCoplex($polinomio, $complejo){
		$grado=count((array)$polinomio);
		$gpol=$grado-1;
		$rescomp=new Complejo();
		$real=new Complejo();
		for($i=0;$i<$grado;$i++){

			$rescomp=Complejo::mul($polinomio[$i],Complejo::powc($complejo,$gpol));
			
			$real=Complejo::add($real,$rescomp);
			$gpol-=1;
		}

		return $real;
	}

/*
	public static function limitePolCoplex($polinomio, $complejo){
		$grado=count((array)$polinomio);
		$gpol=$grado-1;
		$rescomp=new Complejo();
		$real=new Complejo();
		for($i=0;$i<$grado;$i++){
			if(get_parent_class($polinomio[$i])=="Complejo"){
				$rescomp=Complejo::muldo($polinomio[$i], Complejo::powc($polinomio[$i],$gpol));
			}else{
				$m=new complejo($polinomio[$i],0);
				$rescomp=Complejo::mul($polinomio[$i],Complejo::powc($complejo,$gpol));
			}

			
			
			$real=Complejo::add($real,$rescomp);
			$gpol-=1;
		}

		return $real;
	}
*/





//entrar el complejo como arreglo  y entrar la tendencia como objeto complejo
	public static function limiteCCoplex($Cpolinomio, $complejo){
		$grado=count((array)$Cpolinomio);
		$gpol=$grado-1;
		$rescomp=new Complejo();
		$real=new Complejo();
		for($i=0;$i<$grado;$i++){
			$rescomp=Complejo::mul($Cpolinomio[$i],Complejo::powc($complejo,$gpol));
			$real=Complejo::add($real,$rescomp);
			$gpol-=1;
		}
		return new Complejo($real->r,$real->i);
	}

	public static function limitepol($polinomio,$tiende=0){
		$grado=count((array)$polinomio);
		$gpol=$grado-1;
		$vali=0;
		for($i=0;$i<$grado;$i++){
			$val=$polinomio[$i]*pow($tiende,$gpol);
			$vali=$vali+$val;
			$gpol-=1;
		}
		return $vali;
	}
}

?>