<?php
class Bode{
    private $ceros;
    private $polos;
    private $num;
    private $den;
    //en el diagrama de bode solo entran numeros de tipo array y son las raices y ceros del sistema
    public function __construct($ceros=array(), $polos=array(), $num=array(), $den=array()){
        $this->ceros=$ceros;
        $this->polos=$polos;
        $this->num=$num;
        $this->den=$den;
       //$this->puntosgrafica();
    }

    public function puntosgrafica(){
        $texto="";
        $valores=array();

        //if(!is_array($this->ceros)) {
        //    $data=array($this->ceros);
        //}else{
            $data=$this->ceros;
        //}
        $data=array_merge($data,$this->polos);
        
        for($i=0; $i<count((array)$data); $i++){
            $valores[]=$data[$i][0];
        }
        //$valores=ksort($valores);


        for($i=0; $i<count((array)$valores); $i++){
            $w0=$valores[$i];
            $fractime=$w0/6;
           // for($m=-6; $m<6; $m++){
               $datax=$valores[$i];//+1*pow(10, $m);
               $texto=$texto.$datax."</br>";
            //}
        }
        return $texto;
    }    

    public function magnitud(){

    }

    public function __toString(){
        return $this->puntosgrafica();
    }

}
?>