<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ruta=$this->input->get('sys');
?>


<script type="text/javascript">
  function barra(data){
    if(data.value!=0){
       document.getElementById(data.name+'_data').innerHTML=data.value;
       document.getElementById(data.name).innerHTML=data.value;
     }else{
        document.getElementById(data.name+'_data').innerHTML= 0.001;
        document.getElementById(data.name).innerHTML=0.001;
     } 

    pres();

  }
</script>




    <div class="container-fluid">
    
      
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3"><small>Simulador de Modelos en TF</small>
        <small><small><?= $titulo ?></small></small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>modelossys">Modelos de Sistemas</a>
        </li>
        <li class="breadcrumb-item active">Simuladores</li>
      </ol>
      <!-- Etapa de programacion de vistas -->


      <div class="container-fluid"><div class="row">
         <!-- slaider de los elementos de control del simulador -->
        <div class="col-sm-12 col-lg-3">
       
<form  method="post" name="transfer" id="transfer" target="_parent" novalidate>          
          <!-- Comienzo del acordeon -->
          <div class="accordion1">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link  btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Panel de Parámetros</a>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  
<?=$variables;?>

<input id="ceros1" name="ceros1" type="text" value="">
<input id="polos1" name="polos1" type="text" value=""><!--type="text"-->

                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <a class="btn btn-link collapsed  btn-sm" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Controlador PID Estándar
                  </a>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">

<label class="font-weight-bold text-primary ">Proporcional  [<span  id="Cp_data">1</span>] </label><br>
<input type="range" class="custom-range"  id="Cp" name="Cp" value="<?=(empty($_POST['Cp'])) ? '1' : $_POST['Cp']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="-50" max="150" />

<label class="font-weight-bold text-primary ">Integral  [<span  id="Ci_data">0.001</span>] </label><br>
<input type="range" class="custom-range"  id="Ci" name="Ci" value="<?=(empty($_POST['Ci'])) ? '0' : $_POST['Ci']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="-50" max="150" />

 <label class="font-weight-bold text-primary ">Derivativo  [<span  id="Cd_data">0.001</span>] </label><br>
 <input type="range" class="custom-range"  id="Cd" name="Cd"  value="<?=(empty($_POST['Cd'])) ? '0' : $_POST['Cd']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="-50" max="150" />



 <input type="hidden" class="custom-range"  id="filtro" name="filtro"  value="<?=(empty($_POST['filtro'])) ? '0' : $_POST['filtro']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="0" max="1" />


<input id="ceros2" name="ceros2" type="text" value="">
<input id="polos2" name="polos2" type="text" value=""><!--type="text"-->

<br>
<span class="button-checkbox">
<button type="button" class="btn" data-color="primary">Activar o Desactivar</button>
         <input type="checkbox" name="hidden"  style="display: none;" <?=(empty($_POST['hidden'])) ? '' : "checked" ?> />
</span>


                </div>
              </div>
            </div>

          </div>  <!-- fin del acordeon -->



          <button type="button" name="labierto" onclick="sendform('transfer','<?php echo base_url();?>modelossys/calcular?id=1&sys=<?=$ruta; ?>')" onclick="pres(this);" class="btn btn-primary btn-lg btn-block">Ver Solo Sistema</button>

<input id="ceros" name="ceros" type="text" value="<?=$misceros; ?>">
<input id="polos" name="polos" type="text" value="<?=$mispolos; ?>"><!--type="text"-->
</form>

        </div>

         <!-- sector de vista general de los estados de la simulacion -->
        <div class="col-xs-12 col-sm-12 col-lg-9">
          
