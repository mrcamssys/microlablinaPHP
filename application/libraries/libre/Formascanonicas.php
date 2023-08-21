<?php

class Formascanonicas{
    private $systema;
    private $error;
    private $texto;

    //en el diagrama de bode solo entran numeros de tipo array y son las raices y ceros del sistema
    public function __construct($transferFunction=0){
       if(is_object($transferFunction)){
            if(get_class($transferFunction)=="Tf"){
                $this->systema=$transferFunction;
                $this->error=0;
            }else  $this->error=1;
        }else  $this->error=1;
        $this->texto='No hay una matriz definida.  $$ \begin{vmatrix}
1\\\
a
\end{vmatrix}
=
\begin{vmatrix}
1 & 2 & 3\\\
a & b & c\\\
\end{vmatrix} $$';
    }


    public function unosdiagonales($x){
        $data=array();
        $m=0;
        for($h=0; $h<$x; $h++){
            for($v=0; $v<$x; $v++){
                if($v==($h+1)) $m=1;
                else $m=0;
                $data[$v][$h]=$m;  
            }
        }
        return $data;
    }

    public function array2latex($arreglo){
        $cantH=count((array)$arreglo);
        $cantV=count((array)$arreglo[0]);
        $texto='\begin{vmatrix}';


        if($cantH>1){
            for($h=0; $h<$cantH; $h++){
                if( $cantV>1){
                    for($v=0; $v<$cantV; $v++){
                        $texto=$texto.$arreglo[$v][$h]." & ";   
                    }
                    $texto=$texto.' \\\ ';
                }else{
                    $texto=$texto.$arreglo[$h]." & "; 
                }
            }  
        }else{
            for($v=0; $v<$cantV; $v++){
                $texto=$texto.$arreglo[0][$v].'\\\ ';   
            }
        }
        
        $texto=$texto.'\end{vmatrix}';
        return $texto;
    }


    public function invertirVector($vector){
        $arreglo[0]=$vector;
        return $arreglo;
    }

    public function organizar($matriz){
        $long=count((array) $matriz)-1;
        $narray=array();
        for($i=$long; $i>=0; $i--){
            $narray[]=$matriz[$i];
        }
        return  $narray;        
    }

    public function Controlable(){
        $den=$this->systema->den->polinomio;
        $num=$this->systema->num->polinomio;
        $valores=count((array) $den)-1;
        $valores2=count((array) $num)-1;
        $matriz = $this->unosdiagonales($valores);
        
        $m=0;
        for($i2=$valores; $i2>0; $i2--){
            $matriz[$m][$valores-1]=round(-1*$den[$i2],5);
            $m=$m+1;
        }
        //rescribir A
        for($i=0; $i<$valores; $i++){
            $nvalor[]=$this->organizar($matriz[$i]);
        }
        $A=$nvalor;

        for($i=0; $i<$valores-1; $i++) $B[$i]=0;
        $B[$valores-1]=1;    
        $B=$this->invertirVector($this->organizar($B));
        $m=0;

        $diferencia=abs($valores-$valores2);
        $p=0;
        for($i=0; $i<$valores; $i++){
            if($i<$diferencia-1)$matri[$i]=0;
            else{
                $matri[$i]=round($num[$p],5);
                $p++;
            }  
        }

        $C=$matri;        
        
        //$this->texto="\dot{x(t)}= ".$this->array2latex($this->organizar($A))."x(t) + ".$this->array2latex($B).'u(t) \\\ y(t)='.$this->array2latex($C)."x(t)";
        //return $A;
        return "\dot{x(t)}= ".$this->array2latex($this->organizar($A))."x(t) + ".$this->array2latex($B).'u(t) \\\ y(t)='.$this->array2latex($C)."x(t)";
   }


public function Observable(){
        $den=$this->systema->den->polinomio;
        $num=$this->systema->num->polinomio;
        $valores=count((array) $den)-1;
        $valores2=count((array) $num)-1;
        $matriz = $this->unosdiagonales($valores);
        
        $m=0;
        for($i2=1; $i2<$valores+1; $i2++){
            $matriz[0][$m]=round(-1*$den[$i2],5);
            $m=$m+1;
        }
        //rescribir A
        
        for($i=0; $i<$valores; $i++){
            $nvalor[]=$this->organizar($matriz[$i]);
        }
        $A=$this->organizar($matriz);

        for($i=0; $i<$valores; $i++) $B[$i]=0;
        $B[$valores-1]=1;    
        $C=$this->organizar($B);
        $m=0;

        $diferencia=abs($valores-$valores2);
        $p=0;
        for($i=0; $i<$valores; $i++){
            if($i<$diferencia-1)$matri[$i]=0;
            else{
                $matri[$i]=round($num[$p],5);
                $p++;
            }  
        }

        $B=$this->invertirVector($matri);        
        
        //$this->texto="\dot{x(t)}= ".$this->array2latex($this->organizar($A))."x(t) + ".$this->array2latex($B).'u(t) \\\ y(t)='.$this->array2latex($C)."x(t)";
        //return $A;
        return "\dot{x(t)}= ".$this->array2latex($this->organizar($A))."x(t) + ".$this->array2latex($B).'u(t) \\\ y(t)='.$this->array2latex($C)."x(t)";
   }






    public function __toString(){
        if($this->error==0){
            //$this-> unosdiagonales(7);
           

           $texto="<h3>Forma Canónica Controlable</h3>"."$$".$this->Controlable()."$$ <hr>";
           $texto=$texto."<h3>Forma Canónica Observable</h3>"."$$".$this->observable()."$$ <hr>";


           return $texto;
        }else{
            return '
            <div class="alert alert-danger" role="alert">
                  <h4 class="alert-heading">Error inesperado!</h4>
                  <p>Al parecer la función de transferencia digitada o el sistema que desea convertir es incompatible con el formato lógico de la librería, verifique los términos digitados e intente de nuevo.</p>
                  <hr>
                  <p class="mb-0">Librería de variables de estado.</p>
            </div>';
        }
    }

}
?>