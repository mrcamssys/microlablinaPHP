<?php
class Tustin{
     //numerador entra en formma de arreglo
    //r=z^-1 
     private $nums;
     private $dens;
     private $vdiv;
     private $t;
     public function __construct(){
        $this->nums=array();
        $this->dens=array();
        $this->vdiv=0;
        $this->t=0.001;
     }   

     //opcional
     public function muestra($muestra){
      $this->t=$muestra;
     }

      private function operador($orden,$ac=1){
        $oper=array();
        $o=1;
        if($ac==1){
         for($i=0; $i<=$orden ; $i++){
            $a=$o%2;
            if($a==1) $a=1;
            else $a=-1;
            $oper[$i]=$a;
            $o++;
         }
        }else{
          for($i=0; $i<=$orden ; $i++){
            $oper[$i]=1;
          }
        }

         return $oper;
      }
      

     public  function Tpascalz($orden, $ac=1){

          $pasc=array();
          $n=$orden+1;
          $x=0; $i=0; $j=0;
          $pascx=array();
         
          for ($i=1; $i<=$n ; $i++)
          {
               
               for ($j=$x; $j>=0; $j--)
               {
                   if($j==$x || $j==0)
                   {
                        $pasc[$j] = 1;
                   }
                   else
                   {
                        $pasc[$j] = $pasc[$j] + $pasc[$j-1];
                   }
               }
              $x++;
              
              $cams=$this->operador($x,$ac);
          for($j=0; $j<$x; $j++)
              {
                   $pascx[$j]=$pasc[$j]*$cams[$j];
              }
          }
          return $pascx;
        //return 0;
      }

      public function Entrar_sistema(&$num,&$den){
          $this->nums=$num;
          $this->dens=$den;
      }




      public function A($mul,$orden){
          $sis=count($this->Tpascalz($orden));
          $potencia=pow(2, $orden);
          foreach ($this->Tpascalz($orden) as &$i) {
            $poxlim[]=$mul*$potencia*$i;
          }
          return new polinomio($poxlim);
      }

      public function B($orden){
        $sis=count($this->Tpascalz($orden,0));
        $potencia=pow($this->t, $orden);
        foreach ($this->Tpascalz($orden,0) as &$i) {
            $poxlim[]=$potencia*$i;
        }
        return new polinomio($poxlim);
      }


      public function mulden(){
        $gden = $this->dens->grado();
        $gradpol=0;
        for($i=$gden; $i>=1;$i--){
          if($i==$gden){
            $mulAP[$i]=$this->A($this->dens->polinomio[$gradpol],$i);
          }else{
             $mulAP[$i]=$this->A($this->dens->polinomio[$gradpol],$i)->mulPor($this->B($gradpol));
            /// $morgan=$this->A($this->dens->polinomio[$gradpol],$i);
          }
          $gradpol++;
        }
        $k=new polinomio(array($this->dens->polinomio[$gden]));
        $mulAP[0]=$k->mulPor($this->B($gden));
        return $mulAP ;
      }

      public function sumapolnum(){
        $conta=count($this->mulden())-1;
        $p=$this->mulden()[0];
        for($i=1; $i<=$conta; $i++){
          $p=$p->sumPor($this->mulden()[$i]);
        }
        $this->vdiv=$p->polinomio[0];
        $conta=count($p->polinomio)-1;
        for($i=0; $i<=$conta; $i++){
          $polfin[$i]=round($p->polinomio[$i]/$this->vdiv,4);
        }
        return new polinomio($polfin);
      } 


