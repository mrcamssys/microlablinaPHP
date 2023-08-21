<?php

class Balbeam{



	//VARIABLES POR DEFECTO DE LAS CONSTANTES DINAMICAS DEL MOTOR dc
	public $g;
	public $beta;
	public $gamma;
	public $alpha;
	public $d;
	public $m;
	public $j;
	public $r;
	public $l;

	public function __construct(){
		$this->g = -9.8;
		$this->beta = 0;
		$this->gamma = 0;
		$this->alpha = 0;
		$this->d = 0;
		$this->m = 1;
		$this->j = 1;
		$this->r = 1;
		$this->l=1;

		$this->textoClase= ' <div class="table-responsive "><center>\( P(s) = \frac {R(s)}{\beta(s)} = \frac{mgd}{l(\frac{j}{r}+m)s^2} \qquad [ \frac{met}{rad}] \)</center></div><br>'; // arroja una salida de texto tipo latex
	}


	public function TmfmotorPos(){


		$texto = ' <div class="table-responsive ">$$ H(s)=\frac{('.$this->m.')('.$this->g.')('.$this->d.')}{'.$this->l.'( \frac{'.$this->j.'}{'.$this->r.'} + '.$this->m.')s^2 } \qquad [ \\frac{met}{rad} ] $$</div>'; //String
		return $texto;
	}

	public function nuevosParametros($beta,$gama,$alpha,$d,$m,$j,$r){
		//$this->g = $g;
		$this->beta = $beta;
		$this->gamma = $gama;
		$this->alpha = $alpha;
		$this->d = $d;
		$this->m = $m;
		$this->j = $j;
		$this->r = $r;
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
		//$m=($this->Ke)/($this->L*$this->J);
		//$p=($this->R*$this->J + $this->L*$this->b)/($this->L*$this->J);
		//$c=($this->R*$this->b+$this->Ke*$this->Ke)/($this->L*$this->J);


		$num=new polinomio(array(-$this->m*$this->g*$this->d));
		$den=new polinomio(array($this->l* ($this->j/($this->r*$this->r) + $this->m)  , 0, 0));
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