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
        <small>Calculadora</small>
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
          	<form action="<?php echo base_url();?>TranferFuncion/calcular" method="post" name="transfer" id="transfer" target="_parent" novalidate>
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
 
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" id="">Calcular Datos</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Generador')" id="">Ver LGR</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/bode')" id="">Ver Diagrama de Bode</button>
             <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Fuente')" id="">Usar Fuentes</button>
              <!--<button type="button" class="btn btn-warning btn-sm" onclick="location.href ='<?php echo base_url();?>help/TranferFuncion?id=1218';" id="">Ayuda</button>-->
          </form>
        </div>
      </div>
        



      <?php echo $Error; 

      if($Error==NULL || $Error==""){
       ?>

<!-- contenido en pestañas -->

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#Ecudig">Ecuación  $$G(S)$$</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#impulso">Entrada <br>Impulso $$u=1$$</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#escalon">Entrada Escalón $$u=\frac{1}{s}$$</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#rampa">Entrada Rampa $$u=\frac{1}{s^2}$$</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#vde">VdE $$\begin{equation}\begin{bmatrix}a & d \\ b & c  \end{bmatrix} \end{equation}$$</a>  </li></ul>

<div class="tab-content">
<div id="Ecudig" class="tab-pane fade in active">

          <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
            
            <div class="card">
              <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Ecuación del sistema</a>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="card-body">
                    <?= $tf;?> 
                </div>
              </div>
            </div>


            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h5 class="mb-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Polos y Ceros del Sistema</a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-body">
                  <?php
                     echo "<div class=\"divcams\">". $raices[0]."</div>"; 
                     echo "<div class=divcams>". $raices[1]."</div>"; 
                  ?>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" role="tab" id="headingTwo">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Fracciones Parciales (en caso de existir)
                  </a>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-body">
                  <?php
                     echo $Fparciales;
                  ?>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" role="tab" id="heading4">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapseTwo">Respuesta del Sistema en el tiempo (Ante el Impulso)
                  </a>
                </h5>
              </div>
              <div id="collapse4" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-body">
                  <?php
                    
                     echo $inversaplace;
                  ?>
                </div>
              </div>
            </div>

                        

          </div>
</div>      
  <div id="impulso" class="tab-pane fade">
        



         
        
<canvas width="700" height="500" id="myChart"></canvas>

  </div>
  <div id="escalon" class="tab-pane fade">
       <canvas width="700" height="500" id="myChart2"></canvas>
  </div>
  <div id="rampa" class="tab-pane fade">
        <canvas width="700" height="500" id="myChart3"></canvas>
  </div>

  <div id="vde" class="tab-pane fade">
        <?=$formascan; ?>
  </div>
</div>
<?php }//fin del if ?>
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