<?php if($modelar==1){?>
<?php if($Error==Null){?>
<div class="alert alert-success" role="alert">
  Estimado Usuario la función de transferencia calculada para el sistemas es:
   <?php if($valsys==0){?>
   <div class="panel-body"><?= $tf;?> </div>
    <?php }else{ ?>
      <div class="panel-body"><?= $tf;?> </div>
     <?php } ?> 
</div>

<?=$menux;?>
 
<div class="row">
  <!--Commulna primaria-->
<?php if($valsys==0){?>

    
      <div class="panel-heading btn-info">Planta sin Controlador</div>
      <canvas width="700" height="500" id="myChart"></canvas>
   <?php if($control==1){ ?>  

      <div class="panel-heading btn-info">Planta Con Controlador Activo</div>
      <canvas width="700" height="500" id="myChart2"></canvas>
  <?php }else{ ?>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Al parecer no tiene una característica activada!</h4>
      <p>El sistema que esta modelando no cuenta con un controlador C(s) activado, quiere decir que el grafico que esta visualizando es en lazo abierto y corresponde a la región verde que se encuentra en la parte superior.</p>
      <hr>
      <p class="mb-0">para activarlo, busque el panel de control izquierdo o en la parte superior si usa dispositivo móvil, haga clic donde dice controlador PID estándar y active el PID debe quedar el boton de color azul.</p>
    </div>
  <?php }?>


<?php }else{ ?>
<div class="col-xs-6 col-md-6">




<div class="panel panel-default">

<div class="panel-heading btn-info"><center>Sistema Lazo abierto</center></div>
 <div class="panel-body"><?=$tf1 ?></div>



<div class="panel-heading btn-info"><center>Polos y Ceros del Sistema</center></div>

      <div class="panel-body">
          <?php
          echo "<div class=\"divcams\">".$raices[0]."</div>"; 
          echo "<div class=divcams>". $raices[1]."</div>"; 
          ?>
      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading btn-info">Representación H(s)</div>
      
       <div class="panel-body"><?= $Fparciales; ?></div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading btn-info">Tiempos de Establecimiento Según Polos</div>
      <div class="panel-body">

<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">\[s=-\phi\]</th>
      <th scope="col">\[t_s= \left|\frac{3}{\phi} \right|\]</th>
      <th scope="col">\[t_s= \left|\frac{4}{\phi} \right|\]</th>
      <th scope="col">\[t_s= \left|\frac{5}{\phi} \right|\]</th>
    </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($tabla); $i++){
      if(isset($tabla[0][$i])){
    ?>
    <tr>
      <td><?= $tabla[0][$i]; ?></td>
      <td><?= $tabla[1][$i]; ?></td>
      <td><?= $tabla[2][$i]; ?></td>
      <td><?= $tabla[3][$i]; ?></td>
    </tr>
    <?php }
    } ?>
  </tbody>
</table>


<div class="alert alert-dark" role="alert">
 Esto establece una tabla de relación entre el \([\tau]\) y el polo, dando como resultado los posibles puntos donde se puede estabilizar la señal del sistema.
</div>
</div>

      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading btn-info">Representación h(t)</div>
      <div class="panel-body"> <?=$inversaplace; ?></div>
    </div>
    
   
    <div class="panel panel-default">
      <div class="panel-heading btn-info">Simulador de Fuentes</div>
      <div class="panel-body">

        <div class="alert alert-warning" role="alert">
          Estimado usuario por cuestiones de comodidad y flexibilidad con su dispositivo, este botón le permitirá ir al simulador de funciones de transferencia. 
          <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Fuente')" id="">Usar Fuentes</button>
        </div>
        
      </div>
    </div>


  </div>
  
  <div class="col-xs-6 col-md-6"><!--Commulna secundaria-->
   
    <div class="panel panel-default">
      <div class="panel-heading btn-info">Sistema en lazo cerrado</div>
      <div class="panel-body"><?=$tf2 ?></div>
    </div>
 


<?php if($control==1){ ?>  

<div class="panel-heading btn-info"><center>Polos y Ceros del Sistema</center></div>

      <div class="panel-body">
          <?php
          echo "<div class=\"divcams\">".$raices2[0]."</div>"; 
          echo "<div class=divcams>". $raices2[1]."</div>"; 
          ?>
      </div>
    


    <div class="panel panel-default">
      <div class="panel-heading btn-info">Representación H(s)</div>
      
       <div class="panel-body"><?= $Fparciales2; ?></div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading btn-info">Tiempos de Establecimiento Según Polos</div>
      <div class="panel-body">

<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">\[s=-\phi\]</th>
      <th scope="col">\[t_s= \left|\frac{3}{\phi} \right|\]</th>
      <th scope="col">\[t_s= \left|\frac{4}{\phi} \right|\]</th>
      <th scope="col">\[t_s= \left|\frac{5}{\phi} \right|\]</th>
    </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($tabla2); $i++){
      if(isset($tabla2[0][$i])){
    ?>
    <tr>
      <td><?= $tabla2[0][$i]; ?></td>
      <td><?= $tabla2[1][$i]; ?></td>
      <td><?= $tabla2[2][$i]; ?></td>
      <td><?= $tabla2[3][$i]; ?></td>
    </tr>
    <?php }
    } ?>
  </tbody>
</table>


<div class="alert alert-dark" role="alert">
 Esto establece una tabla de relación entre el \([\tau]\) y el polo, dando como resultado los posibles puntos donde se puede estabilizar la señal del sistema.
</div>
</div>

      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading btn-info">Representación h(t)</div>
      <div class="panel-body"> <?=$inversaplace2; ?></div>
    </div>
    
   
    <div class="panel panel-default">
      <div class="panel-heading btn-info">Simulador de Fuentes</div>
      <div class="panel-body">

        <div class="alert alert-warning" role="alert">
          Estimado usuario por cuestiones de comodidad y flexibilidad con su dispositivo, este botón le permitirá ir al simulador de funciones de transferencia. 
          <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Fuente')" id="">Usar Fuentes</button>
        </div>
        
      </div>
    </div>

<?php } ?>
   



  </div>









</div>
<?php } ?>    


  
</div>
<?php }else{?>
  <?=$Error?>
<?php }?>
<?php }else{?>
  <div class="panel panel-default">
      <div class="panel-heading btn-info">Detalles del sistema de manera teórica</div>
      <div class="panel-body"><?= $contenido; ?></div>
  </div>
<?php }?>



        </div>
        
      </div></div>

    </div>


    <!-- /.container -->
<script type="text/javascript">



  function pres(){
    //polos.value="datos"+", datis";
    vCp=parseFloat(document.getElementById('Cp').value);
    vCi=parseFloat(document.getElementById('Ci').value);
    vCd=parseFloat(document.getElementById('Cd').value);
     Nn=parseFloat(document.getElementById('filtro').value);
     Ca=vCp+Nn*vCd;
     Cb=vCp*Nn+vCi;
     Cc=vCi*Nn;

    //Cnum=Ca.toFixed(3)+", "+Cb.toFixed(3)+", "+Cc.toFixed(3);
    //Cden=1+", "+Nn.toFixed(3)+", "+0;

    Cnum=vCd+", "+vCp+", "+vCi;
    Cden=1+", "+0;

    ceros2.value=Cnum;
    polos2.value=Cden;

    <?= $comandjs ?>

    
  }
  document.onload = pres();
 
</script>

<script>
var color = Chart.helpers.color;
new Chart(document.getElementById("myChart"), {
  type: 'bar',
  data: {
    labels: <?= $tiempos;?>,
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
    labels: <?= $tiempos2;?>,
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





<script type="text/javascript">
  $(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
</script>