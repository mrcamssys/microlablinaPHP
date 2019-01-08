<?php


defined('BASEPATH') OR exit('No direct script access allowed');
/*include("graficador/pChart/pData.class");   
/*include("graficador/pChart/pChart.class");  */
?>

<!--
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Bienvenido a Lina</title>
	<script src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
	<script src="http://www.chartjs.org/samples/latest/utils.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'></script> 
	
</head>
<body>
-->
<div id="container">
	<h1>Bienvenido a lina <br/> Calculadora de funcion de tranferencia en lazo Abierto</h1>
	<div id="body">
		<p></p>
        
		<form action="<?php echo base_url();?>Carlos/calcular" method="post" name="transfer" target="_parent">
		    <center>
		    <h1>Funcion de transferencia</h1>
		    <h4>Siendo el polinomio del numerador y denominador de la forma:<br>
		    \(P(s) =as^n+bs^{n-1}+...+cs^2+ds+e\), por favor digite solo los coeficientes como:  P(s)=a,b,...,c,d,c en los campos requeridos.
		    </h4></center>
		<table width="55%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="54%" height="36" align="left" valign="middle">Digite Polinomio Numerador</td>
		    <td width="46%" align="center" valign="middle"><label for="ceros"></label>
		      <input type="text" name="ceros" id="ceros" value="<?php echo $pCeros;?>"  /></td>
		    </tr>
		  <tr>
		    <td height="36" align="left" valign="middle">Digite Polinomio Denominador</td>
		    <td align="center" valign="middle"><label for="polos"></label>
		      <input type="text" name="polos" id="polos" value="<?php echo $pPolos;?>"/></td>
		    </tr>
		  <tr>
		    <td height="51" colspan="2" align="center" valign="middle" bgcolor="#D6D6D6"><input type="submit" name="button" id="button" value="Graficar Comportamiento" /></td>
		    </tr>
		</table>
		</form>


		<p></p>
	<div class="formulas">
    <?php
    	echo $Error; 
    	
    	 echo "<div class=\"divcams\">". $raices[0]."</div>"; 
    	 echo "<div class=divcams>". $raices[1]."</div>"; 
    	 echo $tf;
    	 echo $Fparciales;
    	 echo $inversaplace;
    ?>
		</div>

		<p></p>
<?php if($Error==NULL){ ?>
		<p></p>
	<div class="formulas">
		<h2>Grafica de la dinamica del sistema</h2><hr>
		
<div style= " width:620px;">		
<canvas id="myChart"></canvas>
<canvas id="myBode"></canvas>
<canvas id="myFace"></canvas>
</div>


<script>
var color = Chart.helpers.color;
new Chart(document.getElementById("myChart"), {
  type: 'bar',
  data: {
    labels: <?php echo $tiempos;?>,
    datasets: [{ 
        type: 'line',
        data: <?php echo $puntos_grafica;?>,
        label: "sistema",
        borderColor: "#3e95cd",
        fill: false
      },{ 
        type: 'bar',
        data: <?php echo $puntos_grafica;?>,
        label: "sistema en terminos de muestreo",
        borderColor: window.chartColors.red,
        backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
        fill: false
      }
    ]
  },

  options: {
    scales: {
		/*xAxes: [{
		type: 'linear',
		scaleLabel: {
			labelString: 'Tiempo',
			display: true,
		}
		}],*/
		yAxes: [{
		type: 'linear',
		scaleLabel: {
		    labelString: 'Amplitud',
		    display: true
		}
		}]
	},
		
    title: {
      display: true,
      text: 'Comportamiento del sistema dinamico'
    }
  }
});



var color = Chart.helpers.color;
new Chart(document.getElementById("myFace"), {
  type: 'line',
  data: {
    datasets: [{ 
        type: 'line',
        data: <?php echo $fase;?>,
        label: "sistema",
        borderColor: "#E9588A",
        fill: false
      }
    ]
  },

  options: {
    title: {
      display: true,
      text: 'Diagrama Bode Fase Vs Frecuencia'
    },
    scales: {
		xAxes: [{
		type: 'logarithmic',
		ticks: {
				userCallback: function(tick) {
				var remain = tick / (Math.pow(10, Math.floor(Chart.helpers.log10(tick))));
				if (remain === 1 || remain === 2 || remain === 5) {
					return tick.toString() + 'Hz';
				}
				return '';
				},
		},
		scaleLabel: {
			labelString: 'Frequencia',
			display: true,
		}
		}],
		yAxes: [{
			type: 'linear',
			ticks: {
				userCallback: function(tick) {
				return tick.toString() + ' θ';
			}
		},
		scaleLabel: {
		    labelString: 'Magnitud',
		    display: true
		}
		}]
	}
  }
});

var color = Chart.helpers.color;
new Chart(document.getElementById("myBode"), {
  type: 'line',
  data: {
    datasets: [{ 
        type: 'line',
        data: <?php echo $bode;?>,
        label: "sistema",
        borderColor: "#F03E18",
        fill: false
      }
    ]
  },

  options: {
    title: {
      display: true,
      text: 'Diagrama Bode Magnitud Vs Frecuencia'
    },
    scales: {
		xAxes: [{
		type: 'logarithmic',
		ticks: {
				userCallback: function(tick) {
				var remain = tick / (Math.pow(10, Math.floor(Chart.helpers.log10(tick))));
				if (remain === 1 || remain === 2 || remain === 5) {
					return tick.toString() + ' Hz';
				}
				return '';
				},
		},
		scaleLabel: {
			labelString: 'Frequencia',
			display: true,
		}
		}],
		yAxes: [{
			type: 'linear',
			ticks: {
				userCallback: function(tick) {
				return tick.toString() + ' dB';
			}
		},
		scaleLabel: {
		    labelString: 'Magnitud',
		    display: true
		}
		}]
	}
  }

  
});


</script>


    <?php
	}
    ?>
	</div>
	<p></p>
	</div>
</div>

<!--
</body>
</html>-->