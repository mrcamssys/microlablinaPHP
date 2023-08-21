<?php
    class Raices2poligrup{
    	private $raices;
    	private $polinomireal;
    	private $polinomiocomplejo;
        private $poliden; 


    	public function __construct($roots=array()){
    		$this->raices=$roots;
    		$this->polinomioreal=array();
    		$this->polinomiocomplejo=array(array());
            $this->poliden=array(array());
    	}


        public function iniciar($roots){
            $this->raices=$roots;
            $this->polinomioreal=array();
            $this->polinomiocomplejo=array(array());
            $this->poliden=array(array());
        }

    	private function agrparRC(){
    		$contador=count($this->raices);
            //echo "<br><hr>polinomiocomplejo= ".$contador."<br>";
    		$subcontador1=0;
    		$subcontador2=0;
    		for($i=0; $i<$contador; $i++){
    			if($this->raices[$i][1]!=0){
    				$this->polinomiocomplejo[$subcontador1][0]=$this->raices[$i][0];
    				$this->polinomiocomplejo[$subcontador1][1]=$this->raices[$i][1];
    				$subcontador1=$subcontador1+1;
    			}else{
    				$this->polinomioreal[$subcontador2]=$this->raices[$i][0];
    				$subcontador2=$subcontador2+1;
    			}
    		}
    	}

    	private function encontrarCC(){
    		$contador=count($this->polinomiocomplejo);
    		//echo "<br><hr>polinomiocomplejo= ".$contador."<br>";
    		$racom=array(array());
    		$subcont=0;
    		for($i=0; $i<$contador; $i++){
                 
    			if($this->polinomiocomplejo[$i][1]>0){
                    //echo "<br><hr>raices= ".$this->polinomiocomplejo[$i][1]."<br>";
    				$racom[$subcont][0]=$this->polinomiocomplejo[$i][0];
    				$racom[$subcont][1]=$this->polinomiocomplejo[$i][1];
                    $subcont=$subcont+1;
    			}
    		}
    		return $racom;
    	}

    	private function regresarPolinomios(){
    		$this->agrparRC();
    		$racom=$this->encontrarCC();
    		$contador=count($racom);

    		$contador2=count($this->polinomioreal);
    		$stringpol="";
    		$stringpol2="";
    		$cadena="";

            $contapoli=0;
            $internos=0;

    	    for($i=0;$i<$contador;$i++){
    	    	$dato=-2*$racom[$i][0];
                //$dato1=($racom[$i][0]*$racom[$i][0]+$racom[$i][1]*$racom[$i][1]);
                $dato1=complejo::mul(new complejo($this->polinomiocomplejo[$i][0],$this->polinomiocomplejo[$i][1]),new complejo($this->polinomiocomplejo[$i][0],-$this->polinomiocomplejo[$i][1]));
                if($racom[$i][1]!=0){
    	    	 	$stringpol=$stringpol."1".",".Round($dato,4).",".Round($dato1->r,4)."";
                   
                    $this->poliden[$contapoli][0]=1;
                    $this->poliden[$contapoli][1]=Round($dato,4);
                    $this->poliden[$contapoli][2]=Round($dato1->r,4);
                    
                    if($i<($contador-1)){
                        $stringpol=$stringpol.";";
                        $contapoli=$contapoli+1;
                    } 
                }
    	    	 	//echo $stringpol;
    	    	
    	    }
            

    		$contapoli=$contapoli+1;
	    	for($i=0;$i<$contador2;$i++){
	    		$dato=-$this->polinomioreal[$i];
    	    	//if($dato!=0){
                  	$stringpol2=$stringpol2."1,".$dato."";
                    $this->poliden[$contapoli][0]=1;
                    $this->poliden[$contapoli][1]=$dato;
    	    	   	if($i<($contador2-1)) {
                        $stringpol2=$stringpol2.";";
                        $contapoli=$contapoli+1;
                    }
                //}
	    	}
    		
	    	if($contador-1>0 && $contador2-1>0) $cadena=$stringpol2.";".$stringpol;
	    	else $cadena=$stringpol2.$stringpol;
	    	return $cadena;
    	}


        public function poliDen(){
            $this->regresarPolinomios();
            return $this->poliden;
        }



        //pensar bien como quiero el resultadio
        
    	//public function __toString(){
    	//	return $this->regresarPolinomios();
    	//}
	}
?>
