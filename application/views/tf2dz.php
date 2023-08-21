<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
#graficos{
  min-width: 600px;
  padding:5px;
}
</style>

    <!-- Page Content -->
    <div class="container">
<p></p>
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Función de Transferencia
        <small>de \(H(s)\) a \(H(z)\) Transformación Bilineal</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>TranferFuncion">Función de Transferencia</a>
        </li>
        <li class="breadcrumb-item active">Lazo Abierto</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        
       <?php echo $menux;  ?>


        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
          
        	<h3>Nota:</h3>
          <p>Siendo el polinomio del numerador y denominador de la forma:<br>
		     <div class="table-responsive"> \(P(s) =as^n+bs^{n-1}+...+cs^2+ds+e\)</div>, por favor digite solo los coeficientes como: <br> P(s)=a,b,...,c,d,c en los campos requeridos.
		    </p>
          <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Ingrese datos</h3>
            <form action="<?php echo base_url();?>TranferFuncion/tf2dz" method="post" name="transfer" id="transfer" target="_parent" novalidate>
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
        



      <?php echo $Error; 

      if($Error!=NULL || $Error!=""){
        echo "<h4>Ecuaciones en diferencias para construcción del código fuente</h4>";
list($texto,$a,$b,$c)=$prueba;
echo "<hr>//Delaclacion de variables:<br>".$a."<hr>";
echo "<hr>//Ecuación en diferencias para micro:<br>".$texto."<br> //aquí va la sección de código para actuador";
echo "<br>".$b."<hr>";
       }?>

        
                        

          </div>
</div>      
<!-- fin del contenido en pestañas-->


</div><!--columna interna del from -->  

      </div><!-- /.row -->

    </div>
    <!-- /.container -->
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
        label: "sistema en términos de muestreo",
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
      text: 'Comportamiento del sistema dinámico'
    }
  }
});

</script>


<script>
var color = Chart.helpers.color;
new Chart(document.getElementById("myChart2"), {
  type: 'bar',
  data: {
    labels: <?php echo $tiempos2;?>,
    datasets: [{ 
        type: 'line',
        data: <?php echo $puntos_grafica2;?>,
        label: "sistema",
        borderColor: "#3e95cd",
        fill: false
      },{ 
        type: 'bar',
        data: <?php echo $puntos_grafica2;?>,
        label: "sistema en términos de muestreo",
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
      text: 'Comportamiento del sistema dinámico'
    }
  }
});

</script>

<script>
var color = Chart.helpers.color;
new Chart(document.getElementById("myChart3"), {
  type: 'bar',
  data: {
    labels: <?php echo $tiempos3;?>,
    datasets: [{ 
        type: 'line',
        data: <?php echo $puntos_grafica3;?>,
        label: "sistema",
        borderColor: "#3e95cd",
        fill: false
      },{ 
        type: 'bar',
        data: <?php echo $puntos_grafica3;?>,
        label: "sistema en términos de muestreo",
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
      text: 'Comportamiento del sistema dinámico'
    }
  }
});

</script>