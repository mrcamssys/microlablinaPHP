<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Función de Transferencia
        <small>Sistemas Dinámicos (Laplace)</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item active">Contenido</li>
      </ol>

      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="<?php echo base_url(); ?>images/cabecera1/tf1.png" alt="">
        </div>
        <div class="col-lg-6">
          <h2>Funcion de Transferencia</h2>
          <p style="text-align:justify">
            En este espacio usted podrá trabajar con funciones de transferencia en términos de <i><b>Laplace</b></i> de la forma:
            <div class="table-responsive ">
            $$ H(s)= \frac{P_{num}}{P_{den}}=\frac{a_0s^x+b_0s^{x-1}+c_0s^{x-2}+...+d_0s^2+e_0s+f_0}{a_1s^n+b_1s^{n-1}+c_1s^{n-2}+...+d_1s^2+e_1s+f_1} $$</div>

            Obteniendo las diferentes características que describen el funcionamiento del sistema dinámico que usted ingreso al formulario, tales como: las raíces, el lugar geométrico, diagrama de bode, adicionalmente ver el comportamiento del sistema ante las diferentes señales que lo puedan afectar en su entrada.<br>

            Este simulador trabaja para sistemas <i><b> SISO </b></i>, está diseñado con fines educativos para la experimentación y comprensión de temas básicos de control y sistemas dinámicos.

          </p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Team Members -->
      <h2>Calculadora y Simulador</h2>

      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <h4 class="card-header">Lazo Abierto</h4>
            <img class="card-img-top" src="<?php echo base_url(); ?>images/cabecera1/openloop.png" alt="">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">Datos Característicos</h6>
              <p class="card-text">En este módulo usted podrá saber los datos característicos de una función de transferencia en lazo abierto, los cálculos expresados se realizan sin condiciones iniciales.<br> <b><i>Nota:</i></b> recordar que las funciones de transferencia poseen condiciones iniciales en [0].</p>
            </div>
            <div class="card-footer">
              
               <a href="<?php echo base_url(); ?>TranferFuncion/calcular" class="btn btn-primary">Continuar...</a>
            </div>
          </div>
        </div>


        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <h4 class="card-header">Lazo Cerrado</h4>
            <img class="card-img-top" src="<?php echo base_url(); ?>images/cabecera1/close.png" alt="">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">Calculadora de operaciones</h6>
              <p class="card-text">usted podrá realizar operaciones con funciones de trasferencia cerrando el lazo abierto, aquí se pueden operar sistemas en cascada,.<br> <b><i>Nota:</i></b> la re-alimentación del lazo en negativa.</p>
            </div>
            <div class="card-footer">
               <a href="<?php echo base_url(); ?>TranferFuncion/close_loop" class="btn btn-primary">Continuar...</a>
            </div>
          </div>
        </div>
     
<!-- nuevos parametros -->
        

        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <h4 class="card-header">Diagrama de bode</h4>
            <img class="card-img-top" src="<?php echo base_url(); ?>images/cabecera1/seebode.png" alt="">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">Sistema en fase y frecuencia</h6>
              <p class="card-text">En este módulo, el usuario visualizara el diagrama de bode de un sistema en términos de <i>Laplace</i>; apreciando la respuesta del sistema ante diferentes frecuencias y como esta se desfasa a razón de ellas.
                <!--<br> <b><i>Nota: </i></b> En control, para identificar la dinámica de un sistema, se suele variar la frecuencia de la señal de entrada, cuando este presenta  inestabilidad o se quiere lograr datos específicos relacionado con las señales de entrada, luego verificar que sucede con la respuesta que entrega la planta; para ello este diagrama puede ayudar a la reconstrucción e identificación de la planta, en otros casos ayudar a construir un controlador.-->
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url(); ?>TranferFuncion/Bode" class="btn btn-primary">Continuar...</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <h4 class="card-header">LGR (Beta)</h4>
            <img class="card-img-top" src="<?php echo base_url(); ?>images/cabecera1/lgr.png" alt="">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">Lugar Geométrico de las Raíces</h6>
              <p class="card-text">En este módulo, el usuario estará visualizando elementos que ayuden a comprender la tendencia de los ceros y los polos, de una función de transferencia en el plano complejo, este espacio compone la solución de cálculos que permiten dibujar el LGR</p>
              <b><i>Nota: </i></b> Este módulo se encuentra con las operaciones básicas basadas en los libros de control de  dorf y ogata , el gráfico de LGR aún se encuentra sujeto a cambios.
            </div>
            <div class="card-footer">
              <a href="<?php echo base_url(); ?>TranferFuncion/Generador" class="btn btn-primary">Continuar...</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <h4 class="card-header">Generador</h4>
            <img class="card-img-top" src="<?php echo base_url(); ?>images/cabecera1/gentf.png" alt="">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">Generador de Señales</h6>
              <p class="card-text">En este módulo, el usuario podrá usar 4 señales en el sistema que ha digitado en términos de <i>Laplace</i>; este espacio está diseñado para la experimentación y aprendizaje autónomo. <br> <b><i>Nota: </i></b>las escalas varían al muestreo que use en el simulador, sin embargo la velocidad de simulación depende del navegador.</p>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url(); ?>TranferFuncion/Fuente" class="btn btn-primary">Continuar...</a>
            </div>
          </div>
        </div>
<!--
        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <h4 class="card-header">Ayuda</h4>
            <img class="card-img-top" src="<?php echo base_url(); ?>images/cabecera1/inf.png" alt="">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">Informacion de la seccion TF</h6>
              <p class="card-text">En este vínculo podrá encontrar información que le ayude a manejar las herramientas que en esta parte de la plataforma \(\mu \)lab lina se ofrece.</p>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url(); ?>TranferFuncion/Ayuda" class="btn btn-primary">Acceder a la Ayuda...</a>
            </div>
          </div>
        </div>

-->

      </div> <!-- /.row -->

      

    </div>
