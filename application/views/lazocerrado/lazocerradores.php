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
        <li class="breadcrumb-item active">Lazo Cerrado</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        <!-- Sidebar Column -<div class="col-lg-3 mb-4">
          <div class="list-group">
            <a href="calcular" class="list-group-item">Funcion de Transferencia (T.F)</a>
            <a href="close_loop" class="list-group-item active">T.F. Lazo Cerrado</a>
            <a href="generator" class="list-group-item">T.F con Generador</a>
            <a href="help" class="list-group-item">Ayuda</a>
          </div>
        </div>-->
        <?php echo $menux;  ?>
        
        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
          
        	<h3>Evaluación de los Sistemas Digitados</h3>
   
      


          <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
            
          <?php 
          echo $operanum."<br>";
           echo $loop."<br>";

          //echo var_dump($operaden)."<br>";
          for($i=1;$i<=$cant;$i++){?>

            <div class="card">
              <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapseThree">Ceros y Polos del sistema \(H_{<?php echo $i;?>}(s) \)</a>
                </h5>
              </div>
              <div id="collapse<?php echo $i;?>" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="card-body">
                  <?php
                     echo $TF[$i]."<br>"; 
                     echo "<div class=\"divcams\">". $raices[0][$i]."</div>"; 
                     echo "<div class=divcams>". $raices[1][$i]."</div>"; 
                  ?>
                </div>
              </div>
            </div>
          
          <?php }//fin del for ?>



          <form action="<?php echo base_url();?>TranferFuncion/calcular" method="post" name="transfer" id="transfer" target="_parent" novalidate>
            <input type="hidden" name="ceros" value="<?php echo $snum;?>">
            <input type="hidden" name="polos" value="<?php echo $sden;?>">
 
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" id="">Continuar y Operar >></button>
          </form>
          


      </div><!--columna interna del from -->  
      </div>
      <!-- /.row -->





    </div>
