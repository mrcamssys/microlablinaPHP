<?php

class Motordc{
/*
	(J)     MOMENTO DE INERCIA INICIAL DEL MOTOR     		[kg.m^2]
	(b)     COSNTANTE DE VISCOCIDAD DE FRICCION DEL MOTOR  	[N.m.s]
	(Ke)    Cosntante de fuerza electromotriz  				[V/rad/sec]
	(Kt)    CONSTANTE DE TORQUE DEL MOTOR       			[N.m/Amp]
	(R)     RESISTENCIA ELECTRICA             				[Ohm]
	(L)     INDUCTANCIA ELECTRICA 							[H]
*/


	//VARIABLES POR DEFECTO DE LAS CONSTANTES DINAMICAS DEL MOTOR dc
	public $J;
	public $b;
	public $Ke;
	public $Kt;
	public $R;
	public $L;
	public $textoClase;

	public function __construct(){
		$this->J = 3.2284e-6;
		$this->b = 3.5077e-6;
		$this->Ke = 0.0274;
		$this->Kt = 0.0274;
		$this->R = 4;
		$this->L = 2.75e-6;

		$this->textoClase= ' <div class="table-responsive ">\( P(s) = \frac {\dot{\Theta}(s)}{V(s)} = \frac{K}{(Js + b)(Ls + R) + K^2} \qquad [ \frac{rad/sec}{V}] \)</div>'; // arroja una salida de texto tipo latex
	}


	public function TmfmotorPos(){
		$texto = ' <div class="table-responsive ">$$ H(s)='." \\frac{ ($this->Ke)} {s(($this->J) s + ($this->b))(($this->L )s + ($this->R)) + ($this->Ke^2))} \qquad [ \\frac{rad/sec}{V}] $$</div>"; //String
		return $texto;
	}

	public function nuevosParametros($j,$b,$ke,$R,$L){
		$this->J = $j;
		$this->b = $b;
		$this->Ke = $ke;
		$this->Kt = $ke;
		$this->R = $R;
		$this->L = $L;
	}

	public function RaicesPos(){
		$a=($this->R*$this->J + $this->L*$this->b)/($this->L*$this->J);
		$b=($this->R*$this->b+$this->Ke*$this->Ke)/($this->L*$this->J);
		$m=$a*$a-4*$b;
		if($m>=0){
			$datos[0]=new complejo((-$a+sqrt($m))/2,0);
			$datos[1]=new complejo((-$a-sqrt($m))/2,0);
			$datos[2]=new complejo(0,0);
		}else{
			if($m=0){
				$datos[0]=new complejo((-$a)/2,0);
				$datos[1]=new complejo((-$a)/2,0);
				$datos[2]=new complejo(0,0);
			}else{
				$datos[0]=new complejo(-$a/2,sqrt(-$m)/2);
				$datos[1]=new complejo(-$a/2,-sqrt(-$m)/2);
				$datos[2]=new complejo(0,0);
			}
		}
		return $datos;
	}


	public function TmfmotorPosOperada(){
		$m=($this->Ke)/($this->L*$this->J);
		$p=($this->R*$this->J + $this->L*$this->b)/($this->L*$this->J);
		$c=($this->R*$this->b+$this->Ke*$this->Ke)/($this->L*$this->J);
		$num=new polinomio(array($m));
		$den=new polinomio(array(1, $p, $c, 0));
		return new tf($num,$den);
	}


	public function pid($kc, $Td, $Ti, $a){
		
		if($Ti!=0){
			if($Td!=0){	
				$num=array(($a*$kc*$Ti*$Td+$kc*$Ti*$Td), ($kc*$Ti+$a*$kc*$Td), $kc);
				$den=array(($a*$Td*$Ti), $Ti, 0);
			}else{
				$num=array($kc);
				$den=array(1);
			}
		}else{
			if($Td!=0){
				$num=array($a*$kc*$Td, ($kc+$Td));
				$den=array($a*$Td,1);
			}else{
				$num=array($kc+$Td);
				$den=array(1);
			}
		}



		$num=new polinomio($num);
		$den=new polinomio($den);
		return new tf($num,$den, "G(s)");
	}

	public function LC($s1,$s2){
		$a=$s1->num;
		$b=$s1->den;
		$d=$s2->num;
		$e=$s2->den;
		$da=$d->mulPor($a);
		$eb=$e->mulpor($b);
		$den=$eb->sumPor($da);

		/*if($da->polinomio[0]==0){
			unset($den->da[0]);
			var_export ($da->polinomio);
		}*/
		return new tf($da,$den,"p($)");
	}

	public function  tf2tbox($tf){
		$num=implode(",", $tf->num->polinomio);
		$den=implode(",", $tf->den->polinomio);
		return array($num,$den);
	}

	public function __toString(){
		return $this->textoClase;
	}

}


?>