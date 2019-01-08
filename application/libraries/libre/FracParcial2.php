<?php
//include "Complejo.php";
include "Raices.php";


class FracParcial2{
	private $num;
	private $denfactor;
	private $roots;
//numerador y den en terminos de polinomio, arreglo unidimencional
	public function __construct($numerador=0,$den=0){
		$this->num=$numerador;
		$this->denfactor=$den;
		$this->roots=Raices::calculaRaices($this->denfactor);
		//$this->roots=$this->raices::calculaRaices($this->denfactor);
	}



	
    public function corFrac($dato=array()){
        $num=$dato[$i][0];
        $den=$dato[$i][1];
        for($i=0; $i<count($reentrega); $i++){
			//echo "a0 ".var_dump($entrega[$i][0])." a1 ".var_dump($entrega[$i][1])." | ";
			$data=count();			   
		}
    }


	public function OutFracPar(){
		$caso=1;
		$entrega=array(array());
		$entregax=array(array());
		//debe estar en terminos de arreglo unidimencional
		for($i=0; $i<count($this->roots);$i++){
			
			if($this->roots[$i][1]!=0){
				$caso=2;
				
				break;
			}
			
		} 
		switch ($caso) {
			case 1: //polos reales no repetidos
				# code...
				$entrega=$this->caso1();
                $reentrega=$entrega;               
			break;
			case 2: //polos complejos no repetidos y conjugados
				$entrega=$this->metodo2();
			//actualizar entrega
			break;
			default:
				# code...
			break;
		}
		return $entrega;
	}

	private function metodo2(){
		$entregax=$this->caso3();
		$i1=0;	$i2=0;	$i3=0;	$i4=4;
		$den=array(array());
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
				
				//echo "<hr>a=$a  b=$b  c=$c d=$d<hr>";
				$entrega[$i1][0]=array(round($a->r,4),round($b->r,4));
				$entrega[$i1][1]=array(1,round($c->r,4),round($d->r,4));
				$i1++;
			}
		}
		return $entrega;
	}



//caso 1 heaviside  de polos reales no repetidos
	public function caso1($rootsx){
		$coefnum=array();
		$limitedenominador=array();
		$polipart=array(array());
		$limitepolipart=array();

		$A_n=array();
		$entregar=array(array());

		//for($i=0;$i<count($this->roots);$i++){	
		for($i=0;$i<count($rootsx);$i++){		
			//if($this->roots[$i][1]==0){
				$limitedenominador[$i]=limiteP::limitepol($this->num,$rootsx[$i]);
				$polipart[$i][0]=1;
				$polipart[$i][1]=-$rootsx[$i];
			//}
		}
		$mulcal=1;
		for($i=0;$i<count($rootsx);$i++){
			$limitepolipart=1;
			for($ia=0;$ia<count($rootsx);$ia++){
			//	if($this->roots[$i][1]==0){

					$mulcal=limiteP::limitepol($polipart[$ia],$rootsx[$i]);
					if($mulcal!=0)	$limitepolipart=$limitepolipart*$mulcal;
			//	}
			}
			$A_n=$limitedenominador[$i]/$limitepolipart;
			$entregar[0][$i]=array(round($A_n,4));
			$entregar[1][$i]=$polipart[$i];
		}


		return $entregar;
	}


	private function separarRaicesRepetidas(){
		$cantiRaices=count($this->roots)-1;
		$nuevasraices=null;
		
		$reales=array();
		$realesRep=array();
		$complejos=array();
		$a=0;
		if($cantiRaices!=0){
			for($i=0;$i<=$cantiRaices;$i++){
				if($this->roots[$i][1]==0){
					$reales[]=$this->roots[$i][0];
				}elseif($this->roots[$i][1]>0 || $this->roots[$i][1]<0){
					$complejos[$a]=array($this->roots[$i][0],$this->roots[$i][1]);
					$a++;
				}
			}
			$res = array_diff($reales, array_diff(array_unique($reales), array_diff_assoc($reales, array_unique($reales))));
			$a=0;
			foreach(array_unique($res) as $v) {
				$realesRep[$a][0]=count(array_keys($res, $v)); 
				$realesRep[$a][1]=$v;
				foreach (array_keys($res, $v) as $key){
        			unset($reales[$key]);
    			}
    			$a++;
			}

		}

		return array($reales,$realesRep,$complejos);
	}




	public function printR(){
		$mensaje="";
		$cantidad=count($this->roots);
			$caso=0;
			list($re,$reRep,$c)=$this->separarRaicesRepetidas();
			if(!empty($re)) $caso=$caso+1; 
			else $mensaje=$mensaje."no hay polos reales sin repetir <br>";
			if(!empty($reRep)) $caso=$caso+1;
			else $mensaje=$mensaje."no hay polos reales repetids <br>";
			if(!empty($c)) $caso=$caso+1;
			else $mensaje=$mensaje."no hay polos complejos <br>";

			 
			//selector de casos de operacion



			for($i=0;$i<count($this->metodo2());$i++){
				$mensaje=$mensaje.Stringlatex::latexPrintTF($this->metodo2()[$i][0], $this->metodo2()[$i][1],1)."<br />";
			}

			

return " ".json_encode($this->roots)."<hr>reaales<br>".json_encode($re)."<hr>reaales Repetidos<br>".json_encode($reRep)."<hr>Complejos<br>".json_encode($c)."<br>".$mensaje."<br>".$this->ocultos($this->caso3())."<br><br>".json_encode($this->caso1($re));

	}


	private function ocultos($variable){
		$texto="";
		$var = count($variable);

		$texto="<hr />Numeradores<hr />";

		for($i=0;$i<$var;$i++){
			//$texto=$texto.$variable[$i][0]."<br>";
			//$svar=$variable[$i][1];
			$texto=$texto.var_dump($variable[$i][0]);

		}

		$texto=$texto."<hr />Denominadores<hr />";
		for($i=0;$i<count($var);$i++){
			//$texto=$texto.$svar[$i]."<br>";
			$texto=$texto.var_dump($variable[$i][1]);
		}

		return $texto;
	}

