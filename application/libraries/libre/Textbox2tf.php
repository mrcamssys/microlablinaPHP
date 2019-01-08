<?php
class Textbox2tf{
	private $num;
	private $den;
	//private $factorizadord;
	//private $factorizadorn;

	/*public function __construct($num, $den){
		$this->num=$num;
		$this->den=$den;
		$this->factorizadord=new raices2poligrup($den);
		$this->factorizadorn=new raices2poligrup($num);
	}*/

	public function campotexto2arreglo($num, $den){
		$this->num=$num;
		$this->den=$den;

//		$this->factorizadord=new raices2poligrup($den);
//		$this->factorizadorn=new raices2poligrup($num);
	}

	private function decomponer($matriz){
		$DatFilas=null;
		if(!empty($matriz)){
			$rest=$matriz;
			$rest = str_replace(';', ',', $rest);	
			$DatFilas  = explode(",", $rest); //crea una matriz del pilinomio de polos
		}else{
			//echo '<script type="text/javascript">alert("uno de los cambos esta vacio");</script>';
		}

		return $DatFilas;
		//echo count($DatFilas) ;
	}

	public function arpolos(){
		return $this->decomponer($this->den);
	}

	public function arceros(){
		return $this->decomponer($this->num);
	}


}
?>