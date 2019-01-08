<?php
//include "Complejo.php";
include "Raices.php";


class FracParcial{

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
				$entregax=$this->caso2();
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

				    if($entregax[$i][0]->i==0){
						$zo=$entregax[$i][0];
						$zoc=new Complejo($entregax[$i][0]->r, -$entregax[$i][0]->i);
						$zp=$entregax[$i][1][1];
						$zpc=new Complejo($entregax[$i][1][1]->r,-$entregax[$i][1][1]->i);
						$a=Complejo::add($zo,$zoc);
						$b=Complejo::add(Complejo::mul($zo,$zpc),Complejo::mul($zp,$zoc)); 
						$c=Complejo::add($zpc,$zp);
						$d=Complejo::mul($zp,$zpc);
						$entrega[$i1][0]=array(round($a->r,4),round($b->r,4));
						$entrega[$i1][1]=array(1,round($c->r,4),round($d->r,4));
						$i++;
					}

				}
			//actualizar entrega
			break;
			default:
				# code...
			break;
		}
				//echo'<script type="text/javascript">  alert("jjj '.count($entrega).'");</script>';
		return $entrega;
	}
//caso de polos reales no repetidos
	public function caso1(){
		$coefnum=array();
		$limitedenominador=array();
		$polipart=array(array());
		$limitepolipart=array();

		$A_n=array();
		$entregar=array(array());

		for($i=0;$i<count($this->roots);$i++){
			$limitedenominador[$i]=limiteP::limitepol($this->num,$this->roots[$i][0]);
			$polipart[$i][0]=1;
			$polipart[$i][1]=-$this->roots[$i][0];
		}
		$mulcal=1;
		for($i=0;$i<count($this->roots);$i++){
			$limitepolipart=1;
			for($ia=0;$ia<count($this->roots);$ia++){
				$mulcal=limiteP::limitepol($polipart[$ia],$this->roots[$i][0]);
				if($mulcal!=0)	$limitepolipart=$limitepolipart*$mulcal;
			}
			$A_n=$limitedenominador[$i]/$limitepolipart;
			$entregar[$i][0]=array(round($A_n,4));
			$entregar[$i][1]=$polipart[$i];
		}
		return $entregar;
	}



	public function caso2(){
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



	public function caso2p(){
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