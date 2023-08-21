 public static function latexpoli($polinomio){
    $i=0;
    $gradop=count($polinomio)-1;
    $cadena='';
    if(count($polinomio)>1){
      
          if($polinomio[$i]==1) $rata='';
          else $rata=$polinomio[$i];
          //rtrim(rtrim(sprintf('%.8F', '%.8F', $var), '0'), ".")
            if($gradop>1){
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".rtrim(rtrim(sprintf('%.8F', number_format($rata,15) ), '0'), ".")."z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z^{".$gradop."}";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.8F', number_format($rata,15) ), '0'), ".")."s^".$gradop;
          }else{
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".rtrim(rtrim(sprintf('%.8F', number_format($rata,15) ), '0'), ".")."z";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.8F', number_format($rata,15) ), '0'), ".").'z';
          }
          
            for($i=1;$i<count($polinomio)-1;$i++){
            $gradop-=1;
            if($gradop>1){
                if ($polinomio[$i]>0) $cadena=$cadena. "+".rtrim(rtrim(sprintf('%.8F', number_format($polinomio[$i],15) )), '0'), ".")."z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.8F', number_format($polinomio[$i],15) )), '0'), ".")."z^{".$gradop."}";
            }else{
                if ($polinomio[$i]>0) $cadena=$cadena. "+".rtrim(rtrim(sprintf('%.8F', number_format($polinomio[$i],15) )), '0'), ".").'z';
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.8F', number_format($polinomio[$i],15) )), '0'), ".").'z';
            }
      
          }

          if ($polinomio[$i]>0) $cadena=$cadena. "+".rtrim(rtrim(sprintf('%.8F', number_format($polinomio[$i],15) )), '0'), ".");
          else{
            if($polinomio[$i]<0) $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.8F', number_format($polinomio[$i],15) )), '0'), ".");
            else $cadena=$cadena.'';
          }
    }else $cadena=$polinomio[0];
    return $cadena;
  }


    public static function latexpoli($polinomio){
    $i=0;
    $gradop=count($polinomio)-1;
    $cadena='';
    if(count($polinomio)>1){
      
          if($polinomio[$i]==1) $rata='';
          else $rata=$polinomio[$i];
          //rtrim(rtrim(sprintf('%.8F', $var), '0'), ".")
            if($gradop>1){
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".$rata."z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z^{".$gradop."}";
                else $cadena=$cadena. '-'.-$rata."s^".$gradop;
          }else{
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".$rata."z";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z";
                else $cadena=$cadena. '-'.-$rata.'z';
          }
          
            for($i=1;$i<count($polinomio)-1;$i++){
            $gradop-=1;
            if($gradop>1){
                if ($polinomio[$i]>0) $cadena=$cadena. "+".$polinomio[$i]."z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '-'.-$polinomio[$i]."z^{".$gradop."}";
            }else{
                if ($polinomio[$i]>0) $cadena=$cadena. "+".$polinomio[$i].'z';
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '-'.-$polinomio[$i].'z';
            }
      
          }

          if ($polinomio[$i]>0) $cadena=$cadena. "+".$polinomio[$i];
          else{
            if($polinomio[$i]<0) $cadena=$cadena. '-'.-$polinomio[$i];
            else $cadena=$cadena.'';
          }
    }else $cadena=$polinomio[0];
    return $cadena;
  }


sistema funcional




  public static function latexpoli($polinomio){
    $i=0;
    $gradop=count($polinomio)-1;
    $cadena='';
    if(count($polinomio)>1){
      
          if($polinomio[$i]==1) $rata='';
          else $rata=$polinomio[$i];
          //rtrim(rtrim(sprintf('%.3e', '%.3e', $var), '0'), ".")
            if($gradop>1){
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".rtrim(rtrim(sprintf('%.3e', number_format($rata,15) ), '0'), ".")."z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z^{".$gradop."}";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.3e', number_format(-$rata,15) ), '0'), ".")."s^".$gradop;
          }else{
                if ($polinomio[$i]>0 && $polinomio[$i]!=1) $cadena=$cadena. "".rtrim(rtrim(sprintf('%.3e', number_format($rata,15) ), '0'), ".")."z";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                  elseif ($polinomio[$i]==1) $cadena=$cadena. "z";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.3e', number_format(-$rata,15) ), '0'), ".").'z';
          }
          
            for($i=1;$i<count($polinomio)-1;$i++){
            $gradop-=1;
            if($gradop>1){
                if ($polinomio[$i]>0) $cadena=$cadena. "+".rtrim(rtrim(sprintf('%.3e', number_format($polinomio[$i],15) ), '0'), ".")."z^{".$gradop."}";
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.3e', number_format(-$polinomio[$i],15) ), '0'), ".")."z^{".$gradop."}";
            }else{
                if ($polinomio[$i]>0) $cadena=$cadena. "+".sprintf('%.3e', number_format($polinomio[$i],15) ), '0'), ".").'z';
                  elseif ($polinomio[$i]==0) $cadena=$cadena. "";
                else $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.3e', number_format(-$polinomio[$i],15) ), '0'), ".").'z';
            }
      
          }

          if ($polinomio[$i]>0) $cadena=$cadena. "+".rtrim(rtrim(sprintf('%.3e', number_format($polinomio[$i],15) ), '0'), ".");
          else{
            if($polinomio[$i]<0) $cadena=$cadena. '-'.rtrim(rtrim(sprintf('%.3e', number_format(-$polinomio[$i],15) ), '0'), ".");
            else $cadena=$cadena.'';
          }
    }else $cadena=$polinomio[0];
    return $cadena;
  }