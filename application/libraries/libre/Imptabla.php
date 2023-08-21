<?php
class Imptabla{

    public $tamcolum;
    public $tamfilas;
    public $datos;

    public function __construct($arrayName=array(array())){
        $this->tamfilas = count( $arrayName ); 
        $this->tamcolum = max( array_map('count', $arrayName) );
        $this->datos=$arrayName;
    }


    public function titulo(){
        $texto='<thead><tr>';
        $texto=$texto.'<th scope="col">#</th>';
        for($i=0; $i<$this->tamcolum; $i++){
            $texto=$texto.'<th scope="col">C'.$i.'</th>';
        }
        $texto=$texto.'</tr></thead>';
        return $texto;
    }

    public function contenido(){
        $texto='<tbody>';
        for($f=0;$f<$this->tamfilas;$f++){
            $texto=$texto.'<tr><th scope="col">F'.$f.'</th>';
            for($c=0;$c<$this->tamcolum;$c++){
                $texto=$texto.'<td>'.$this->datos[$f][$c].'</td>';
            }   
            $texto=$texto.'</tr>';
        }

        $texto=$texto.'</tbody>';
        return $texto;
    }


    public function __toString(){
        $texto='<div class="overflow-auto"><table class="table table-bordered table-hover" >';
        $texto=$texto.$this->titulo();
        $texto=$texto.$this->contenido();
        $texto=$texto.'</table></div>';
        return $texto;
	}

}
?>