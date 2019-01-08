<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//use NumPHP\Core\NumArray;
//use NumPHP\LinAlg\LinAlg;
//use NumPHP\Core\NumPHP;

class TranferFuncion extends CI_Controller{

	//public $texto=array(array()); 

    public function __construct(){

        $this->texto['Error']='<b>Bienvenido:<br>recuerde que una funcion de tranferencia es de la forma 
        <div class="table-responsive"> 
        $$ H(s)= \frac{p_{num}}{P_{den}}=\frac{as^x+bs^{x-1}+bs^{x-2}+...+cs^2+ds+c}{as^n+bs^{n-1}+bs^{n-2}+...+cs^2+ds+c} $$</div>';
        $this->texto['Error']=$this->texto['Error'].'donde: \(x <  n.\) siendo x y n el grado de los polinomios en un sistema real modelado<br><b>'; 
        $this->texto['raices'][0]=""; 
        $this->texto['raices'][1]=""; 
        $this->texto['tf']="";
        $this->texto['Fparciales']="";
        $this->texto['inversaplace']="";
        $this->texto['puntos_grafica']=array();
        $this->texto['tiempos']=array();
        $this->texto['pCeros']=0;
        $this->texto['pPolos']=0;
        	$this->texto['Magnitud']="";
        	$this->texto['Frecuencia']="";



         parent::__construct();
                  $this->menu=[
            base_url()."TranferFuncion/calcular"=>"Funcion de Tranferencia",
            base_url()."TranferFuncion/close_loop"=>"Lazo Cerrado",
            base_url()."TranferFuncion/Generador"=>"Rlocus (Beta)",
            base_url()."TranferFuncion/Fuente"=>"Sistema con Diferentes Señales",
            base_url()."TranferFuncion/Bode"=>"Diagrama de bode",
            base_url()."help/tf"=>"Ayuda en la seccion",
         ];  
    }

	public function index()
	{

		//$this->calcular();

        $this->load->view('interface/head1');  
        //$this->load->view('interface/cabecera1');
        //$this->load->view('tranfer',$this->texto); 
        //$this->load->view('welcome_message'); 

        $this->load->view('menutranfer'); 
        $this->load->view('interface/pie1');    
		
	}

    private function librerias()
    {
       $this->load->library('libre/Complejo');
       $this->load->library('libre/DerivadaP');
       $this->load->library('libre/FracParcial');
       $this->load->library('libre/Raices');
       $this->load->library('libre/LimiteP');
       $this->load->library('libre/Paragrafica');
       $this->load->library('libre/Raices2poligrup');
       $this->load->library('libre/Stringlatex');
       $this->load->library('libre/Textbox2tf');
       $this->load->library('libre/Polinomio');
       $this->load->library('libre/Bode');
       $this->load->library('libre/Tf');
       $this->load->library('libre/Rlocus');
       $this->load->library('Menu1');

        //redirect("error404");
    }

