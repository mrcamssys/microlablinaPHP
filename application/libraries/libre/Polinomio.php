<?php
class Polinomio{
	public $polinomio;

	public function __construct($pol=array()){
		$this->polinomio=$pol;
	}
/*
	public function NuePol($pol){
		$this->polinomio=$polinomio;
	}*/

	private function iguarladordepolinomio($pol,$graQuerido){
        $nuevars=abs(count($pol)-($this->grado()+1));
        $vector=array();
        for($i=0;$i<$nuevars; $i++) $vector[$i]=0;
        for($i=0;$i<count($pol); $i++)$vector[]=$pol[$i];   
        
        //echo '<script>alert("vestor agregado para normalizar es de dim= '.count($vector).'") </script>';
        //array_unshift($pol,$vector);
        //echo '<script>alert("vestor agregado para normalizar es de dim= '.var_dump($vector).'") </script>';
        return $vector;
       
	}

/* cosntruyendo uno nuevo arriba
	private function iguarladordepolinomio($pol,$graQuerido){
		$poln=array();
		$p=count($pol);
		$px=0;
		for($i=0; $i<$graQuerido; $i++){
			if($p<=$i){
				$poln[$i]=$pol[$px];
				$px++;
			} 
			else $poln[$i]=0; 
		}
		return $poln;
	}

*/

	private function normalizarpolinomio($pol){
		$data=array();		
		if($pol->grado()+1<=$this->grado()+1)
		{
			$datax=$this->iguarladordepolinomio($pol->polinomio,$this->grado()+1);
			$data[1]=$this;
			$data[2]=1;
		}
		else
		{
			$datax=$this->iguarladordepolinomio($this->polinomio,$pol->grado()+1);
			$data[1]=$pol;
			$data[2]=0;
		}
		$data[0]= new polinomio($datax);
		return $data;
	}

	public function sumPor($pol){
		$data=array();		
		$datax=$this->normalizarpolinomio($pol);
		for($i=0; $i<$datax[0]->grado()+1; $i++){
			if($datax[2]==1) $data[$i]=$datax[1]->polinomio[$i]+$datax[0]->polinomio[$i];
			else $data[$i]=$datax[0]->polinomio[$i]+$datax[1]->polinomio[$i];
		}

		return new polinomio($data);
	}


	public function resPor($pol){
		$data=array();		
		$datax=$this->normalizarpolinomio($pol);
		for($i=0; $i<$datax[0]->grado()+1; $i++){
			if($datax[2]==1) $data[$i]=$datax[1]->polinomio[$i]-$datax[0]->polinomio[$i];
			else $data[$i]=$datax[0]->polinomio[$i]-$datax[1]->polinomio[$i];
		}
		return new polinomio($data);
	}

	private function ceros($cantidad){
		$dato=array();
		for($i=0;$i<$cantidad;$i++)$dato[$i]=0;
		return $dato;
	}

	public function mulPor($pol){
		$gradpol=($pol->grado()+1+$this->grado()+1)-1;
		$Memoria=array(array());
		$data=$this->ceros($gradpol); 
		if($pol->grado()+1<=$this->grado()+1){ 
			$menor=$pol;
			$mayor=$this;
		}else{
			$mayor=$pol;
			$menor=$this;
		}

		for($i2=0; $i2<$menor->grado()+1; $i2++){
			$Memoria[$i2]=$this->ceros($gradpol);
			for($i3=0; $i3<$mayor->grado()+1; $i3++){
				$mingrad=$i2+$i3;
				//echo $mingrad;
				$Memoria[$i2][$mingrad]=$menor->polinomio[$i2]*$mayor->polinomio[$i3];

			}
		//	echo  var_dump($Memoria[$i2])."<br>";
		}
		//echo $res;
		for($i=0;$i<(count($Memoria));$i++){
			for($i1=0;$i1<count($Memoria[$i]);$i1++){
				$presente=$Memoria[$i][$i1];
				$data[$i1]=$data[$i1]+$Memoria[$i][$i1];
			}
		}
		return new polinomio($data);
	}




	public function grado(){
		return count($this->polinomio)-1;
	}


	public function __toString(){
		return " ".var_dump($this->polinomio)." ";	
	}
}
?>