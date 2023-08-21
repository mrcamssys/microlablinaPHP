<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Modelos Matemáticos
        <small>Funciones de Transferencia</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>Mdelsystf">Modelos Matematicos</a>
        </li>
        <li class="breadcrumb-item active">Funciones de Transferencia</li>
      </ol>

      <div class="row">

        
        <!-- Blog Entries Column -->
        <div class="col-md-8">


     <div class="row text-center">
        <div class="col-lg-6 col-md-6 mb-3">
        <div class="card h-100">
          <img class="card-img-top" src=" <?= base_url(); ?>images/cabecera1/explicar/Motortf.png" alt="">
          <div class="card-body">
            <h4 class="card-title"><small>Control de Posición<br/><i>Motor DC</i></small></h4>
            <p class="card-text"><small>Modelo de un motor de corriente continua junto con su respectivo controlador.</small></p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary"> Variables de Estado </a><hr>
            <a href="<?= base_url()?>tfmotor" class="btn btn-success">Funcion transferencia</a>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 mb-3">
        <div class="card h-100">
          <img class="card-img-top" src=" <?= base_url(); ?>/images/cabecera1/explicar/ballbeamtf.png" alt="">
          <div class="card-body">
            <h4 class="card-title"><small>Control de Posición<br/><i>Ball of Beam (Viga Bola)</i></small></h4>
            <p class="card-text"><small>Modelo de un sistema viga bola es un sistema con un solo actuador y sensor.</small></p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary"> Variables de Estado </a><hr>
            <a href="<?= base_url()?>tfballbeam" class="btn btn-success">Funcion transferencia</a>
          </div>
        </div>
      </div>
          
      <div class="col-lg-6
       col-md-6 mb-3">
        <div class="card h-100">
          <img class="card-img-top" src=" <?= base_url(); ?>/images/cabecera1/explicar/arpentf.png" alt="">
          <div class="card-body">
            <h4 class="card-title"><small>Control de Posición<br/><i>Aeropendulo</i></small></h4>
            <p class="card-text"><small>Modelo de un sistema de balancin con una helice, basado en un pendulo simple.</small></p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary"> Variables de Estado </a><hr>
            <a href="<?= base_url()?>tfaeropendulo" class="btn btn-success">Funcion transferencia</a>
          </div>
        </div>
      </div>

   <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        
        <div class="card-footer">
            <a href="<?= base_url()?>tfaeropendulo" class="btn btn-success">Funcion transferencia</a>
          </div>

      </div>
    </div>
  </div>

    </div>
   </div> 

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <div class="card my-4">
            <h5 class="card-header">Vinculos Alternativos de TF</h5>
<div class="alert alert-warning" role="alert">
  Las herramientas que aparecen en esta lista son de modo Experimental, usted puede cambiar los datos de manera autonoma, pero dependiendo el orden de los modelos que desee implementar varian los resultados y las aproximaciones decimales.
  </div>
             <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href='<?php echo base_url()."TranferFuncion/calcular";?> '>Funcion de Tranferencia<hr></a>
                    </li>
                    <li>
                      <a href='<?php echo base_url()."TranferFuncion/close_loop";?> '>Lazo Cerrado<hr></a>
                    </li>
                    <li>
                      <a href='<?php echo base_url()."TranferFuncion/Generador";?> '>Rlocus (Beta)<hr></a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href='<?php echo base_url()."TranferFuncion/Fuente";?> '>Funcion de tranferencia con Diferentes Señales<hr></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Descripción</h5>
            <div class="card-body">
             En este Espacio encontrara algunos modelos matemáticos planteados y estudiados en plantas reales, usted podrá cambiar los valores característicos del sistema y observar las variaciones de la dinámica del sistema o función de transferencia que desee trabajar.
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->