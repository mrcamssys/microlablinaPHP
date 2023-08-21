<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
<p></p>
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Función de Transferencia
        <small>Calculadora</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>TranferFuncion">Función de Transferencia</a>
        </li>
        <li class="breadcrumb-item active">Lazo Cerrado</li>
      </ol>


      <!-- Content Row -->
      <div class="row">
	  <?php echo $menux;  ?>
       


       
       <div class="col-lg-9 mb-4">
		

		
<div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Ingrese datos</h3>
          	<form action="<?php echo base_url();?>TranferFuncion/Fuente" method="post" name="transfer" id="transfer" target="_parent" novalidate>
            <div class="control-group form-group">
              <div class="controls">
                <label>Numerador:</label>
                <input type="tel" class="form-control" name="ceros" id="ceros" value="<?php echo $pCeros;?>"  required data-validation-required-message=" ingrese los valores del Numerador">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Denominador:</label>
                <input type="tel" class="form-control" name="polos" id="polos" value="<?php echo $pPolos;?>" required data-validation-required-message="Ingreselos valores del denominador">
              </div>
            </div>
 			
		Muestreo: <input class="form-control" type="text" name="muestreo" class="muestreo"  value="<?php echo $pmuestreo;?>"><br>
		
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" id="">Simular Usando Señales</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Calcular')" id="">Calcular Datos</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Generador')" id="">Ver LGR</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/bode')" id="">Ver Diagrama de Bode</button>
             <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Fuente')" id="">Usar Fuentes</button>
              <!--<button type="button" class="btn btn-warning btn-sm" onclick="location.href ='<?php echo base_url();?>help/TranferFuncion?id=1218';" id="">Ayuda</button>-->
          </form>
        </div>
      </div>

<?= $Error;?>
		
	<div class="row">	
		<div  id="chartContainer" style="height: 100%; width: 100%;"></div>
    </div>
    <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
       	
       <!--<canvas width="700" height="500" id="chartContainer"></canvas>-->
	<hr>
	<h3>Ingrese datos de la señal</h3>
	<form action="" method="post" name="carlos">
		tipo de señal
		<select class="form-control" name="fuentegen"> 
		  <option value="dc" onclick='vista(0)'>continua</option>
		  <option value="rec" onclick="vista(1)">Rectangular</option>
		  <option value="sin" onclick="vista(1)">senoidal</option>
		  <option value="triag"  onclick="vista(1)">triangular</option>
		  <option value="schirp"  onclick="vista(1)">Simulacion Chirp</option>
		</select>
		Amplitud fuente: <input class="form-control" type="text" value="1" name="fuente" class="fuente">
		Frecuencia en Hertz[Hz]:<input class="form-control" type="text" name="hz" class="hz" value="10"><br>
		<span style="visibility: visible;">Frecuencia en Hertz final[Hz]:<input class="form-control" type="text" name="f1v" class="f1v" value="5"><br></span>
		<span style="visibility: visible;">Largo Axis:<input class="form-control" type="text" name="axislong" class="axislong" value="500"><br></span>
		<span style="visibility: visible;">Amplitud Planta:<input class="form-control" type="text" name="amp" class="amp" value="1"><br></span>

		<input class="btn btn-primary" type="button" name="aceptar" value=".: Computar :." onclick="computar()">
	</form>
 </div>

 </div>
</div> 

