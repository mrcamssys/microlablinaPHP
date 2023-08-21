<?php


class Ruth{
    
    public $pol;
    private $constante;
    private $tablaRuth;


    public function __construct($polinomio=array(), $k=1){
        if(!is_object($polinomio)){
            $this->pol=new polinomio(array(0,1));
        }else{
            $this->pol=$polinomio;
        }        
        $this->constante=$k;
    }

    public function creadorTabla(){
        $cantTerminos=count($this->pol->polinomio);
        $texto=" ";
        //crear primera fila del array
        $ii=0;
        for($i=0;$i<$cantTerminos;$i++){
            if($ii<$cantTerminos){
                if($ii==($cantTerminos-1)){
                    $num=new polinomio(array($this->constante,$this->pol->polinomio[$ii]));
                }else{
                    $num=new polinomio(array(0,$this->pol->polinomio[$ii]));
                }
                $den=new polinomio(array(0,1));
                $dato[0][]=new Fraccion($num,$den,'k');
                
            }
            $ii+=2;
        }
        $texto=$texto."<hr>";
        
        $ii=1;
        for($i=0;$i<$cantTerminos;$i++){
            if($ii<$cantTerminos){
                if($ii==($cantTerminos-1)){
                    $num=new polinomio(array($this->constante,$this->pol->polinomio[$ii]));
                }else{
                    $num=new polinomio(array(0,$this->pol->polinomio[$ii]));
                }
                $den=new polinomio(array(0,1));
                $dato[1][]=new Fraccion($num,$den,'k');
            }
            $ii+=2;
        }
        //igualamos las dos filas 
        $modulo=$cantTerminos%2;
        if($modulo!=0) $dato[1][]=new Fraccion(new polinomio(array(0,0)),new polinomio(array(0,1)));

        //se agrega otra columna con 0 en cada fila para 
        //poder hacer las operaciones en modo determinante
        $dato[0][]=new Fraccion(new polinomio(array(0,0)),new polinomio(array(0,1)));
        $dato[1][]=new Fraccion(new polinomio(array(0,0)),new polinomio(array(0,1)));
        $this->tablaRuth=$dato;
        return $dato;
    }
    /*operacion de la forma: Objetos fraccionario (c*b-a*d)/c  donde:
         |a b|
         |c d|
        */
    public function operacionBasica($a, $b, $c, $d){
        $resultado1=$c->fracMul($b)->fracRes($a->fracMul($d));
        return $resultado1->fracDiv($c);
    }

    public function ensambladortabla(){
        $this->creadorTabla();
        $dato=$this->tablaRuth;
        $cantdato=max(array_map('count',$dato));
        $grado=$this->pol->grado();

        for($i=2; $i<=$grado; $i++){
          for($a=0;$a<$cantdato-1; $a++){
                $dato[$i][$a]=$this->operacionBasica($dato[$i-2][0], $dato[$i-2][$a+1],$dato[$i-1][0], $dato[$i-1][$a+1]);
                //$dato[$i][$a]="$i,$a (".count($dato).")(".$grado.")";
            }
            $dato[$i][$a]=new Fraccion(new polinomio(array(0,0)),new polinomio(array(0,1)));
        }
        $this->tablaRuth=$dato;
        return $dato;
    }


}

?>