      public function mulnum(){
        
        $gnum = $this->nums->grado();
        $gden = $this->dens->grado(); 
        $gradpol=0;
        
        if($gnum==0){
          $gradox=$this->nums->mulPor($this->B($gden));
          for($i=0; $i<=$gradox->grado(); $i++){
            $polfin[$i]=$gradox->polinomio[$i]/$this->vdiv;
          }
          return new polinomio($polfin);
        }else{
          $gden = $this->dens->grado();
          $gnum = $this->nums->grado();
          $conta1=$gnum;
          $conta2=$gden-$gnum;

          for($i=0; $i<=$gnum; $i++){           
              $arreglo[$i]=$this->A($this->nums->polinomio[$i],$conta1)->mulpor($this->B($conta2));
              $conta1=$conta1-1;
              $conta2=$conta2+1;
          }

          $conta=count($arreglo);
          $p=$arreglo[0];
          for($i=1; $i<$conta; $i++){
            $p=$p->sumPor($arreglo[$i]);
          }

          $conta=count($p->polinomio);
          for($i=0; $i<$conta; $i++){
             $polfin[$i]=$p->polinomio[$i]/$this->vdiv;
          }

          return new polinomio($polfin);
        }
      
      }

/*modelo experimental*/

public static function latexpoli($polinomio){
    $i=0;
    $gradop=count($polinomio)-1;
    $cadena='';
    if(count($polinomio)>1){
      
          if($polinomio[$i]==1) $rata='';
          else $rata=$polinomio[$i];
          //sprintf('%.3e', '%.3e', $var)
            if($gradop>1){
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "(".sprintf('%.3e', number_format($rata,15) ).")z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z^{".$gradop."}";
                else $cadena=$cadena. '- ('.sprintf('%.3e', number_format(-$rata,15) ).")z^".$gradop;
          }else{
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. " (".sprintf('%.3e', number_format($rata,15) ).")z";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z";
                else $cadena=$cadena. '- ('.sprintf('%.3e', number_format(-$rata,15) ).')z';
          }
          
            for($i=1;$i<count($polinomio)-1;$i++){
            $gradop-=1;
            if($gradop>1){
                if ($polinomio[$i]>0) $cadena=$cadena. "+ (".sprintf('%.3e', number_format($polinomio[$i],15) ).")z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '- ('.sprintf('%.3e', number_format(-$polinomio[$i],15) ).")z^{".$gradop."}";
            }else{
                if ($polinomio[$i]>0) $cadena=$cadena. "+ (".sprintf('%.3e', number_format($polinomio[$i],15) ).')z';
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '- ('.sprintf('%.3e', number_format(-$polinomio[$i],15) ).')z';
            }
      
          }

          if ($polinomio[$i]>0) $cadena=$cadena. "+ (".sprintf('%.3e', number_format($polinomio[$i],15) ).")";
          else{
            if($polinomio[$i]<0) $cadena=$cadena. '- ('.sprintf('%.3e', number_format(-$polinomio[$i],15) ).")";
            else $cadena=$cadena.'';
          }
    }else $cadena=$polinomio[0];
    return $cadena;
  }


    public static function latexmultipol($polinomios){

      $contapoli=count($polinomios);
      $texto='';
      for($i=0;$i<$contapoli;$i++){
         $polin=$polinomios[$i];
         if(count($polin)!=0) $texto=$texto."(".self::latexpoli($polin).")";
      }
      return $texto;
    }

      public static function latexPrintTF($num,$den,$fden=0){
          if($fden==0) return '<br>$$H(z)=\frac{'.self::latexpoli($num).'}{'.self::latexmultipol($den).' }$$<br>';
          elseif($fden==2) return '<br>$$H(z)=\frac{'.self::latexpoli($num).'}{'.self::latexElevPol($den).' }$$<br>';
          else return '<br>$$H(z)=\frac{'.self::latexpoli($num).'}{'.self::latexpoli($den).'}$$<br>';
      }

      public static function mostrarPolinomio($polinomio){
        return '$$ \dot p(x) ='.self::latexpoli($polinomio).'$$';
      }

      public function imprimir(){
        $den=$this->sumapolnum();//denominadorz
        $num=$this->mulnum();//numeradorz

        return "<h5>Transformación Bilineal</h5>Esta función se usa, para trabajar con la función de transferencia  usando otras señales esta varia según el periodo de muestreo.<br>
        <div class=\"table-responsive \">".self::latexPrintTF($num->polinomio,$den->polinomio,3)."</div>";
      }



