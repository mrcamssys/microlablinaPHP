<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<p> &nbsp</p>
<div style="position: fixed; width: 100%; height: 100%; background-image:  url(<?= base_url();?>images/cabecera1/portada/a1.jpg); background-size: 100% 100%; background-repeat: no-repeat; top: 0px; z-index: -1"></div>
   
<div class="container">
   <div class="jumbotron" style="background-color:transparent;">
      <h1 class="display-4" style="color: #D0D3D4;">Hola,  <?= $usuario; ?>!</h1>
      <p class="lead" style="color: #D0D3D4;">La plataforma está diseñada para simular sistemas en Laplace</p>
      <hr class="my-4" style="border-color:  #D0D3D4;">
      <p style="color: #D0D3D4;">La intención es ayudar al aprendizaje de conceptos básicos de control.</p>
      <p class="lead">
        <a class="btn btn-warning btn-lg"  href="<?= base_url(); ?>Present" role="button">Presentación Microlab</a>
      </p>
    </div>
</div>


<div class="container" >
        <!-- Example row of columns -->
        <p> &nbsp</p>
        <div class="row" >
          <div class="col-md-4" style="background-color: #FFF; width: 100%; height: 100%; opacity: 0.8;">
            <h2>Gestor de Preguntas</h2>
            <p>En este espacio usted podrá crear y responder preguntas tipo test, esto le permitirá verificar sus conceptos frente a un tema en particular.</p>
            <p><a class="btn btn-secondary" href="<?= base_url();?>Gestor" role="button">Mostrar &raquo;</a></p>
          </div>

          <div class="col-md-6" style="background-color: #FFF; width: 100%; height: 100%; opacity: 0.8;">
            <h2>Ingresar Funciones de Transferencia</h2>
            <p>En este espacio usted podrá trabajar con funciones de transferencia<br>Nota no ingrese funciones con polos repetidos y se ingresan en forma polinomica cada termino separado por comas.</p>
            <p><a class="btn btn-secondary" href="<?= base_url();?>TranferFuncion/calcular" role="button">Mostrar &raquo;</a></p>
          </div>

        </div>
</div></div>