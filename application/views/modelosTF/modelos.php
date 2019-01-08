<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Modelos Matematicos
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

          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="<?php echo base_url()."/images/cabecera1/explicar/Motortf.png";?>" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title">Control de Posición<br/><i>Motor DC</i></h2>
              <p class="card-text">Contenido...</p>
              <a href="#" class="btn btn-primary">Simular Datos &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Contenido original: <a href="#">Articulo Fuente</a>
            </div>
          </div>

          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="<?php echo base_url()."/images/cabecera1/explicar/arpentf.png";?>" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title">Control de Posición<br/><i>Aeropendulo</i></h2>
              <p class="card-text">Contenido...</p>
              <a href="#" class="btn btn-primary">Simular Datos &rarr;</a>
            </div>
            <div class="card-footer text-muted">
             Contenido original: <a href="#">Articulo Fuente</a>
            </div>
          </div>

          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="<?php echo base_url()."/images/cabecera1/explicar/ballbeamtf.png";?>" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title">Control de Posición<br/><i>Ball of Beam (Viga Bola)</i></h2>
              <p class="card-text">Contenido...</p>
              <a href="#" class="btn btn-primary">Simular Datos &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Contenido original: <a href="#">Articulo Fuente</a>
            </div>
          </div>

          <!-- Pagination
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <a class="page-link" href="#">&larr; Anterior</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Siguiente &rarr;</a>
            </li>
          </ul>-->

        </div> 

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget
          <div class="card mb-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div> -->

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Vinculos Alternativos de TF</h5>
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
                    <li>
                      <a href='<?php echo base_url()."help/tf";?> '>Ayuda en la seccion TranferFuncion<hr></a>
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
             En este Espacio encontrara algunos modelos matemáticos planteados y estudiados en plantas reales, usted podrá cambiar los valores característicos del sistema y observar las variaciones de la dinámica del sistema, analizando los cambios de la función de transferencia.
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->