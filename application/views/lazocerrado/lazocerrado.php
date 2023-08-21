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
        <!-- Sidebar Column 
      <div class="col-lg-3 mb-4">
          <div class="list-group">
            <a href="<?php echo base_url();?>TranferFuncion/calcular" class="list-group-item">Funcion de Transferencia (T.F)</a>
            <a href="<?php echo base_url();?>TranferFuncion/close_loop" class="list-group-item active">T.F. Lazo Cerrado</a>
            <a href="<?php echo base_url();?>TranferFuncion/Generador" class="list-group-item">T.F con Generador</a>
            <a href="<?php echo base_url();?>TranferFuncion/help" class="list-group-item">Ayuda</a>
          </div>
        </div>-->
        <?php echo $menux;  ?>
        
        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
          
          <h3>Bienvenido</h3>

          <p>Un sistema del lazo cerrado con re-alimentación negativa, permite mediante otro sistema llamado controlador, hacer que una planta funcione de una manera específica, la re-alimentación permite comparar, la salida que produce G(s) y H(S) con un a entrada, a esta comparación se le llama error, y permite a G(s) tomar acciones que permitan minimizar el error.</p>
          <P>El sistema en lazo abierto, aunque puede ser estable calcular y comparar la diferencia entre la entrada y la salida es casi imposible, este tipo de sistemas se usan para elementos que no requieren control y no están sujetos a ser inestables por naturaleza.</p>

          Ejemplo de lazo abierto de dos sistemas en cascada: 
          <center>
          <img src="<?php echo base_url();?>images/cabecera1/explicar/lazoopen.png" class="img-fluid" alt="Responsive image">
          </center>

          A continuación: seleccione <b>Información</b> para saber algo más sobre sistemas u <b>Operar lazo cerrado</b>, para hacer cálculos de un sistema con re-alimentación negativa estos conectados en cascada.

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Comienzo">Introducción</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#ps">Operar Lazo Cerrado</a>
            </li>
           </ul>

          <div class="tab-content">
            <div id="Comienzo" class="tab-pane fade in active">


                    <div class="alert alert-info"> <strong>OJO!</strong> Trate de usar sistemas que no tengan raíces repetidas, este pendiente de las características del sistema después de ser computado.</div>

                    <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                          <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsea" aria-expanded="false" aria-controls="collapseThree">Sistemas en Serie</a>
                          </h5>
                        </div>
                        <div id="collapsea" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="card-body">
                               <p>Un sistema sistema en serie, es la multiplicación de varias funciones de transferencia, como se muestra en el siguiente diagrama de bloques.</p>
                              
                                <center>
                               <img src="<?php echo base_url();?>images/cabecera1/explicar/serie2.png" class="img-fluid" alt="Responsive image"></center>
                               
                               <p>la ecuacion de este modelo es:</p>
                               
                               $$\frac{Y(s)}{U(s)}=A(s)*B(s)*...*n(s) $$ 

                               <p>\(n(s) \) es la unión de mas  sistemas en forma de cascada, quiere decir multiplicados entre si, \( Y(s), U(s)\) es la entrada y salida de la planta. <br>Al efectuar esta operación se obtiene una nueva función de transferencia</p>


                          </div>
                        </div>
                      </div>


                      <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                          <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseb" aria-expanded="false" aria-controls="collapseThree">Sistemas en Paralelo</a>
                          </h5>
                        </div>
                        <div id="collapseb" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="card-body">
                              
                              <p>Un sistema en paralelo, es la suma de varias funciones de transferencia, como se muestra en el siguiente diagrama de bloques.</p>

                              <center>
                              <img src="<?php echo base_url();?>images/cabecera1/explicar/paralelo2.png" class="img-fluid" alt="Responsive image"></center>

                              <p>estos bloques, pueden ser resumidos con la siguiente expresión algebraica.</p>
                               $$\frac{Y(s)}{U(s)}=A(s) + B(s) +...+ n(s) $$ 

                              <p>donde \(n(s) \) es la continuación de mas sistemas uno paralelo al otro, tenga en cuenta que \( Y(s), U(s)\) es la entrada y salida de la planta.<br>Al efectuar esta operación se obtiene una nueva función de transferencia</p>

                          </div>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                          <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseb1" aria-expanded="false" aria-controls="collapseThree">Sistemas en Cascada con Re-alimentación Negativa</a>
                          </h5>
                        </div>
                        <div id="collapseb1" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="card-body">

                             <p>Un lazo cerrado, es tener uno o mas sistemas conectados de tal manera que al comparar la entrada y la salida del mismo, produzcan el efecto de re-alimentación.<br>Estos modelos, son usados en <i>Teoria de control</i>, para desarrollar diferentes modelos de controladores.

                             <p>En el siguiente diagrama de bloques, se aprecian dos sistemas en cascada, que son alimentados por \(e(s)\), su salida es \(y(s)\); observe que e(s) es la diferencia de la entrada \(U(s)\) entre la salida \(Y(s)\) a esta diferencia se le denomina error, y el ideal es que este siempre este en cero en caso de un sistema controlado.</p> 

                            <center><img src="<?php echo base_url();?>images/cabecera1/explicar/lazoclose.png" class="img-fluid" alt="Responsive image"></center>
                           
                            <p>A continuación se plantean las ecuaciones del sistema re-alimentado.</p>
                            <p>La siguiente ecuación, es la evaluación de un sistema en cascada</p>
                            $$Y(s)=H(s)*G(s)*..*n(s)*e(s)$$
                            <p>la ecuación de comparación entre la entrada y la salida es:</p>
                            $$e(s)=U(s)-Y(s)$$

                            <p>Al remplazar e(s) de la primera ecuación, con la secunda, se logra tener una nueva función de transferencia</p>

                            $$ H_n(s)=\frac{Y(s)}{U(s)}=\frac{1}{\frac{1}{H(s)*G(s)*..*n(s)}+1} $$ 

                            <p>El siguiente ejemplo le permitirá colocar \(n\) sistemas en cascada, el programa realizara la operación de los sistemas que usted digíte quiere decir, multiplicándolos entre si, y luego construye una re-alimentación negativa efectuando las operaciones que se mostraron anteriormente.</p>
                                                        

                          </div>
                        </div>
                      </div>

                      


                    </div>
            </div>


            <div id="ps" class="tab-pane fade">
                  <hr>  
                  <h4>Calcular un ejemplo:</h4> 
                  <form action="<?php echo base_url();?>TranferFuncion/close_loop" method="post" name="transfer" id="transfer" target="_parent" novalidate>
                      <div class="control-group form-group">
                        <div class="controls">
                          <label>Numero de Sistemas conectados en serie  o cascada :</label>
                          <input type="tel" class="form-control" name="cant" id="cant" value="<?php echo $cant;?>" required data-validation-required-message="Digite la cantidad de sistemas">
                        </div>
                      </div>
                             
                      <button type="submit" class="btn btn-primary" name="eval" value="ok" id="">Calcular Datos</button>
                    </form>
                  <hr>
            </div>
                
              

            </div>
        </div>




        <!--
      -->


          


      </div><!--columna interna del from -->  
      </div>
      <!-- /.row -->





    </div>