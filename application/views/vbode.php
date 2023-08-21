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
        <small>Respuesta en Amplitud y Fase</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>TranferFuncion">Función de Transferencia</a>
        </li>
        <li class="breadcrumb-item active">Diagrama de bode</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        
       <?php echo $menux;  ?>


        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
          
          
        <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Ingrese datos</h3>
            <form action="<?php echo base_url();?>TranferFuncion/bode" method="post" name="transfer" id="transfer" target="_parent" novalidate>
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
            <button type="submit" class="btn btn-primary" id="">Calcular Bode</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Generador')" id="">Ver LGR</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/calcular')" id="">Calcular Datos</button>
             <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Fuente')" id="">Usar Fuentes</button>
             
          </form>
        </div>
      </div>
        

      <?php echo $Error; 
//echo $this->input->get('code');
      if($Error==NULL || $Error==""){
      echo $tf; ?>




    <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h5 class="mb-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Diagrama de Amplitud Vs Frecuencia</a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-body">
                  <canvas width="700" height="500" id="myBode"></canvas>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" role="tab" id="headingTwo">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Diagrama de Fase Vs Frecuencia
                  </a>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-body">
                  <canvas width="700" height="500" id="myFace"></canvas>
                </div>
              </div>
            </div>
          </div>
        <?php }//fin del if ?>






      </div><!--columna interna del from -->  
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
<script>

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