/*fin del modelo experimental*/


      public function constructor(){
        $den=$this->sumapolnum();//denominadorz
        $num=$this->mulnum();//numeradorz

        $minZu=$den->grado()-$num->grado();
        $maxZu=$den->grado();  
        $texto="";
        $textox="";
        $conta=0;
        $declaradores="";
        $aux=$maxZu;
        $aux2=$maxZu-1;
        $trauma=0;
        for($i=$minZu;$i<=$maxZu; $i++){
          $roto=$num->polinomio[$conta];
          if($i==0) {
            $texto=$texto.'parseFloat('.$roto.")*u";
            $textox=$textox."var u=0;\n";
          }else {
            $texto=$texto.'parseFloat('.$roto.")*u_".$i."";
            $textox=$textox."var u_".$i."=0;\n";
          }
          if($i!=$maxZu) $texto=$texto.' + ';
          $conta++;
        
          if($aux>1){
            $declaradores=$declaradores."u_".$aux." = u_".$aux2."; \n\t\t\t";
            $aux=$aux-1;
            $aux2=$aux2-1;
          }else{
            if($trauma==0) $declaradores=$declaradores."u_1 = u;\n";
            $trauma=1;
          }

        }

        

        $conta=1;
        $texto=$texto." + ";
        $aux=$maxZu;
        $aux2=$maxZu-1;
        for($i=1; $i<=$maxZu; $i++){
          $roto= -1*$den->polinomio[$conta];
          $texto=$texto.'parseFloat('.$roto.")*y_".$i."";
          $textox=$textox." var y_".$i."=0;\n";
          if($i!=$maxZu) {
            $texto=$texto.' + ';
          }

          if($aux>1){
            $declaradores=$declaradores."y_".$aux." = y_".$aux2."; \n\t\t\t";
            $aux=$aux-1;
            $aux2=$aux2-1;
          }else{
            $declaradores=$declaradores."y_1 = y;";
          }
          $conta++;
        }
        $texto="u=yVal;\n\t\t\ty=".$texto;
        $textox=$textox." var y=0;";
        //$texto=$den->polinomio[1];
        return array($texto.";", $textox,$declaradores,$this->t);
      }


      public function constructor2(){
        $den=$this->sumapolnum();//denominadorz
        $num=$this->mulnum();//numeradorz

        $minZu=$den->grado()-$num->grado();
        $maxZu=$den->grado();  
        $texto="";
        $textox="";
        $conta=0;
        $declaradores="";
        $aux=$maxZu;
        $aux2=$maxZu-1;
        $trauma=0;
        for($i=$minZu;$i<=$maxZu; $i++){
          $roto=$num->polinomio[$conta];
          if($i==0) {
            $texto=$texto.'('.$roto.")*u";
            $textox=$textox."float u=0;<br>";
          }else {
            $texto=$texto.'('.$roto.")*u_".$i."";
            $textox=$textox."float u_".$i."=0;<br>";
          }
          if($i!=$maxZu) $texto=$texto.' + ';
          $conta++;
        
          if($aux>1){
            $declaradores=$declaradores."u_".$aux." = u_".$aux2."; <br>";
            $aux=$aux-1;
            $aux2=$aux2-1;
          }else{
            if($trauma==0) $declaradores=$declaradores."u_1 = u;<br>";
            $trauma=1;
          }

        }

        

        $conta=1;
        $texto=$texto." + ";
        $aux=$maxZu;
        $aux2=$maxZu-1;
        for($i=1; $i<=$maxZu; $i++){
          $roto= -1*$den->polinomio[$conta];
          $texto=$texto.'('.$roto.")*y_".$i."";
          $textox=$textox." float y_".$i."=0;<br>";
          if($i!=$maxZu) {
            $texto=$texto.' + ';
          }

          if($aux>1){
            $declaradores=$declaradores."y_".$aux." = y_".$aux2."; <br>";
            $aux=$aux-1;
            $aux2=$aux2-1;
          }else{
            $declaradores=$declaradores."y_1 = y;";
          }
          $conta++;
        }
        $texto="u=senal_entrada;<br><br>y=".$texto;
        $textox=$textox." float y=0;";
        //$texto=$den->polinomio[1];
        return array($texto.";", $textox,$declaradores,$this->t);
      }

}
?>