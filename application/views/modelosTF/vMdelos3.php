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

<input id="ceros1" name="ceros1" type="hidden" value="">
<input id="polos1" name="polos1" type="hidden" value=""><!--type="hidden"-->

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
<input type="range" class="custom-range"  id="Cp" name="Cp" value="<?=(empty($_POST['Cp'])) ? '1' : $_POST['Cp']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="-50" max="50" />

<label class="font-weight-bold text-primary ">Integral  [<span  id="Ci_data">0.001</span>] </label><br>
<input type="range" class="custom-range"  id="Ci" name="Ci" value="<?=(empty($_POST['Ci'])) ? '0' : $_POST['Ci']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="-50" max="50" />

 <label class="font-weight-bold text-primary ">Derivativo  [<span  id="Cd_data">0.001</span>] </label><br>
 <input type="range" class="custom-range"  id="Cd" name="Cd"  value="<?=(empty($_POST['Cd'])) ? '0' : $_POST['Cd']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="-50" max="50" />


 <!--<label class="font-weight-bold text-primary ">Filtro  [<span  id="filtro_data">0.001</span>] </label><br>-->
 <input type="hidden" class="custom-range"  id="filtro" name="filtro"  value="<?=(empty($_POST['filtro'])) ? '0' : $_POST['filtro']; ?>" onchange="barra(this);"  onmousedown="barra(this);"  step="0.01" min="0" max="1" />

<input id="ceros2" name="ceros2" type="hidden" value="">
<input id="polos2" name="polos2" type="hidden" value=""><!--type="hidden"-->

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

<input id="ceros" name="ceros" type="hidden" value="<?= $misceros; ?>">
<input id="polos" name="polos" type="hidden" value="<?= $mispolos; ?>"><!--type="hidden"-->
</form>

        </div>

         <!-- sector de vista general de los estados de la simulacion -->
        <div class="col-xs-12 col-sm-12 col-lg-9">
          
<?php if($modelar==1){?>
<?php if($Error==Null){?>
<div class="alert alert-success" role="alert">
  Estimado Usuario la funcion de transferencia calculada para el sistemas es:
   <div class="panel-body"><?= $tf;?> </div>
</div>

<?=$menux;?>
<!--buscando resultados...-->
<?=$datos?>
 

    
<?php }else{?>
  <?=$Error?>
<?php }?>
<?php }else{?>
  <div class="panel panel-default">
      <div class="panel-heading">Detalles del sistema de manera teórica</div>
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

    Cnum=Ca.toFixed(3)+", "+Cb.toFixed(3)+", "+Cc.toFixed(3);
    Cden=1+", "+Nn.toFixed(3)+", "+0;
    ceros2.value=Cnum;
    polos2.value=Cden;

    <?= $comandjs ?>

    
  }
  document.onload = pres();
 
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