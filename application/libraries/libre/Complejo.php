<?php
class Complejo{
        public $r;
        public $i;

        public function __construct($r=0,$i=0) {
          $this->r=$r;
          $this->i=$i;
        }

      public static function Tpascal($orden){

          $pasc=array();
       		$n=$orden;
       		$x=0; $i=0; $j=0;
    	    $pascx=array();
    	   //valida el numero de lineas
    	   	for ($i=1; $i<=$n ; $i++)
    	   	{
    	         //Construimos el triangulo de pascal
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
    	        //Truco para imprimir el triangulo
    	 		for($j=0; $j<$x; $j++)
    	        {
    	             $pascx[$j]=$pasc[$j];
    	        }
    	   	}
    	   	return $pascx;
    		//return 0;
      }

      public static function comparar($a, $b){
         if(is_object($a)==true) {
             if(is_object($b)==true){
                  if($a->r==$b->r) $real=1;
                  else $real=0;
                  if($a->i==$b->i) $imag=1;
                  else $imag=0;

                  if($imag==1 && $real==1) $res=true;
                  else $res=false;

                  return $res;
              }else{
                 echo '<script type="text/javascript">alert("el segundo elemento del metodo comparar, del objeto complejo, no es una clase");</script>';
              }
              return 0;
         }else{
               echo '<script type="text/javascript">alert("el primer elemento del metodo comparar, del objeto complejo, no es una clase");</script>';
               return 0;
         }
      }

      public static function powc($complejo,$grado){
      	$multiplicador=self::Tpascal($grado+1);
      	$a=$complejo->r;
      	$b=$complejo->i;
        $resfor=0;
        $real=0;
        $imag=0;

        $aa=array();
        $bb=array();
        $powi=array();
        $ix=0;
        for($i=count($multiplicador)-1;$i>=0; $i--){
          $aa[$i]=pow($a, $i);
          $bb[$i]=pow($b, $ix);
          $powi[$i]=($ix % 4 );
         // echo "<hr> a^$i ".$aa[$i]." b^$ix".$bb[$i]."i^".$powi[$i]."<hr>";
          $ix++;
        }

        //echo "<h3>objeto: complejo, metodo: powc Bandera:2 = inestable</h3>";
        $cadenat='';
        for($i=0;$i<count($multiplicador); $i++){
            //echo "<hr> a^$i ".$aa[$i]." b^$i ".$bb[$i]." i^".$powi[$i]."<hr>";
            $resfor=$aa[$i]*$bb[$i]*$multiplicador[$i];
            //echo "<h4>($aa[$i])($bb[$i])(".$multiplicador[$i].")</h4>";
            switch ($powi[$i]) {
              case 0:
                //real positivo
                $real=$real+$resfor;
                $cadenat=$cadenat."(".$real.") ";
              break;

              case 1:
                //complejo positivo
                $imag=$imag+$resfor;
                $cadenat=$cadenat."(".$imag."i ) ";
              break;
              
              case 2:
                //real negativo
                 $real=$real-$resfor;
                 $cadenat=$cadenat."(".$real.") ";
              break;

              case 3:
                //complejo negativo
                $imag=$imag-$resfor;
                $cadenat=$cadenat."(".$imag."i ) ";
              break;
            }
            $cadenat=$cadenat.$cadenat;
        }

      	return new Complejo($real, $imag);
      }


      public static function add($a, $b)   {
        $real=$a->r+$b->r;
        $imag=$a->i+$b->i;
        return new Complejo($real, $imag);
      }

      public static function sub($a, $b) {
        $real=$a->r-$b->r;
        $imag=$a->i-$b->i;
        return new Complejo($real, $imag);
      }

      public static function mul($a, $b){
       if(is_object($a)==true) {
           if(is_object($b)==true) {
                //$real=$a->r*$b->r-$a->i*$b->i;
                //$imag=$a->i*$b->r+$a->r*$b->i;

                $real=$a->r*$b->r-$a->i*$b->i;
                $imag=$a->r*$b->i + $a->i*$b->r;
                return new Complejo($real, $imag);
            }else{
               return self::muldo($b,$a);
            }
       }else{
            return self::muldo($a,$b);
       }
      }

      public static function conjg($z){
        return new Complejo($z->r, -$z->i);
      }

      public static function div($a, $b) {
        $c=new Complejo();
        $real=0;
        $imag=0;
        $r=0;
        $den=1;
        if (abs($b->r) >= abs($b->i)) {
          $r=$b->i/$b->r;
          $den=$b->r+$r*$b->i;
          $real=($a->r+$r*$a->i)/$den;
          $imag=($a->i-$r*$a->r)/$den;
        } else {
          $r=$b->r/$b->i;
          $den=$b->i+$r*$b->r;
          $real=($a->r*$r+$a->i)/$den;
          $imag=($a->i*$r-$a->r)/$den;
        }
        return new Complejo($real, $imag);
      }

      public static function abs($z){
        $x=0.0;$y=0.0;$ans=0.0;$temp=0.0;
        $x=abs($z->r);
        $y=abs($z->i);
        if ($x == 0.0)
          $ans=$y;
        else if ($y == 0.0)
          $ans=$x;
        else if ($x > $y) {
          $temp=$y/$x;
          $ans=$x*sqrt(1.0+$temp*$temp);
        } else {
          $temp=$x/$y;
          $ans=$y*sqrt(1.0+$temp*$temp);
        }
        return $ans;
      }

      public static function sqrtz($z){
        $real=0.0; $imag=0.0;
        $x=$y=$w=$r=0.0;
        if (($z->r == 0.0) && ($z->i == 0.0)) {
          return new Complejo();
        } else {
          $x=abs($z->r);
          $y=abs($z->i);
          if ($x >= $y) {
            $r=$y/$x;
            $w=sqrt($x)*sqrt(0.5*(1.0+sqrt(1.0+$r*$r)));
          } else {
            $r=$x/$y;
            $w=sqrt($y)*sqrt(0.5*($r+sqrt(1.0+$r*$r)));
          }
          if ($z->r >= 0.0) {
            $real=$w;
            $imag=$z->i/(2.0*$w);
          } else {
            $imag=($z->i >= 0) ? $w : -$w;
            $real=$z->i/(2.0*$imag);
          }
          return new Complejo($real, $imag);
        }
      }
//numero double y objeto
      public static function muldo($x, $a){
        return new Complejo($x*$a->r, $x*$a->i);
      }

 //cambia de signo el numero complejo

      public static function invSigno($x){
        return new Complejo(-$x->r, -$x->i);
      }

      public function __toString(){
           if($this->i>=0) return "$$".(double)$this->r." + ".(double)$this->i."i"."$$";
           return "$$".(double)$this->r." - ".-(double)$this->i."i"."$$";
      }
  }


?>