<?php
/*include "Complejo.php";
recontruccion de libreria fracciones parciales version 2019-2
Autor: Carlos Arturo Moreno Susatama
ecuacion de prueba
(s+3)(s+3)(s+2)(s+1)(s+5)(s+2-5i)(s+2+5i)(s+2-7i)(s+2-7i)
[1,22,284,2476,15066,65616,195684,361492,356901,138330]
*/
include "Raices.php";

class FracParcial{
	private $num;
	Private $den;
	private $roots;
	//---seleccion de casos de las raices----//
	private $varReales;
	private $varRrealesrepetidas;
	private $varRcomplejasconj;

	public function __construct($numerador=0, $den=0){
		$this->num=$numerador;
		$this->den=$den;
		//guarda las raices del sistema intactas
		$this->roots=Raices::calculaRaices($this->den);
		
	}

	public static function nfactorial($n){
		$r=1;
		if($n==0){
			$r=1;
		}else{
			for($k=1;$k<=$n; $k++){
				$r=$r*$k;
			}
		}
		return $r;
	}

	public function detectarrepeticiones($arreglo){
		//$this->num=new Polinomio($this->num);
		$texto="";
		$resx=array();
		$res = array_diff($arreglo, array_diff(array_unique($arreglo), array_diff_assoc($arreglo, array_unique($arreglo))));
		$a=0;
		//separa los valores repetidos
		//los guarda en un arreglo bidimencional 0 es valor 1 el arreglo de posiciones
		foreach(array_unique($res) as $v) {
			$resx[$a][0]=$v;
			$resx[$a][1]=array_keys($res, $v);
			$a++;
		}
		//var_dump($resx);
		//var_export($resx);
		if(count($resx)==0) return null;
		else return $resx;
	}


	private function separarRaices(){
		$raices1=array();//raices reales arreglo unidimencional
		$raices2=array();//raices complejas arreglo unidimencional
		$contenedorraicestemp1=array();
		//separa raices reales de complejas y las guarda en raices 1 y 2
		for($i=0; $i<count((array)$this->roots); $i++){
			if($this->roots[$i][1]==0){
				$raices1[]=round($this->roots[$i][0],2);
			}else{
				$raices2[]=new complejo($this->roots[$i][0],$this->roots[$i][1]);
			}
		}

		//$this->varReales=$raices1;
		$contenedorraicestemp1=$this->detectarrepeticiones($raices1);
		for($i=0; $i<count((array)$contenedorraicestemp1); $i++){
			$this->varRrealesrepetidas[$i][0]=$contenedorraicestemp1[$i][0];	
			$this->varRrealesrepetidas[$i][1]=count($contenedorraicestemp1[$i][1]);
			for($i1=0;$i1<count($contenedorraicestemp1[$i][1]); $i1++ ){
				$poseliminiar=$contenedorraicestemp1[$i][1]; //el arreglo de posiciones
				unset($raices1[$poseliminiar[$i1]]);
			}
		}
		//organiza raices reales
		$m=0;
		for($i=0;$i<count((array)$this->roots);$i++){
			if (array_key_exists($i, $raices1)) {
				$this->varReales[$m]=$raices1[$i];
				$m++;
			}
		}
		$this->varRcomplejasconj=$raices2;
	}

	
	//zona de creador de polinomios por grupos comlejos, reales y conjugados

	private function polinomioReales(){
		$raices=$this->varReales;
		$polifin=new polinomio(array(1));
		$texto="<h3>Polinomio Raices</h3>";
		for($i=0;$i<count((array)$raices); $i++){
			$polifin=$polifin->mulPor(new polinomio(array(1,-$raices[$i])));
		}
		return $polifin;
	}

	private function polinomioRealesRepetidos(){
		$raices=$this->varRrealesrepetidas;
		$polifin=new polinomio(array(1));

		$texto="<h3>Polinomio R Repetidos</h3>";
		for($i=0;$i<count((array)$raices); $i++){
			for($m=0;$m<$raices[$i][1]; $m++){
				$polifin=$polifin->mulPor(new polinomio(array(1,-$raices[$i][0])));
			}
		}


		return $polifin;
	}