<script type="text/javascript">
		<?php list($funcion,$declarar_variables,$zxill,$muetre0)=$prueba; ?>
		var aa=33,bb=2.5,cc=33,muestrax=<?=$muetre0; ?>,señal=1,generador=0,pp='dc',tx=0,k=0,frec=10,f1=0, axes_largo=0, activity=0, ampx=1;
		function tb2array(dato){
			var separador=',';
			var arrayDeCadenas = dato.split(separador);
			return arrayDeCadenas;
		}

		function computar(){
			señal=0;
			alert("Cambio Datos de Simulacion");


			generador=parseFloat(document.carlos.fuente.value);
			frec=parseFloat(document.carlos.hz.value);
			f1=parseFloat(document.carlos.f1v.value);
			pp=document.carlos.fuentegen.value;
			axes_largo=parseInt(document.carlos.axislong.value);
			//if(pp=="schirp") document.carlos.fuentegen.f1v.visibility="visible";
			//else document.carlos.fiv.style.visibility="hidden";
			//alert(pp);
			ampx=parseInt(document.carlos.amp.value);
			activity=1;
		}

		
		function fuente(t,sig){
			//var camssys=gerador;
			var m=0;

			switch(sig){
				case "dc":
					camssys=generador;
				break;
				case "sin":
					camssys=generador*Math.sin((2*Math.PI*frec)*t);
					//alert("señal= "+camssys+"t= "+t);
				break;
				case "schirp":
					k=(f1-frec)/(4*muestrax);
					camssys=generador*Math.sin(2*Math.PI*(frec*t + (k/2)*t*t ) + 0 ) ;
					var sistem =1;
					sistem =sistem+1;
					//alert("señal= "+camssys+"t= "+t);
				break;
				case "rec":					
					m=Math.sin((2*Math.PI*frec)*t);
					if(m<0) s=1;
					if(m>0) s=0;
					camssys=generador*s;
				break;
				case "triag":
					m=Math.sin((2*Math.PI*frec)*t);
					if(m<0) {
						s=2*(generador*frec)*k;
						k=k+muestrax;
					}
					if(m>0) {s=0;k=0;};
					camssys=s;
				break;
				default:
					alert("no puedo leer la señal");
				break;
			}
			if(señal==0) {
				tx=0;
				//para las derivadas discretas

				señal=1;
			}
			return camssys;
		}

		function tf2order(a, b, c,u,paspres){
			var salida=new Array();
			var m = 0, k1 = 0, k2 = 0, k3 = 0, yp=0, Tm=muestrax;
			var Tmm=0;
			var y=0;
			u_1=paspres[0];
			u_2=paspres[1];
			y_1=paspres[2];
			y_2=paspres[3];

		   	Tmm=Tm*Tm;
		   	m  = a*Tmm;
		   	k1 = 4+ 2*b*Tm  +  c*Tmm; 
		   	k2 = 2*c*Tmm - 8;
		   	k3 = 4 - 2*b*Tm  +  c*Tmm;
		   	
		   	yp=-(k2/k1)*y_1 -(k3/k1)*y_2 + (m/k1)*u + 2*(m/k1)*u_1 + (m/k1)*u_2;
		   	y_2=y_1;
		  	y_1=yp; 
		   	u_2=u_1;
		   	u_1=u;
		   	
		   	salida[0]=yp;
		   	salida[1]=y_1;
		   	salida[2]=y_2;
		   	salida[3]=u_1;
		   	salida[4]=u_2;
			return salida;
		}                       
	</script>

	<script type="text/javascript">
	var globals=0;
      window.onload = function () {
      
      var dps = [{x: 0, y: 0}];   //dataPoints. 
       var dps2 = [{x: 0, y: 0}];  

      var chart = new CanvasJS.Chart("chartContainer",{
      	title :{
      		text: "Dinámica del sistema en tiempo"
      	},
      	axisX: {						
      		title: "Tiempo"
      	},
      	axisY: {						
      		title: "Amplitud"
      	},
      	data: [{
      		type: "line",
      		dataPoints : dps
      	},
            {
                  type: "line",
                  dataPoints : dps2
            }

            ]
      });

      chart.render();
      var xVal = dps.length + 0.001;//etapa de muestreo del navegador
      var yVal = 0;
      var updateInterval = 0.001,conta=0;
      var inc=1;
      var systemx=new Array();
      var systemx2=new Array();
      var senales=new Array();
      var y2Val=0;
      
      <?php  echo $declarar_variables; ?>

      var updateChart = function () {
            yVal=fuente(tx,pp);
            tx=tx+muestrax;
            

            <?= $funcion; ?>

            <?= $zxill; ?>
            y2Val=y;

	      	dps.push({x: xVal,y: yVal});
	        dps2.push({x: xVal,y: ampx*y2Val});
	      	globals=dps.length;
	        xVal++;

	        /*if(axes_largo<500 && axes_largo!=0){
	        	axes_largo=500;
	        }*/
	        if(axes_largo>5000){
	        	axes_largo=5000;
	        }

	        if(axes_largo==0){
	        	//chart.clear();
	        }



	      	if (dps.length > axes_largo )
	      	{
	      		dps.shift();
	            dps2.shift();	
	      	}
	      	chart.render();
	      };
	      setInterval(function(){updateChart()}, updateInterval);       
}


</script>


<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