	public function calcular()
    {


        $this->librerias();
        $this->texto['Error']=NULL;
        $pCeros=$this->input->post("ceros");
        $pPolos=$this->input->post("polos");
        $this->texto['pCeros']=$pCeros;
        $this->texto['pPolos']=$pPolos;
        $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
        $a=$this->textbox2tf->arceros();
        if(!is_array($a)) $a=array($this->textbox2tf->arceros());
        $denp=new Polinomio($this->textbox2tf->arpolos());
        $nump=new Polinomio($a);
        
        if($denp->grado()>$nump->grado()) {
            $tranferencia=new Tf($nump,$denp);
            $this->texto['tf']='<p>Funcion de transferencia digitada</p>'.$tranferencia.' ';

            
            list(,,$this->texto['raices'])=$tranferencia->getzp();
            list($this->texto['Fparciales'],$this->texto['inversaplace'])=$tranferencia->getfracpar();
            list($this->texto['puntos_grafica'],$this->texto['tiempos'])=$tranferencia->impulsotf();
         
        }elseif($pCeros==NULL &&  $pPolos==NULL) {
            $this->texto['Error']='<i>Bienvenido:<br>recuerde que una funcion de tranferencia es de la forma 
            <div class="table-responsive"> 
            $$ H(s)= \frac{p_{num}}{P_{den}}=\frac{as^x+bs^{x-1}+bs^{x-2}+...+cs^2+ds+c}{as^n+bs^{n-1}+bs^{n-2}+...+cs^2+ds+c} $$</div>
            '.'donde: \(x <  n.\) siendo x y n el grado de los polinomios en un sistema real modelado<br></b>'; 
        }
        else $this->texto['Error'] = "<div class=\"alert alert-warning\">Recuerde que:<br>Un sistema real modelado, el orden del numerador no puede ser mayor o igual al orden del denominador</div>";
        
        $this->texto['menux']=new Menu1($this->menu,"Funcion de Tranferencia");
        $this->load->view('interface/head1');  
        $this->load->view('tranfer',$this->texto); 
        $this->load->view('interface/pie1');    
	
	}
	
	
    public function close_loop(){
       $eval=$this->input->post("eval");
       $this->load->library('Menu1');
        if($eval=="ok"){
            if($this->input->post("cant")>0){ 
                $this->load->view('interface/head1'); 
                $this->texto['cant'] = $this->input->post("cant"); 
                $this->texto['menux']=new Menu1($this->menu,"Lazo Cerrado");
                $this->load->view('lazocerrado/recojersistemas',$this->texto);
                $this->load->view('interface/pie1');
            }else{
                $this->load->view('interface/head1'); 
                $this->texto['cant'] = "ingrese un valor mayor a 0"; 
                $this->texto['menux']=new Menu1($this->menu,"Lazo Cerrado");
                $this->load->view('lazocerrado/lazocerrado',$this->texto); 
                $this->load->view('interface/pie1');
            }
        }else{
            $this->load->view('interface/head1'); 
            $this->texto['cant'] = 1; 

        $this->texto['menux']=new Menu1($this->menu,"Lazo Cerrado");
            $this->load->view('lazocerrado/lazocerrado',$this->texto); 
            $this->load->view('interface/pie1');
        }
    }

    public function close_loop_sys(){
        $cantidad=$this->input->post("cantidad");
        $this->texto['cant']=$cantidad;
        $num=array();
        $den=array();
        if($cantidad!=NULL){
            $this->librerias();
            $this->load->view('interface/head1'); 
            for($i=1;$i<=$cantidad;$i++){
                $polos=$this->input->post("polos".$i);
                $ceros=$this->input->post("ceros".$i);
                $this->textbox2tf->campotexto2arreglo($ceros, $polos);
                $den[$i-1]=$this->textbox2tf->arpolos();
                $num[$i-1]=$this->textbox2tf->arceros();

                $this->texto['TF'][$i]="Funcion de tranferencia expresada de la forma<br>".stringlatex::latexPrintTF($this->textbox2tf->arceros(),$this->textbox2tf->arpolos(),1);
                if(count($this->textbox2tf->arpolos())>count($this->textbox2tf->arceros())){
                    $polosx=Raices::calculaRaices($this->textbox2tf->arpolos());
                    if(count($this->textbox2tf->arceros())>1)
                    {
                      $cerosx=Raices::calculaRaices($this->textbox2tf->arceros());
                      $p=count($polosx)-count($cerosx);
                      $this->texto['raices'][0][$i] = "<br>Ceros del sistema   ".stringlatex::ImpRoos($cerosx)."   <br>";
                      $this->texto['raices'][0][$i] = $this->texto['raices'][0][$i]."<center>Existe [".$p."] ceros en el infinito </center><br>";
                    }
                    else {
                        $this->texto['raices'][0][$i] =  "sistema tiene ".count($polosx). " ceros en el infinito";
                        $mag=$this->textbox2tf->arceros()[0];
                        $ceros=0;
                    }
                    $this->texto['raices'][1][$i] = "<br>Polos del sistema   ".stringlatex::ImpRoos($polosx)."   <br>";
                }else{
                    $this->texto['raices'][0][$i] = "";
                    $this->texto['raices'][1][$i] = "";
                }//findel separador de polos y ceros
            }


            if(count($num)>1){
                for($i=1;$i<count($num);$i++){
                    $operador1=new polinomio($num[$i]);
                    $operador2=new polinomio($den[$i]);
                    
                    $operador3=new polinomio($num[$i-1]);
                    $operador4=new polinomio($den[$i-1]);
                    
                    $nump=$operador1->mulPor($operador3);
                    $denp=$operador2->mulPor($operador4);
                }
            }else{
                $nump=new polinomio($num[0]);
                $denp=new polinomio($den[0]);
            }

            $this->texto['operanum']="Resultado de la Multiplicacion de Sistemas \(H_0(s)H_1(s)*...*H_n(s) \)<br>".stringlatex::latexPrintTF($nump->polinomio,$denp->polinomio,1);
            
            $numx=new polinomio($nump->polinomio);
            $denx=new polinomio($denp->polinomio);
            $denr=$denx->sumPor($numx);

            $this->texto['sden']=implode(",", $denr->polinomio);
            $this->texto['snum']=implode(",", $numx->polinomio);

            $this->texto['loop']='Resultado en lazo Cerrado \( \frac{1}{ \frac{1}{H_0(s)H_1(s)*...*H_n(s)} + 1 } \)<br>'.stringlatex::latexPrintTF($nump->polinomio,$denr->polinomio,1);
                 

        $this->texto['menux']=new Menu1($this->menu,"Lazo Cerrado");
            $this->load->view('lazocerrado/lazocerradores',$this->texto); 
            $this->load->view('interface/pie1');
        }else{
            redirect(base_url().'TranferFuncion/close_loop');
        }
    }

