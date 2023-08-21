<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



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
        <li class="breadcrumb-item active">T.F Con Generador</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        <!-- Sidebar Column
      <div class="col-lg-3 mb-4">root
          <div class="list-group">
            <a href="<?php echo base_url();?>TranferFuncion/calcular" class="list-group-item">Funcion de Transferencia (T.F)</a>
            <a href="<?php echo base_url();?>TranferFuncion/close_loop" class="list-group-item">T.F. Lazo Cerrado</a>
            <a href="<?php echo base_url();?>TranferFuncion/Generador" class="list-group-item active">T.F con Generador</a>
            <a href="<?php echo base_url();?>TranferFuncion/help" class="list-group-item">Ayuda</a>
          </div>
        </div> -->

        <?php echo $menux;  ?>
        
        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
  
  <form action="<?php echo base_url();?>TranferFuncion/Generador" method="post" name="transfer" id="transfer" target="_parent" novalidate>
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
             <button type="submit" class="btn btn-primary" id="">Calcular LGR</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/bode')" id="">Diagrama de Bode</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/calcular')" id="">Calcular Datos</button>
             <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Fuente')" id="">Usar Fuentes</button>
             <!--<button type="button" class="btn btn-warning btn-sm" onclick="location.href ='<?php echo base_url();?>help/TranferFuncion?id=1218';" id="">Ayuda</button>-->



          </form>
            
        <br />
      <div class="row">

        
        <div class="col-lg-6 col-sm-6 portfolio-item">
          <div class="card h-100">
            
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Polos y Ceros</a>
              </h4>
              <p class="card-text"> <?php  echo $mostrarPolos;   ?>
                  <br><div class="alert alert-success"><i>Nota:</i><br>Las ramas nacen en los polos \(f(s)=(K \Rightarrow 0)\) y terminan en los ceros \(f(s)=(K \Rightarrow \pm \infty)\) del sistema.</div></p>
            </div>
          </div>
        </div>
       
       <div class="col-lg-6 col-sm-6 portfolio-item">
          <div class="card h-100">
            
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Lugares Geométricos (Puntos de partida)</a>
              </h4>
              <p class="card-text"> <?php  echo $LGR1.$LGR2.$LGR3;   ?><div class="alert alert-success"><i>Nota:</i><br>El centroide, indica la intercepcíon de todos loa ángulos que afectan la distribucion uniforme de los polos hacia los ceros</div></p>
            </div>
          </div>
        </div> 
        
        <div class="col-lg-6 col-sm-6 portfolio-item">
          <div class="card h-100">
            
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Lugares Geométricos (Angulos de las Asintotas)</a>
              </h4>
              <p class="card-text"> <?php  echo $phi;   ?><div class="alert alert-success"><i>Nota:</i><br>Los ángulos de las asíntotas que involucran el centroide, indican una distribución pareja donde los polos se dirijan a los ceros más cercanos</div></p>
            </div>
          </div>
        </div> 
        
        <!--<div class="col-lg-6 col-sm-6 portfolio-item">
          <div class="card h-100">
            
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Cruce por el eje Imaginario</a>
              </h4>
              <p class="card-text">Programando...<div class="alert alert-success"><i>Nota:</i><br>No siempre existe un cruce en el eje imaginario, estos calculos se pueden realizar usando el criterio de Routh  Hurwitz</div></p>
            </div>
          </div>
        </div>
        
        
         <div class="col-lg-6 col-sm-6 portfolio-item">
          <div class="card h-100">
            
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Puntos de partida del eje real</a>
              </h4>
              <p class="card-text">Programando...<div class="alert alert-success"><i>Nota:</i><br>Usted aqui encuentra los maximos y los minimos de K con respecto a P(s)</div></p>
            </div>
          </div>
        </div>-->
        
       
      </div>
           
        <canvas width="700" height="500" id="myChart"></canvas>
            
        </div><!-- /.contenido del programa -->
      <!-- /.row -->
    </div>




    </div>


<script>
var color = Chart.helpers.color;
new Chart(document.getElementById("myChart"), {
    type: 'scatter',
    data: {
        datasets: [{
            type: 'scatter',
            label: 'Ceros del sistema',
            backgroundColor: '#ff6384',
            data: <?php echo $ceros;?>
  
        },{
            type: 'line',
            label: 'Polos en Términos de la Ganancia',
            backgroundColor: '#33CCFF',
            data: <?php echo $polos;?>,
            
            pointRadius: 1.5,
            pointHoverRadius: 1,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: 'rectRounded'
            
        },{
            type: 'scatter',
            label: 'Polos Del sistema',
            backgroundColor: 'rgba(255,150,0,0.5)',
            data: <?php echo $polosx;?>,
            
            pointBorderColor: 'orange',
            pointBackgroundColor: 'rgba(255,150,0,0.5)',
            pointRadius: 3,
            pointHoverRadius: 30,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: 'rectRounded'
        }
        ]
    },
    options: {
        scales: {
            xAxes: [{
                type: 'linear',
                position: 'bottom'
            }]
        }
    }
});

</script>
