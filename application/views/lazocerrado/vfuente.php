<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>





<div class="container">
<p></p>
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Funcion de Transferencia
        <small>Calculadora</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>TranferFuncion">Funcion de Transferencia</a>
        </li>
        <li class="breadcrumb-item active">Lazo Cerrado</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
	  <?php echo $menux;  ?>
       
       <div class="col-lg-9 mb-4">
		
<font style="color: red;">Este modulo esta en programacion por el momento.<br> existe un sistema interno con la funcion de transferencia \( H_0(s)\) de la forma: $$ H_0(s)=\frac{2}{s^2+2.5s+10} $$ y otro que puede ser facilmente modificable en la seccion de abajo de la forma: $$ H_1(s)\frac{33}{s^2+2.5s+33} $$ cambiando los valores {33}{2.5}{33} y cambiara la funcion de tranferencia automaticamente.<br> el resultado que se produce es como obtener dos sistemas sumados o en serie [\(H_{total}(s)=H_0(s)+H_1(s)\)]</font>
		
		
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
		</select>
		Amplitud fuente: <input class="form-control" type="text" value="1" name="fuente" class="fuente">
		Frecuencia en Hertz[Hz]:<input class="form-control" type="text" name="hz" class="hz" value="10"><br>
		Numerador: <input class="form-control"  type="text" name="num" class="mun" value="33"><br>
		Denominador: <input  class="form-control" type="text" name="den" class="den" value="1,2.5,33"><br>
		Muestreo: <input class="form-control" type="text" name="muestreo" class="muestreo"  value="0.01"><br>
		


		<input class="btn btn-primary" type="button" name="aceptar" value=".: Computar :." onclick="computar()">
	</form>
 </div>

 </div>
</div> 

<script type="text/javascript">

		var aa=33,bb=2.5,cc=33,muestrax=0.01,señal=1,generador=0,pp='dc',tx=0,k=0,frec=10;
		function tb2array(dato){
			var separador=',';
			var arrayDeCadenas = dato.split(separador);
			//for (var i=0; i < arrayDeCadenas.length; i++) {
      			//document.write(arrayDeCadenas[i] + " / ");
   			//}
			return arrayDeCadenas;
		}

		function computar(){
			aa=parseFloat(document.carlos.num.value);
			var numeradores=tb2array(document.carlos.den.value);
			bb=parseFloat(numeradores[1]);
			cc=parseFloat(numeradores[2]);
			muestrax=parseFloat(document.carlos.muestreo.value);
			señal=0;
			generador=parseFloat(document.carlos.fuente.value);
			frec=1/parseFloat(document.carlos.hz.value);
			pp=document.carlos.fuentegen.value;
			//alert(pp);
		}

		
		function fuente(t,sig){
			//var camssys=gerador;
			var m=0;
			switch(sig){
				case "dc":
					camssys=generador;
				break;
				case "sin":
					camssys=generador*Math.sin((2*3.141592/frec)*t);
					//alert("señal= "+camssys+"t= "+t);
				break;
				case "rec":					
					m=Math.sin((2*3.141592/frec)*t);
					if(m<0) s=1;
					if(m>0) s=0;
					camssys=generador*s;
					
					//camssys=generador;
				break;
				case "triag":
					m=Math.sin((2*3.141592/frec)*t);
					if(m<0) {
						s=2*(generador/frec)*k;
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
      		text: "Dinamica del sistema en tiempo"
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
      var xVal = dps.length +0.001;//etapa de muestreo del navegador
      var yVal = 0;
      var updateInterval = 1,conta=0;
      var inc=1;
      var systemx=new Array();
      var systemx2=new Array();
      var senales=new Array();
      senales[0]=0;
      senales[1]=0;
      senales[2]=0;
      senales[3]=0;
      
      senales[4]=0;
      senales[5]=0;
      senales[6]=0;
      senales[7]=0;
      
      var updateChart = function () {
            yVal=fuente(tx,pp);
            tx=tx+muestrax;
            

            systemx=tf2order(aa,bb,cc,yVal,senales);
            systemx2=tf2order(2,2.5,10,yVal,senales);
            
            y2Val=systemx[0]+systemx2[0];

            senales[0]=systemx[3];
      		senales[1]=systemx[4];
      		senales[2]=systemx[1];
      		senales[3]=systemx[2];

      		senales[4]=systemx2[3];
      		senales[5]=systemx2[4];
      		senales[6]=systemx2[1];
      		senales[7]=systemx2[2];






	      	dps.push({x: xVal,y: yVal});
	        dps2.push({x: xVal,y: y2Val});
	      	globals=dps.length;
	        xVal++;
	      	if (dps.length > 500 )
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