//caso 2 de heaviside polos reales repetidos 
//se asume que todas las racies son repetidas
	public function caso2(){
		$raices_del_denominador_noRepetidas=array();
		$raices_del_denominador_repetidas=array();
		$numerador=$this->num;


	}

//caso 3 de heaviside polos complejos no repetidos
	public function caso3(){
		$coefnum=array();
		$limitedenominador=array();
		$polipart=array(array());
		$limitepolipart=array();

		$A_n=new Complejo();
		$entregar=array(array());


		for($i=0;$i<count($this->roots);$i++){
			$pcomplejo=new Complejo($this->roots[$i][0],$this->roots[$i][1]);
			$limitedenominador[$i]=limiteP::limitePolCoplex($this->num,$pcomplejo);
			$polipart[$i][0]=new Complejo(1,0);
			$polipart[$i][1]=new Complejo(-$this->roots[$i][0],-$this->roots[$i][1]);
		}
		$mulcal=1;
		$limitepolipart=new Complejo(1,0);
		$npol=array();
		for($i=0;$i<count($this->roots);$i++){
			if($polipart[$i][1]->i!=0){
				$limitepolipart=new Complejo(1,0);
				for($ia=0;$ia<count($this->roots);$ia++){
					$mulcal=limiteP::limiteCCoplex($polipart[$ia],new Complejo($this->roots[$i][0],$this->roots[$i][1]));

					if($mulcal->i!=0){
							$limitepolipart=Complejo::mul($limitepolipart,$mulcal);
					}
				}
				$A_n=Complejo::div($limitedenominador[$i],$limitepolipart);
				$A_n=new Complejo(round($A_n->r,4),round($A_n->i,4));
			}else{
				$limitepolipart=new Complejo(1,0);
				$mulcalx=array();
				for($ia=0;$ia<count($this->roots);$ia++){
					$na[0]=$polipart[$ia][0]->r;
					$na[1]=$polipart[$ia][1]->r;

				//$mulcal=limiteP::limitePolCoplex($na,new Complejo($this->roots[$i][0],$this->roots[$i][1]));
					$mulcal=limiteP::limiteCCoplex($polipart[$ia],new Complejo($this->roots[$i][0],$this->roots[$i][1]));

				if($mulcal->r==0 && $mulcal->i==0){	
					}else{
						$mulcalx[$ia]=$mulcal;
						//echo "<h3>".$mulcalx[$ia]."<br> </h3>";
						$limitepolipart=Complejo::mul($limitepolipart,$mulcal);
					}

				}
				$A_nx=Complejo::div($limitedenominador[$i],$limitepolipart);
				$A_n=new Complejo(round($A_nx->r,4),0);
			}
	//			echo $A_n."<br>";
			$entregar[$i][0]=$A_n;
			$entregar[$i][1]=$polipart[$i];
		}


		return $entregar;
	}



}