	private function polinomioComplexConj(){
		$raices=$this->varRcomplejasconj;
		$polinom=array();
		$polifin=new polinomio(array(1));
		$texto="<h3>polinomio Encontrado Complejos</h3>";
		for($i=0;$i<count((array)$raices); $i++){
			if($i%2){
				$polinom[]=new Polinomio(array(1, -complejo::add(complejo::conjg($raices[$i]), $raices[$i])->r, complejo::mul(complejo::conjg($raices[$i]), $raices[$i])->r ));
			}
		}

		for($i=0;$i<count($polinom); $i++){
				$polifin=$polifin->mulPor($polinom[$i]);
		}

		return $polifin;
	}

	//solucion de casos de fracciones parciales

//caso 1
	private function realesNorepetidas(){
		$entrega=array();
		$raices=$this->varReales;
		$mulpol=$this->polinomioRealesRepetidos()->mulPor($this->polinomioComplexConj());
		$texto="<h3>Reales</h3>";
		$denominador=new polinomio(array(1));
		$Ai=array();

		for($i=0;$i<count((array)$raices); $i++){
			//$texto=$texto." ".$raices[$i]."<br>";}}
			for($c=0; $c<count((array)$raices); $c++){
				if($c!=$i){
					$denominador=$denominador->mulPor(new polinomio(array(1,-$raices[$c])));
				}
			}
			$denominador=$denominador->mulPor($mulpol);
			$limnum=LimiteP::limitepol($this->num,$raices[$i]);
			$limden=LimiteP::limitepol($denominador->polinomio,$raices[$i]);

			if($limden==0) $limden=0.00000001;
			$Ai=$limnum/$limden;
			//$texto=$texto." ".$Ai."<br>";
			$denominador=new polinomio(array(1));
			$entrega[$i][0]=array($Ai);
			$entrega[$i][1]=array(1,-$raices[$i]);
		}

		return $entrega;
	}


	Private function factorial($numero){
		$val=1;
		for($i=1;$i<=$numero;$i++) $val=$val*$i;
		return $val; 
	}

//caso 2

	private function ExclucionRepetidas($excluir){
		$raices=$this->varRrealesrepetidas;
		$polifin=new polinomio(array(1));

		$texto="<h3>Polinomio R Repetidos</h3>";
		for($i=0;$i<count((array)$raices); $i++){
			for($m=0;$m<$raices[$i][1]; $m++){
				if($raices[$i][0]!=$excluir) $polifin=$polifin->mulPor(new polinomio(array(1,-$raices[$i][0])));
			}
		}
		return $polifin;

	} 

	private function realesRepetidas(){
		$entrega=array();
		$raices=$this->varRrealesrepetidas;
		$mulpol=$this->polinomioComplexConj()->mulPor($this->polinomioReales());
		$texto="<h3>Reales</h3>";
		$denominador=new polinomio(array(1));
		$Ai=array();
		$fac=1;

		$res=0;
		$a=0;
		$texto="<h3>Reales Repetidos</h3>";
		for($i=0;$i<count((array)$raices); $i++){
			for($m=1;$m<=$raices[$i][1]; $m++){
				$k=$raices[$i][1]-$m;
				$fac=1/$this->factorial($k);				
				list($numx,$denx)=DerivadaP::derivadanpot(new Polinomio($this->num),$mulpol->mulPor($this->ExclucionRepetidas($raices[$i][0])), $k);
				$limnum=LimiteP::limitepol($numx,$raices[$i][0]);
				$limden=LimiteP::limitepol($denx,$raices[$i][0]);
				$res=$fac*($limnum/$limden);
				
				$entrega[$a][0]=array($res);
				$entrega[$a][1]=array(1,-$raices[$i][0]);
				$entrega[$a][2]=$m;
				$entrega[$a][3]=$m+1;
				//$texto=$texto.$res."<br>";
				$a=$a+1;
			}

			//$texto=$texto."<hr>";
		}
		//$this->factorial(3);
		

		//return $texto;
		return $entrega;
	}

//caso 3 toca analizar

