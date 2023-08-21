<?php

class aeropendulo{
/*
            (g\)  = Aceleracion Gravitacional  \([9.8 k_g/m^2]\)</li>
            (\beta\)  = Angulo de engranaje servomotor \([rad]\)</li>
            (\gamma\) = Cordenada de la esfera   \([met]\)</li>
            (\alpha\) = Coordenada del angulo del haz   \([rad]\)</li>
            (d\)  = Desplazamiento del sigueñal en el motor   \([met]\)</li>
            (m\)  = Masa de la esfera   \([k_g]\)</li>
            (J\)  = Momento inercia esfera  \([k_gm^2]\)</li>
            (R\)  = Radio Esfera  \([met]\)</li>

*/


	//VARIABLES POR DEFECTO DE LAS CONSTANTES DINAMICAS DEL MOTOR dc
	public $l;
	public $mg;
	public $k;
	public $c;
	public $g;

	public function __construct(){
		$this->l = 0.5;
		$this->mg = 1;
		$this->k = 0.002;
		$this->c = 0.04;
		$this->g = 9.8;


		$this->textoClase= ' <div class="table-responsive "><center>\( P(s) = \frac {\Theta(s)}{W(s)} = \frac{KL}{mgL^2s^2+cs} \qquad [ \frac{rad}{v}] \)</center></div><br>'; // arroja una salida de texto tipo latex
	}


	public function TmfmotorPos(){


		$texto = ' <div class="table-responsive ">$$ H(s)=\frac{('.$this->k.')('.$this->l.')}{('.$this->mg.')('.$this->l.'^2)s^2+ '.$this->c.'s} \qquad [ \\frac{rad}{v} ] $$</div>'; //String
		return $texto;
	}

	public function nuevosParametros($l,$mg,$k,$c){
		$this->l = $l;
		$this->mg = $mg;
		$this->k = $k;
		$this->c = $c;
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
		$num=new polinomio(array($this->k*$this->l));
		$den=new polinomio(array($this->mg*$this->l*$this->l,$this->c,0));
		return new tf($num,$den);
	}


	public function pid($kc, $Td, $Ti, $a){
		
		if($a!=0){
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
		}else{
			if($kc!=0){
				if($Ti!=0){
					if($Td!=0){
						$num=array($Ti*$Td*$kc,$kc*$Ti,$kc);
						$den=array($Ti,0);
					}else{
						//$num=array($kc,$kc/$Ti);
						$num=array($kc,$kc/$Ti);
						$den=array(1,0);
					}
				}else{
					if($Td!=0){
						//$num=array($kc*$Td,$kc);
						$num=array($Td,$kc);
						$den=array(1);
					}else{
						$num=array($kc);
						$den=array(1);
					}
				}
			}else{
				$num=array(1);
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