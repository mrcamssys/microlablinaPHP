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
        <!-- Sidebar Column -->
          <?php echo $menux;  ?>
        
        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
          
        	<h3>Digite los Sistemas a Operar</h3>
        <h3>Nota:</h3>
          <p>Siendo el polinomio del numerador y denominador de la forma:<br>
        \(P(s) =as^n+bs^{n-1}+...+cs^2+ds+e\), por favor digíte solo los coeficientes como: <br> P(s)=a,b,...,c,d,c en los campos requeridos.
        </p>

<div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Ingrese datos</h3>
            <form action="<?php echo base_url();?>TranferFuncion/close_loop_sys" method="post" name="transfer" id="transfer" target="_parent" novalidate>
            <input type="hidden" name="cantidad" value="<?php echo $cant;?>">
            
        <?php for($i=1;$i<=$cant;$i++){   ?>
          <h5>Digite del sistema \( H_{<?php echo $i ?>}(s) \)</h5>
           <div class="control-group form-group">
              <div class="controls">
                <label>Numerador:</label>
                <input type="tel" class="form-control" name="ceros<?php echo $i; ?>" id="ceros<?php echo $i; ?>" value="<?php echo $pCeros;?>"  required data-validation-required-message=" ingrese los valores del Numerador">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Denominador:</label>
                <input type="tel" class="form-control" name="polos<?php echo $i; ?>" id="polos<?php echo $i; ?>" value="<?php echo $pPolos;?>" required data-validation-required-message="Ingreselos valores del denominador">
              </div>
            </div>
            <hr>
        <?php }//fin del for  ?>  
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" id="">Calcular Datos</button>
          </form>
        </div>
      </div>

      </div><!--columna interna del from -->  
      </div>
      <!-- /.row -->
    </div>
