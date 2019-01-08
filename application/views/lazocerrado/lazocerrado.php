<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



    <!-- Page Content -->
    <div class="container">
      <p></p>
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Funcion de Transferencia
        <small>Calculadora</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>TranferFuncion">Funcion de Transferencia</a>
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

          <p>A continuacion usted vera la imagen de un sistema en lazo cerrado, con realimentacion negativa, cada uno de los elementos o sub-sistemas que encuentran  en este lazo <i>(P(S), H(S), C(S), G(S))</i>, poseen una propiedad especifica; Para interactuar con valores en terminos de la place, por favor mire el menu. </p> 
          <center>
          <img src="<?php echo base_url();?>images/cabecera1/explicar/lazocerrado.png" class="img-fluid" alt="Responsive image">
          </center>




          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#Comienzo">Introducción</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#ps">Ingresar P(S)</a>
            </li>
              <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#gs">Controlador G(S)</a>
            </li>
              <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#cs">Sensor C(S)</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#hs">Planta H(S)</a>
            </li>


          <!--
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>-->
          </ul>

          <div class="tab-content">
            <div id="Comienzo" class="tab-pane fade in active">


                    <div class="alert alert-info"> <strong>OJO!</strong> Trate de usar sistemas que no tengan raíces repetidas, este pendiente de las características del sistema despues de ser computado.</div>

                    <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                          <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsea" aria-expanded="false" aria-controls="collapseThree">Sistemas en Serie</a>
                          </h5>
                        </div>
                        <div id="collapsea" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="card-body">
                               <p>Un sistema sistema en serie, es la multiplicacion de varias funciones de tranferencia, como se muestra en el siguiente diagrama de bloques.</p>
                              
                                <center>
                               <img src="<?php echo base_url();?>images/cabecera1/explicar/serie2.png" class="img-fluid" alt="Responsive image"></center>
                               
                               <p>la ecuacion de este modelo es:</p>
                               
                               $$\frac{Y(s)}{U(s)}=A(s)*B(s)*...*n(s) $$ 

                               <p>\(n(s) \) es la union de mas  sistemas en forma de cascada, quiere decir multiplicados entre si, \( Y(s), U(s)\) es la entrada y salida de la planta. <br>Al efectuar esta operacion se optiene una nueva funcion de transferencia</p>


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
                              
                              <p>Un sistema en paralelo, es la suma de varias funciones de tranferencia, como se muestra en el siguiente diagrama de bloques.</p>

                              <center>
                              <img src="<?php echo base_url();?>images/cabecera1/explicar/paralelo2.png" class="img-fluid" alt="Responsive image"></center>

                              <p>estos bloques, pueden ser resumidos con la siguiente expresion algebraica.</p>
                               $$\frac{Y(s)}{U(s)}=A(s) + B(s) +...+ n(s) $$ 

                              <p>donde \(n(s) \) es la continuacion de mas sistemas uno paralelo al otro, tenga en cuenta que \( Y(s), U(s)\) es la entrada y salida de la planta.<br>Al efectuar esta operacion se optiene una nueva funcion de transferencia</p>

                          </div>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                          <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseb1" aria-expanded="false" aria-controls="collapseThree">Sistemas en Cascada con Realimentacion Negativa</a>
                          </h5>
                        </div>
                        <div id="collapseb1" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="card-body">

                             <p>Un lazo cerrado, es tener uno o mas sistemas conectados de tal manera que al comparar la entrada y la salida del mismo, produzcan el efecto de realimentacion.<br>Estos modelos, son usados en <i>Teoria de control</i>, para desarrollar diferentes modelos de controladores.

                             <p>En el siguiente diagrama de bloques, se aprecian dos sistemas en cascada, que son alimentados por \(e(s)\), su salida es \(y(s)\); observe que e(s) es la diferencia de la entrada \(U(s)\) entre la salida \(Y(s)\) a esta diferencia se le denomina error, y el ideal es que este siempre este en cero en caso de un sistema controlado.</p> 

                            <center><img src="<?php echo base_url();?>images/cabecera1/explicar/lazoclose.png" class="img-fluid" alt="Responsive image"></center>
                           
                            <p>A continuacion se plantean las ecuaciones del sistema realimentado.</p>
                            <p>La siguiente ecuacion, es la evaluacion de un sistema en cascada</p>
                            $$Y(s)=H(s)*G(s)*..*n(s)*e(s)$$
                            <p>la ecuacion de comparacion entre la entrada y la salida es:</p>
                            $$e(s)=U(s)-Y(s)$$

                            <p>Al remplazar e(s) de la primera ecuacion, con la secunda, se logra tener una nueva funcion de transferencia</p>

                            $$ H_n(s)=\frac{Y(s)}{U(s)}=\frac{1}{\frac{1}{H(s)*G(s)*..*n(s)}+1} $$ 

                            <p>El siguiente ejemplo le permitira colocar \(n\) sistemas en cascada, el programa realizara la operacion de los sistemas que usted digite quiere decir, multiplicandolos entre si, y luego construye una realimentacion negativa efectuando las operaciones que se mostraron enteriormente.</p>
                            
                                  
                            <hr>  
                            <h4>Calcular un ejemplo:</h4> 
                            <form action="<?php echo base_url();?>TranferFuncion/close_loop" method="post" name="transfer" id="transfer" target="_parent" novalidate>
                            <div class="control-group form-group">
                              <div class="controls">
                              <label>Numero de Sistemas conectados en serie  o cascada :</label>
                              <input type="tel" class="form-control" name="cant" id="cant" value="<?php echo $cant;?>" required data-validation-required-message="Digite la cantidad de sistemas">
                              </div>
                            </div>
                         
                              <!-- For success/fail messages -->
                            <button type="submit" class="btn btn-primary" name="eval" value="ok" id="">Calcular Datos</button>
                            </form>
                            <hr>
                              

                          </div>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                          <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapseThree">Sistema Con Realimentacion Negativa Completo</a>
                          </h5>
                        </div>
                        <div id="collapse4" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="card-body">
                              Existen dos Funciones de transferencia\(G(s), C(s)\) interconectadas en serie, a este tipo de conexión se le denomina cascada.<br> 
                              En la imagen Siguiente, se un sistema en lazo abierto, esto quiere decir que son  varios elementos interconectados entre sí.

                              <center>
                               <img src="<?php echo base_url();?>images/cabecera1/explicar/lazoopen.png" class="img-fluid" alt="Responsive image"></center>

                              Al operar cada uno de los componentes que están en ese sistema, se puede obtener la siguiente forma de ecuaciones:
                              $$\frac{Y(s)}{U(s)}=H_0(s)*H_1(s)*...*H_n(s) $$
                              Donde \(Y(s)\) es la salida,  \(U(s)\) es la entrada del sistema y \(H_0(s) ∗H_1(s) ∗...∗H_n(s)\) son la multiplicación de cada uno de estos sistemas, contrayendo uno solo.<br>
                              Al cerrar el lazo con realimentación negativa, como se muestra en la siguiente imagen: 


                              <center>
                               <img src="<?php echo base_url();?>images/cabecera1/explicar/lazosen.png" class="img-fluid" alt="Responsive image"></center>



                              Se puede apreciar que la función de transferencia cambia por: 
                              <br>Primera Ecuación:
                              $$ e=U-Y $$
                              <br>Segunda Ecuación:
                              $$ Y=e[C(s)G(s)] $$
                              <br>
                             las ecuaciones anteriores representan la relación con el error \([e]\), la salida \([Y]\) y la entrada \([U]\), por lo general la entrada, en algunos casos la denominan referencia y esta señal que permite establecer la planta en un punto específico, dependiendo las características del control. 
                             
                              <br>Despejando \(e\) de la Segunda Ecuacion:
                              $$ e=\frac{Y}{[C(s)G(s)]} $$
                              y sustituyendo \(e\) de la Primera Ecuacion
                              $$ Y \left ( \frac{1}{C(s)G(s)}+1 \right )=U $$
                             La función de transferencia resultante, es la relación de, una salida respecto a su entrada es:
                              $$ \frac{Y}{U}=\frac{1}{\frac{1}{C(s)G(s)}+1} $$
                              En cuanto más sistemas \(H_n(s) \) se usen, la función de transferencia va quedando de la siguiente forma:
                               $$ \frac{Y}{U}=\frac{1}{\frac{1}{H_0(s)H_1(s)*...*H_n(s)}+1} $$
                              Haciendo un sistema más complejo de trabajar.

                              <code> 
                              
                              <!DOCTYPE html>
                              <html>
                              <head>
                                <title></title>
                              </head>
                              <body>
                              
                              </body>
                              </html>
                              </code>
                          </div>
                        </div>
                      </div>
                    </div>
            </div>


            <div id="ps" class="tab-pane fade">
              <h3>Funciones de P(S)</h3>
              <p>Programando</p>
            </div>

            <div id="gs" class="tab-pane fade">
              <h3>Creacion de controladores G(s)</h3>
              <p>Porgramando</p>
            </div>

            <div id="cs" class="tab-pane fade">
                <h3>Ingreso de funciones de C(s)</h3>
                <p>Porgramando.</p>
            </div>

            <div id="hs" class="tab-pane fade">
                <h3>Ingreso de la(s) funcion(s) de tranferencia de la planta</h3>
                
              <h2>Requiere ser programado</h2>
              <hr>  
                <h4>Calcular un ejemplo:</h4> 
                <form action="<?php echo base_url();?>TranferFuncion/close_loop" method="post" name="transfer" id="transfer" target="_parent" novalidate>
                  <div class="control-group form-group">
                    <div class="controls">
                      <label>Numero de Sistemas conectados en serie  o cascada :</label>
                      <input type="tel" class="form-control" name="cant" id="cant" value="<?php echo $cant;?>" required data-validation-required-message="Digite la cantidad de sistemas">
                    </div>
                  </div>
                             
                  <!-- For success/fail messages -->
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