    public function Fuente(){
        $this->librerias();
        $this->load->view('interface/head1'); 
        
         $this->texto['menux']=new Menu1($this->menu,"Sistema con Diferentes Señales");
         $this->load->view('lazocerrado/vfuente',$this->texto); 
         $this->load->view('interface/pie1');
    }

    public function bode(){
        $this->librerias();
        $this->texto['Error']=NULL;
        $pCeros=$this->input->post("ceros");
        $pPolos=$this->input->post("polos");
        $this->texto['pCeros']=$pCeros;
        $this->texto['pPolos']=$pPolos;
        $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
        $a=$this->textbox2tf->arceros();
        if(!is_array($a)) $a=array($this->textbox2tf->arceros());
        $denp=new Polinomio($this->textbox2tf->arpolos());
        $nump=new Polinomio($a);
        
        if($denp->grado()>$nump->grado()) {
            $tranferencia=new Tf($nump,$denp);
            list($this->texto['bode'],$this->texto['fase'])=$tranferencia->getbode();         
        }elseif($pCeros==NULL &&  $pPolos==NULL) {
            $this->texto['Error']='<i>Bienvenido:<br>recuerde que una funcion de tranferencia es de la forma 
            <div class="table-responsive"> 
            $$ H(s)= \frac{p_{num}}{P_{den}}=\frac{as^x+bs^{x-1}+bs^{x-2}+...+cs^2+ds+c}{as^n+bs^{n-1}+bs^{n-2}+...+cs^2+ds+c} $$</div> '.'donde: \(x <  n.\) siendo x y n el grado de los polinomios en un sistema real modelado<br></b>'; 
        }
        else $this->texto['Error'] = "<b><span style=\"color:#FF5733;\">Recuerde que:<br>Un sistema real modelado, <br>el orden del numerador no puede ser mayor o igual al orden del denominador</b>";
        


         $this->load->view('interface/head1');          
         $this->texto['menux']=new Menu1($this->menu,"Diagrama de bode");
         $this->load->view('vbode',$this->texto); 
         $this->load->view('interface/pie1');
    }
    
    
    public function Generador(){
        $this->load->view('interface/head1'); 
        $printxc="";
        $printxp="";
        $printxpx="";
        
        $this->librerias();
        $this->texto['Error']=NULL;
        $pCeros=$this->input->post("ceros");
        $pPolos=$this->input->post("polos");
        $this->texto['pCeros']=$pCeros;
        $this->texto['pPolos']=$pPolos;
        $this->textbox2tf->campotexto2arreglo($pCeros, $pPolos);
        
        $a=$this->textbox2tf->arceros();
        if(!is_array($a)) $a=array($this->textbox2tf->arceros());
        $denf=new Polinomio($this->textbox2tf->arpolos());
        $numf=new Polinomio($a);
        
        
        
        
        $a="";
        $b="";
        $m="";
        $this->texto['mostrarPolos']="";
        $this->texto['phi']="";
        $this->texto['LGR1']="";
        $this->texto['LGR2']="";
        $this->texto['LGR3']="";
        
        if(count($this->textbox2tf->arpolos())>count($this->textbox2tf->arceros()) && count($this->textbox2tf->arpolos())>0)
        {
            
            $numarray=$this->textbox2tf->arceros();
            $printxpx="[";
            $printxc="[";    
            
            $ar=array();
            
            $ceross=Raices::calculaRaices($this->textbox2tf->arpolos());
            $polss=Raices::calculaRaices($this->textbox2tf->arceros());
           // $n_m=(count($ceross)-(count($polss)));
            
            if(count($this->textbox2tf->arceros())<=1) $n_m=(count($ceross)-(0));
            else $n_m=(count($ceross)-(count($polss)));    
            
            list($nump,$denp)=DerivadaP::derivfrac(new Polinomio(array(2)),new Polinomio(array(1,-2,-3)));
            
            
            if($n_m==0) $n_m=1;
            $kp=abs(array_sum($this->textbox2tf->arpolos())-array_sum($this->textbox2tf->arceros()))/($n_m);
            //suma de polos

            //para calcular el centroide
            $sumpolos=new Complejo();
            for($i=0;$i<count($ceross);$i++){
                $sumpolos=$sumpolos::add($sumpolos,new Complejo(-$ceross[$i][0],-$ceross[$i][1]));
            }
            
            //suma de CEROS
            $sumceros=new Complejo();
            if(count($this->textbox2tf->arceros())>1){
                for($i=0;$i<count($polss);$i++){
                    $sumceros=$sumceros::add($sumceros,new Complejo(-$polss[$i][0],-$polss[$i][1]));
                }
            }
            
            $cenum=$sumpolos::sub($sumpolos,$sumceros);
            $centroide=-round($cenum->r/$n_m,4);
            //fin calculo centroide
            
            $this->texto['phi']='Los angulos de las asintotas se pueden expresar con la formula: $$ \phi_a = 180°\frac{2q+1}{n-m}$$ donde $$ q=0,1,2...[n-m]-1 $$
             '; 
             
             $dataxx=new Rlocus($numf,$denf);
        
             
             
            for($i=0;$i<abs($n_m-1);$i++){
               $phix=(180/$n_m)*(2*$i+1);
               $phix=$phix/180;
               $phix=substr( $phix, strpos( $phix, "." ) );
               $phix=abs(round(180*$phix,4));
               $this->texto['phi']=$this->texto['phi']."$$ \phi_{$i} =\pm".$phix."°$$"." ".$dataxx->puntoscorte();
            }
           // $this->texto['phi']=$this->texto['phi']."n= ".count($ceross)." M= ".count($polss)."<br />";
            
            //calculo del k centroide
            $pol=$this->textbox2tf->arpolos();
            $sump=0;
            $ip=count($pol)-1;
            for($i=0;$i<count($pol);$i++){
                $sa=$pol[$i]*pow($centroide,$ip);
                $sump=$sump+$sa;
                $ip--;
            }
            if($sump==0) $sump=count($pol)*pow(2,2);
             //echo '<script>alert("no entra '.$ip.' '.$sump.' '.$sa.'")</script>';
            switch(count($this->textbox2tf->arceros())){
                case 1:
                    $k=round(1/$this->textbox2tf->arceros()[0]+abs($sump),4);
                break;
                //case count($this->textbox2tf->arceros())>1:
                  //   $k=50*max($this->textbox2tf->arceros())*$kp+abs($sump);
                //break;
                default:
                    $k=round(1.5*$kp+abs($sump),4);
                break;
            }
            
            
            
            
            $this->texto['LGR1']='<p><br>Calculo del Centroide<br>'.
            '$$\sigma_A=\frac{\sum(F_p)-\sum(F_z)}{n-m}$$ Entonces: $$\sigma_A='.$centroide."$$ <br>";
            $this->texto['LGR2']='Cantidad polos menos Cantidad de ceros<br> $$n-m='.$n_m.'$$ <br>';
            $this->texto['LGR3']='Promedio de valoresde k segun polinomio caracteristico  $$k='.$k.'$$ </p>';
            
            
            
            $this->texto['LGR1']=$this->texto['LGR1']."fsdfsjhd ".implode(' , ',$nump)." den=<br> ".implode(' , ',$denp)."<br>";
            //$this->texto['LGR1']=$this->texto['LGR1']."fsdfsjhd ".implode(' , ',$caca['num'])." den=<br> ".implode(' , ',$caca['den'])."<br>";
            
            $incremento=abs($k/2500);
            
            
            if(count($ceross[0])!=0)$pomin=abs(array_sum($ceross[0])/count($ceross[0]));
            for($i=0;$i<$k;$i=$i+$incremento){
              //  echo '<script>alert("no entra")</script>';
                //$operador1=new polinomio(array(($i*$i*$incremento*2)/(($pomin+1e-12)*0.001)));//mirar divisor 5000 para numeros muy grandes
                $operador1=new polinomio(array($i));
                
                $operador2=new polinomio(array(1));
                
                $operador3=new polinomio($this->textbox2tf->arceros());
                $operador4=new polinomio($this->textbox2tf->arpolos());
                
                $nump=$operador1->mulPor($operador3);
                $denp=$operador2->mulPor($operador4);
                $numx=new polinomio($nump->polinomio);
                $denx=new polinomio($denp->polinomio);
                $denr=$denx->sumPor($numx);
    
                
                $polos=Raices::calculaRaices($denr->polinomio);
   // echo "<script>alert('estoy aqui--')</script>";
                if(count($nump->polinomio)>1)
                {
                  $ceros=Raices::calculaRaices($nump->polinomio);
                  $p=count($polos)-count($ceros);
                  //$a= $a."<br>Ceros del sistema   ".stringlatex::ImpRoos($ceros)."   <br>";
                  if($i==$incremento){
                    $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."<hr><b>Ceros del Sistema</b><hr>
                    <div class=\"table-responsive\">  <table class=\"table\"> <thead><tr><th>$$\Re $$</th><th>$$\Im $$</th></tr></thead><tbody>";  
                    for($ix=0; $ix<count($ceros); $ix++){
                       $a=$ceros[$ix][0];
                       $b=$ceros[$ix][1];
                       $printxc=$printxc."{x:".$a.",y:".$b."},";
                       
      
                       $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."<td>".round($a,3)."</td><td>".round($b,3)."</td></tr>";
                       
                    }
                    $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."</tbody></table></div> ";  
                    $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."<p> Ceros en en el infinito: [".abs($p)."]</p>";
                  }
                }else {
                    $ceros=0;
                    if($i==$incremento) $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."<p> Ceros en en el infinito: [".count($polos)."]</p>";
                    if($i==$incremento) $printxc=$printxc."{x:0,y:0},";
                }
                
                
    
               
               for($ix=0; $ix<count($polos); $ix++){
                   $a=$polos[$ix][0];
                   $b=$polos[$ix][1];
                   
                   if($i==0){
                       $ar[$ix]="";
                       if($ix==0) $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."<hr><b>Polos del Sistema</b><hr>
                       <div class=\"table-responsive\">  <table class=\"table\"> <thead><tr><th>$$\Re $$</th><th>$$\Im $$</th></tr></thead><tbody>";
                       $printxpx=$printxpx."{x:".$a.",y:".$b."},";
                       $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."<td>".round($a,3)."</td><td>".round($b,3)."</td></tr>";
                       if($ix==count($polos)-1)  $this->texto['mostrarPolos']=$this->texto['mostrarPolos']."</tbody></table></div> ";  
                   } 
                  if($i>0)$ar[$ix]=$ar[$ix]."{x:".$a.",y:".$b."},";
                  
               }
               
              
                
            }//fin for
            
            $m=implode($ar);
            $printxc=$printxc."]";
            $printxpx=$printxpx."]";
        }
        
        $this->texto['ceros']=$printxc;//
        $this->texto['polos']="[".$m."]";
        $this->texto['polosx']=$printxpx;
                     
         //    ""=>"Funcion de tranferencia con Diferentes Señales",
         //    ""=>"Ayuda en la seccion TranferFuncion",
        $this->texto['menux']=new Menu1($this->menu,"Rlocus (Beta)");
        $this->load->view('rlocus/rlocus',$this->texto); 
        $this->load->view('interface/pie1');
    }
}//fin de la clase