	private function metodo2(){
		$entregax=$this->caso3();
		$i1=0;	$i2=0;	$i3=0;	$i4=4;
		$den=array(array());
		$entrega=array();
		for($i=0; $i<count($entregax); $i++){
			$DDr[$i]=$entregax[$i][1];
			if($DDr[$i][1]->i==0){
				$Dr[$i1]=$DDr[$i][1]->r;
				$den[0]=1;
				$den[1]=$Dr[$i1];
				$entrega[$i1][1]=$den;
				$entrega[$i1][0]=array($entregax[$i][0]->r);
				$i1++;
			}
			if($entregax[$i][0]->i>0){
				$zo=$entregax[$i][0];
				$zoc=new Complejo($entregax[$i][0]->r, -$entregax[$i][0]->i);
				$zp=$entregax[$i][1][1];
				$zpc=new Complejo($entregax[$i][1][1]->r,-$entregax[$i][1][1]->i);
				$a=Complejo::add($zo,$zoc);
				$b=Complejo::add(Complejo::mul($zo,$zpc),Complejo::mul($zp,$zoc)); 
				$c=Complejo::add($zpc,$zp);
				$d=Complejo::mul($zp,$zpc);
				$entrega[$i1][0]=array($a->r,$b->r);
				$entrega[$i1][1]=array(1,$c->r,$d->r);
				$i1++;
			}
		}
		return $entrega;
	}

	public function caso3(){
		$coefnum=array();
		$limitedenominador=array();
		$polipart=array(array());
		$limitepolipart=array();

		$A_n=new Complejo();
		$entregar=array();


		for($i=0;$i<count((array)$this->roots);$i++){
			$kk=$this->roots[$i][0]/50;
			$pcomplejo=new Complejo($this->roots[$i][0]+$kk,$this->roots[$i][1]);
			$limitedenominador[$i]=limiteP::limitePolCoplex($this->num,$pcomplejo);
			$polipart[$i][0]=new Complejo(1,0);
			$polipart[$i][1]=new Complejo(-$this->roots[$i][0],-$this->roots[$i][1]);
		}
		$mulcal=1;
		$limitepolipart=new Complejo(1,0);
		$npol=array();
		$a=0;
		for($i=0;$i<count((array)$this->roots);$i++){
			if($polipart[$i][1]->i!=0){
				$limitepolipart=new Complejo(1,0);
				for($ia=0;$ia<count($this->roots);$ia++){
					$mulcal=limiteP::limiteCCoplex($polipart[$ia],new Complejo($this->roots[$i][0],$this->roots[$i][1]));

					if($mulcal->i!=0){
							$limitepolipart=Complejo::mul($limitepolipart,$mulcal);
					}
				}
				$A_n=Complejo::div($limitedenominador[$i],$limitepolipart);
				$A_n=new Complejo($A_n->r,$A_n->i);

				$entregar[$a][0]=$A_n;
				$entregar[$a][1]=$polipart[$i];
				$a=$a+1;
			}
		}

		if(!empty($entregar)){
			return $entregar;
		}else{
			return null;
		}


		
	}


	private function ComplejasConjugadas(){
		$texto="<h3>Complejos Conjugados</h3>";
		$Ai=array();
		$entregax=array();

		$entrega=$this->caso3();
		if($entrega!=null){
			$entregax=$this->metodo2();
		}

		return $entregax;
	}



	public function cantrepetidas(){
		$this->separarRaices();
		return count((array)$this->realesRepetidas());
	}


	//entrega de resultados
	public function OutFracPar(){
		$systema=array();
		$this->separarRaices();
		$systema=array_merge_recursive($this->realesNorepetidas(),$this->realesRepetidas(),$this->ComplejasConjugadas());
		return $systema;
	}


}

?>

