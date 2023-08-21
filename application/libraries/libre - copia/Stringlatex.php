<?php
class Stringlatex{
	/*public static function latexpoli($polinomio){
        //para mostrar al usuario polinomios en la forma: 
        //H(s)_n=as^(n-1) + bs^(n-2) +...+ cs^(2) + ds + e 


	  $i=0;
	  $gradop=count($polinomio)-1;
	  $cadena='';
	  if(count($polinomio)>1){
	  	
	        if($polinomio[$i]==1) $rata='';
	        else $rata=$polinomio[$i];
	        
            if($gradop>1){
	              if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".round($rata,3)."s^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "s^{".$gradop."}";
	              else $cadena=$cadena. '-'.round(-$rata,3)."s^".$gradop;
	        }else{
	              if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".round($rata,3)."s";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "s";
	              else $cadena=$cadena. '-'.round(-$rata,3).'s';
	        }
	        
            for($i=1;$i<count($polinomio)-1;$i++){
	          $gradop-=1;
	          if($gradop>1){
	              if ($polinomio[$i]>0) $cadena=$cadena. "+".round($polinomio[$i],3)."s^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
	              else $cadena=$cadena. '-'.round(-$polinomio[$i],3)."s^{".$gradop."}";
	          }else{
	              if ($polinomio[$i]>0) $cadena=$cadena. "+".round($polinomio[$i],3).'s';
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
	              else $cadena=$cadena. '-'.round(-$polinomio[$i],3).'s';
	          }
			
	        }

	        if ($polinomio[$i]>0) $cadena=$cadena. "+".round($polinomio[$i],3);
	        else{
	        	if($polinomio[$i]<0) $cadena=$cadena. '-'.round(-$polinomio[$i],3);
	        	else $cadena=$cadena.'';
	        }
	  }else $cadena=$polinomio[0];
	  return $cadena;
	}*/



public static function latexpoli($polinomio){
    $i=0;
    $gradop=count((array)$polinomio)-1;
    $cadena='';
    if(count((array)$polinomio)>1){
      
          if($polinomio[$i]==1) $rata='';
          else $rata=$polinomio[$i];
          //sprintf('%.4e', '%.4e', $var)
            if($gradop>1){
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "(".sprintf('%.4e', number_format($rata,15) ).")s^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "s^{".$gradop."}";
                else $cadena=$cadena. '- ('.sprintf('%.4e', number_format(-$rata,15) ).")s^".$gradop;
          }else{
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. " (".sprintf('%.4e', number_format($rata,15) ).")s";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "s";
                else $cadena=$cadena. '- ('.sprintf('%.4e', number_format(-$rata,15) ).')s';
          }
          
            for($i=1;$i<count($polinomio)-1;$i++){
            $gradop-=1;
            if($gradop>1){
                if ($polinomio[$i]>0) $cadena=$cadena. "+ (".sprintf('%.4e', number_format($polinomio[$i],15) ).")s^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '- ('.sprintf('%.4e', number_format(-$polinomio[$i],15) ).")s^{".$gradop."}";
            }else{
                if ($polinomio[$i]>0) $cadena=$cadena. "+ (".sprintf('%.4e', number_format($polinomio[$i],15) ).')s';
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '- ('.sprintf('%.4e', number_format(-$polinomio[$i],15) ).')s';
            }
      
          }

          if ($polinomio[$i]>0) $cadena=$cadena. "+ (".sprintf('%.4e', number_format($polinomio[$i],15) ).")";
          else{
            if($polinomio[$i]<0) $cadena=$cadena. '- ('.sprintf('%.4e', number_format(-$polinomio[$i],15) ).")";
            else $cadena=$cadena.'';
          }
    }else $cadena=$polinomio[0];
    return $cadena;
  }


  	public static function latexmultipol($polinomios){

        //para mostrar al usuario polinomios de la forma: 
        // P_2(s)*P_3(S)*P_4(s)*...*P_n(S)


    	$contapoli=count($polinomios);
    	$texto='';
	    for($i=0;$i<$contapoli;$i++){
	       $polin=$polinomios[$i];
	       if(count($polin)!=0) $texto=$texto."(".self::latexpoli($polin).")";
	    }
	    return $texto;
  	}

    public static function latexElevPol($den,$grado){
        //para mostrar al usuario polinomios a la n potencia por ejemplo: 
        //P_2(s)^n
      $texto=self::latexpoli($den);
      $grado=$grado+1;
      if($den[1]==0){
         if($grado==0) $texto=self::latexpoli($den);
         else  $texto=self::latexpoli($den)."^{".$grado."}";
      }else{
         if($grado==0) $texto="(".self::latexpoli($den).")";
         else $texto="(".self::latexpoli($den).")^{".$grado."}";
      }

      return $texto;
    }

	public static function latexPrintTF($num,$den,$fden=0,$grado=0,$i=""){
	   if($fden==0) return '<br><div class="table-responsive "> $$H_{'.$i.'}(s)=\frac{'.self::latexpoli($num).'}{'.self::latexmultipol($den).' }$$</div><br>';
       
       elseif($fden==2) return '<br><div class=\"table-responsive \"> $$H_{'.$i.'}(s)=\frac{'.self::latexpoli($num).'}{'.self::latexElevPol($den,$grado).' }$$</div><br>';

	   else return '<br><div class=\"table-responsive \"> $$H_{'.$i.'}(s)=\frac{'.self::latexpoli($num).'}{'.self::latexpoli($den).'}$$</div><br>';
	}

    public static function mostrarPolinomio($polinomio){
    	return '$$ \dot p(x) ='.self::latexpoli($polinomio).'$$';
    }


	public static function ImpRoos($polos){
        $texto1='';
        $mensaje="";
        $err=0;
        $alert=0;
        for($i=0; $i<=count($polos)-1;$i++){
            if($polos[$i][0]>0) $err=1;
            if($polos[$i][0]==0) $alert=1;
            
            if($polos[$i][1]>0){
                $sin='+';
                $poloi=round($polos[$i][1],4)."i";
            }
            elseif($polos[$i][1]==0){
                $sin='';
                $poloi='';
            }
            else{
                $sin='-';
                $poloi=round(-$polos[$i][1],4)."i";
            }
    	    
            

            $texto1=$texto1.'$$ s='.round($polos[$i][0],4).' '.$sin.' '.$poloi.'$$';
        }

        if($err>0) $mensaje=$mensaje.'<div class="alert alert-danger">Peligro:<br>Existe una posible inestabilidad.</div>'; 
         if($alert>0) $mensaje=$mensaje.'<div class="alert alert-warning">Alerta:<br>El sistema puede ser marginalmente estable o totalmente inestable.</div>';
            //$texto1=$texto1.'<div>';
        return $texto1.$mensaje;
    }

    public static function ImpRoosC($polosC){
            //para mostrar al usuario raices complejas de la forma:
            //C=a+bi o C=a-bi 

        $texto1='';
        for($i=0; $i<=count($polosC)-1;$i++){
            if($polosC->i>0){
                $sin='+';
                $poloi=$polosC->i;
            }else{
                $sin='-';
                $poloi=-$polosC->i;
            }
    	        $texto1=$texto1.'$$ '.$polosC->r.'s '.$sin.' '.$poloi.'i$$';
            }
            return $texto1;
        }

    public static function ImpPoliCom($pol){
        $texto1='';

        $polosC=$pol[1];
        for($i=0; $i<=count($polosC)-1;$i++){
            if($polosC->i>0){
                $sin='+';
                $poloi=$polosC->i;
            }else{
                $sin='-';
                $poloi=-$polosC->i;
            }
    	        $texto1=$texto1.'$$ s'.$sin." ".$polosC->r.' '.$sin.' '.$poloi.'i$$';
            }
            return $texto1;
        }
	}
?>