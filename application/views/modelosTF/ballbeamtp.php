<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Funciones de Transferencia
        <small>Ball Of Beam (Viga Bola)</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>Mdelsystf">Modelos Matemáticos</a>
        </li>
        <li class="breadcrumb-item active">Ball Of Beam (Viga Bola)</li>
      </ol>
     
      <div class="row">  
      <?php echo $menux;  
/*
  (J)     MOMENTO DE INERCIA INICIAL DEL MOTOR        [kg.m^2]
  (b)     COSNTANTE DE VISCOCIDAD DE FRICCION DEL MOTOR   [N.m.s]
  (Ke)    Cosntante de fuerza electromotriz         [V/rad/sec]
  (Kt)    CONSTANTE DE TORQUE DEL MOTOR             [N.m/Amp]
  (R)     RESISTENCIA ELECTRICA                     [Ohm]
  (L)     INDUCTANCIA ELECTRICA               [H]
*/
      ?>
      <div class="col-lg-9 mb-4">
        <h3>Funcion de transferencia en lazo abierto</h3> 
        <hr />

        <p>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Definicion de Parametros
          </button>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
           <ul> 
            <li> \(g\)  = Aceleración Gravitacional  \([9.8 k_g/m^2]\)</li>
            <li>\(\beta\)  = Ángulo de engranaje servomotor \([rad]\)</li>
            <li>\(\gamma\) = Coordenada de la esfera   \([met]\)</li>
            <li>\(\alpha\) = Coordenada del angulo del haz   \([rad]\)</li>
            <li>\(d\)  = Desplazamiento del sigueñal en el motor   \([met]\)</li>
            <li>\(m\)  = Masa de la esfera   \([k_g]\)</li>
            <li>\(J\)  = Momento inercia esfera  \([k_gm^2]\)</li>
            <li>\(R\)  = Radio Esfera  \([met]\)</li>
          </ul>
          </div>
        </div>
        <div class="alert alert-info"><strong>Ojo!</strong> En esta funcion de transferencia se asume que el servomotor esta controlado, su medida es radianes.</div>
        <?php if($this->input->post("enviado")==1){ ?>
          <h4>Funcion Original en Lazo Abierto</h4>
          <h6>Función de Transferencia del Sistema:</h6>
          <?= $tf;  ?>
          <h6>Función de Transferencia Organizada</h6>
          <?= $polinomio;  ?>

          <h6>Resultado del PID Generado:</h6>
          <div class="table-responsive "><?= $pid;?></div>
          <hr>
          <h6>Calculando el lazo cerrado de</h6>
          Representación el Sistema H(s)
          <div class="table-responsive ">$$ H(s)=\frac{A}{B} $$</div>
          Representación el Sistema G(s)
          <div class="table-responsive ">$$ G(s)=\frac{D}{E} $$</div>
          Representación de la Planta en  Lazo Cerrado:
          <div class="table-responsive ">$$ P(s)=\frac{AD}{BE+DA} $$</div>
          Sistema P(s) en lazo cerrado:
          <div class="table-responsive "><?= $ps; ?> </div>
          <hr>

          <div class="alert alert-danger">
            <strong>Cuidado!</strong> Si el sistema es inestable, la plataforma le informara,así como los puntos que este considere así, por tanto por protección restringa el uso de algunas funciones.
          </div>
          <form action="<?php echo base_url();?>TranferFuncion/calcular" method="post" name="transfer" id="transfer" target="_parent" novalidate>
            <input type="hidden" name="ceros" id="ceros" value="<?= $ball_num;?>" >
            <input type="hidden" name="polos" id="polos" value="<?= $ball_den;?>" >
            <button type="submit" class="btn btn-primary" id="">Continuar</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Generador')" id="">Ver LGR</button>
            <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/bode')" id="">Ver bode</button>
             <button type="button" class="btn btn-info btn-sm" onclick="sendform('transfer','<?php echo base_url();?>TranferFuncion/Fuente')" id="">Usar Fuentes</button>
             

           </form> 
           <hr>
         <?php } ?>



        <h4>Ingrese los parámetros del sistema</h4>
            <form action="<?php echo base_url();?>tfballbeam/pidballbeam" method="post" name="transfer" id="transfer" target="_parent" novalidate>
            

            <div class="control-group form-group">
              <div class="controls">
                <label>\(\beta\) Radianes:</label>
                <input type="tel" class="form-control" name="ball_beta" id="ball_beta" value="<?= $ball_beta;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>

           <div class="control-group form-group">
              <div class="controls">
                <label>\(\gamma\) metros:</label>
                <input type="tel" class="form-control" name="ball_gamma" id="ball_gamma" value="<?= $ball_gamma;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>

             <div class="control-group form-group">
              <div class="controls">
                <label>\(\alpha\) radianes:</label>
                <input type="tel" class="form-control" name="ball_alpha" id="ball_alpha" value="<?= $ball_alpha;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>

             <div class="control-group form-group">
              <div class="controls">
                <label>\(d\) metros:</label>
                <input type="tel" class="form-control" name="ball_d" id="ball_d" value="<?= $ball_d;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>

             <div class="control-group form-group">
              <div class="controls">
                <label>\(m\) \(k_g\):</label>
                <input type="tel" class="form-control" name="ball_m" id="ball_m" value="<?= $ball_m;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>

             <div class="control-group form-group">
              <div class="controls">
                <label>\(J\) \( k_gm^2 \):</label>
                <input type="tel" class="form-control" name="ball_j" id="ball_j" value="<?= $ball_j;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>

             <div class="control-group form-group">
              <div class="controls">
                <label>\(R\) metros:</label>
                <input type="tel" class="form-control" name="ball_r" id="ball_r" value="<?= $ball_r;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>







            <div class="control-group form-group">
              <div class="controls">
                <label>Constante Proporcional \(k_p\)</label>
                <input type="tel" class="form-control" name="kp" id="kp" value="<?= $kp;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>

            <div class="control-group form-group">
              <div class="controls">
                <label>Constante Integral \(K_i\)</label>
                <input type="tel" class="form-control" name="ki" id="ki" value="<?= $ki;?>"  required data-validation-required-message=" ">
                <p class="help-block"></p>
              </div>
            </div>



            <div class="control-group form-group">
              <div class="controls">
                <label>Constante Derivativa \(K_d\)</label>
                <input type="tel" class="form-control" name="kd" id="kd" value="<?= $kd;?>"  required data-validation-required-message=" i
                <p class="help-block"></p>
              </div>
            </div>


          <div class="control-group form-group">
              <div class="controls">
                <label>Seleccione valor filtro \( \alpha \)</label>
                  <select name="alpha" class="browser-default custom-select">
                    <option selected="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.01">0.01</option>
                    <option value="0.001">0.001</option>
                    <option value="0.2">0.2</option>
                    <option value="0.4">0.4</option>
                    <option value="0.6">0.6</option>
                    <option value="0.8">0.8</option>
                    <option value="1">1</option>
                  </select>
              </div>
            </div>

            <button type="submit" class="btn btn-warning" value="1" name="enviado" id="">Empezar a trabajar</button>

 
            <div id="success"></div>
            <!-- For success/fail messages
            <button type="submit" class="btn btn-primary" id="">Calcular Bode</button>
            -->
          </form>

        
        

      </div>
      </div>
    </div>

    <!-- /.container -->