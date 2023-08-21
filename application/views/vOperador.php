<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container"><br><br>
 <div class="row">
        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
          
          <h3>Nota:</h3>
          <p>Siendo el polinomio del numerador y denominador de la forma:<br>
        \(P(s) =as^n+bs^{n-1}+...+cs^2+ds+e\), por favor ingrese los valores de solo los coeficientes como: <br> P(s)=a,b,...,c,d,c en los campos requeridos.
        </p>
          
        <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Ingrese datos</h3>
            <form action="<?php echo base_url();?>Operador/mostrar" method="post" name="transfer" id="transfer" target="_parent" novalidate>
            <div class="control-group form-group">
              <div class="controls">
                <label>Numerador:</label>
                <input type="tel" class="form-control" name="ceros" id="ceros" value="<?php //echo $pCeros;?>"  required data-validation-required-message=" ingrese los valores del Numerador">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Denominador:</label>
                <input type="tel" class="form-control" name="polos" id="polos" value="<?php //echo $pPolos;?>" required data-validation-required-message="Ingreselos valores del denominador">
              </div>
            </div>
 
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" id="">Calcular Datos</button>
          </form>
        </div>
      </div>
</div></div>



  <?php echo $mensaje; ?>
</div>

 </div>
</body>
</html>