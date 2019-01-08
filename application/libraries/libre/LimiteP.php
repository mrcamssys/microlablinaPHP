<?php

class LimiteP{

	
	//entrar el polinomio como arreglo  y entrar la tendencia como objeto complejo
	
	public static function limitePolCoplex($polinomio, $complejo){

		$grado=count($polinomio);

		$gpol=$grado-1;

		$rescomp=new Complejo();
		$real=new Complejo();
		for($i=0;$i<$grado;$i++){

			$rescomp=Complejo::muldo($polinomio[$i],Complejo::powc($complejo,$gpol));
			//echo "<br>".$polinomio[$i]." --- ".$rescomp."<br>";
			$real=Complejo::add($real,$rescomp);
			//echo "<hr>objeto limiteP metodo limitePolCoplex:  ".$polinomio[$i]." potencia ".Complejo::powc($complejo,$gpol)." tiende a: ".$complejo."  = <b>".$real."</b><hr><br>";
			$gpol-=1;

		}

		return $real;
	}

//entrar el complejo como arreglo  y entrar la tendencia como objeto complejo
	public static function limiteCCoplex($Cpolinomio, $complejo){

		$grado=count($Cpolinomio);

		$gpol=$grado-1;

		$rescomp=new Complejo();
		$real=new Complejo();
		for($i=0;$i<$grado;$i++){

			$rescomp=Complejo::mul($Cpolinomio[$i],Complejo::powc($complejo,$gpol));
			//echo "<hr> ". $rescomp ."<hr>" ;
			$real=Complejo::add($real,$rescomp);

			$gpol-=1;

		}

		return new Complejo($real->r,$real->i);
	}

	public static function limitepol($polinomio,$tiende=0){

		$grado=count($polinomio);

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