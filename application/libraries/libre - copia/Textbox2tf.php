<?php
class Textbox2tf{
	private $num;
	private $den;
	Private $residuo;
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
			$error=0;
			do{
				$rest=trim($rest);
				$dato=substr($rest, -1);

				if($dato==","){
					$rest = trim($rest,",");
					$error=1;
				}else{
					$error=0;
				}
			}while ($error != 0);
			$DatFilas  = explode(",", $rest); //crea una matriz del pilinomio de polos
			//$tamano=count((array)$DatFilas);
			$eliminador=array();
			$seguro=1;
			foreach($DatFilas as $element) {
    			if(is_numeric($element)) {

    				if($element==0 && $seguro==1){

    				}else{
    					$seguro=0;
    					$eliminador[]=$element;
    				}

			        
			    }
			}

			$DatFilas=$eliminador;
		}else{
			//echo '<script type="text/javascript">alert("uno de los cambos esta vacio");</script>';
		}
		return $DatFilas;
		//echo count($DatFilas) ;
	}

	public function purificador(){

	}

	public function arpolos(){
		return $this->decomponer($this->den);
	}

	public function arceros(){
		return $this->decomponer($this->num);
	}


}
?>