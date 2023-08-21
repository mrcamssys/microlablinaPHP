<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<p> &nbsp</p>
<!--<div style="position: fixed; width: 100%; height: 100%; background-image:  url(<?= base_url();?>images/cabecera1/portada/a3.jpg); background-size: 100% 100%; background-repeat: no-repeat; top: 0px; z-index: -1"></div>-->
   

 <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <center>
      <h1 class="mt-4 mb-3">Función de Transferencia<br>
        <small><small><small>Sistemas Dinámicos (Laplace)</small></small></small>
      </h1><hr></center>

      <!--<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item active">Contenido</li>
      </ol>-->

      <!-- Intro Content -->
      <!--<div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="<?php echo base_url(); ?>images/cabecera1/tf1.png" alt="">
        </div>
        <div class="col-lg-6">
          <h2>Funcion de Transferencia</h2>
          <p style="text-align:justify">
            En este espacio usted podrá trabajar con funciones de transferencia en términos de <i><b>Laplace</b></i> de la forma:
            <div class="table-responsive ">
            $$ H(s)= \frac{P_{num}}{P_{den}}=\frac{a_0s^x+b_0s^{x-1}+c_0s^{x-2}+...+d_0s^2+e_0s+f_0}{a_1s^n+b_1s^{n-1}+c_1s^{n-2}+...+d_1s^2+e_1s+f_1} $$</div>

      Obteniendo las diferentes características que describen el funcionamiento del sistema dinámico que usted digito, tales como: las raíces, el lugar geométrico, diagrama de bode, adicionalmente ver el comportamiento del sistema ante las diferentes señales que lo puedan afectar en su entrada.<br>

            Este simulador trabaja para sistemas <i><b> SISO </b></i>, está diseñado con fines educativos para la experimentación y comprensión de temas básicos de control y sistemas dinámicos.

          </p>
        </div>
      </div>-->

      <div class="row">
        <div class="col-lg-5">
          <!--<img class="img-fluid rounded mb-4" src="<?php echo base_url(); ?>images/cabecera1/tf1.png" alt="">-->


      <div class="menu_icons_nver2">
        <h1>Herramientas:</h1>
        <ul>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/calcular">
              <div class="div1"><span class="mlicon-tf"></span></div>
              <div class="div2"><h1>CLA <small>Cálculos de Lazo Abierto</small></h1>
                Obtendrá los datos característicos de una función de transferencia en lazo abierto, usted vera los cálculos de: raíces, fracciones parciales y gráfico ante el impulso.
              </div>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/close_loop">
              <div class="div1"><span class="mlicon-tfclose"></span></div>
              <div class="div2"><h1>CLC <small>Cálculos de Lazo Cerrado</small></h1>
                Realizará la operación de uno o varios sistemas en cascada con re-alimentación negativa; en el proceso de las operaciones se recomienda leer las instrucciones.
              </div>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/Bode">
              <div class="div1"><span class="mlicon-bode"></span></div>
              <div class="div2"><h1>GDB <small>Gráfico Diagrama de Bode</small></h1>
                Visualizará el diagrama de bode de un sistema en términos de Laplace; apreciando la respuesta del sistema ante diferentes frecuencias.
              </div>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/Generador">
              <div class="div1"><span class="mlicon-lgr"></span></div>
              <div class="div2"><h1>LGR <small>Lugar Geométrico de las Raíces</small></h1>
                Visualizará los componentes que ayuden a realizar el trazado y la tendencia de los ceros y los polos, de una función de transferencia en el plano complejo.
              </div>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/Fuente">
              <div class="div1"><span class="mlicon-fuente"></span></div>
              <div class="div2"><h1>Sys. Fuente <small>Simulador Sistemas con Fuentes</small></h1>
                Podrá usar 5 señales en el sistema que ha digitado en términos de Laplace; este espacio está diseñado para la experimentación y aprendizaje autónomo.
              </div>
            </a>
          </li>        
        </ul>
        </div>

      </div>

        <div class="col-lg-7" style="background-color: #FFFFFF">
          
          <center> 
            <img src="<?php echo base_url(); ?>images/cabecera1/explicar/ballbeamtf.png" class="img-fluid" style="width:90%;" alt="Responsive image">
          </center>
          <h2 style="color: #1A5276;">Introducción</h2>
          <p style="text-align:justify">
            En este espacio usted podrá trabajar con funciones de transferencia en términos de <i><b>Laplace</b></i> de la forma:
            <div class="table-responsive ">
            $$ H(s)= \frac{P_{num}}{P_{den}}=\frac{a_0s^x+b_0s^{x-1}+c_0s^{x-2}+...+d_0s^2+e_0s+f_0}{a_1s^n+b_1s^{n-1}+c_1s^{n-2}+...+d_1s^2+e_1s+f_1} $$</div>

      Obteniendo las diferentes características que describen el funcionamiento del sistema dinámico que usted dígito, tales como: las raíces, el lugar geométrico, diagrama de bode, adicionalmente ver el comportamiento del sistema ante las diferentes señales que lo puedan afectar en su entrada.<br>

            Este simulador trabaja para sistemas <i><b> SISO </b></i>, está diseñado con fines educativos para la experimentación y comprensión de temas básicos de control y sistemas dinámicos.
          </p>
          
        </div>
      </div>


      <!-- /.row -->
    </div>
