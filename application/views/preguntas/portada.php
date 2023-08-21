<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Gestor de Preguntas

        <small></small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item active">Administrador</li>
      </ol>

      <div class="row">        
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <h2>Administrar Preguntas</h2>
            <hr />
          <div class="row text-center">
            
            <div class="col-lg-6 col-md-6 mb-3">
             <div class="card h-100 text-white bg-dark mb-3">
                  <div class="card-body">
                    <h4 class="card-title"><small>Espacios Habilitados...<br> vínculos de preguntas</small></h4>
                  </div>
                  <div class="card-footer">
                    <a href="<?= base_url()?>Gestor/verpreguntas" class="btn btn-success">Ver más...</a>
                  </div>
              </div>
            </div>


            <div class="col-lg-6 col-md-6 mb-3">
             <div class="card h-100 text-white bg-dark mb-3">
                  <div class="card-body">
                    <h4 class="card-title"><small>Anexar Vinculo de formularios generados por otras plataformas</small></h4>
                  </div>
                  <div class="card-footer">
                    <a href="<?= base_url()?>Gestor/nueva" class="btn btn-success">Ver más...</a>
                  </div>
              </div>
            </div>
        
        </div>

          <h2>Resolver Preguntas</h2>
          <hr />
          <div class="row text-center">
 

            <div class="col-lg-6 col-md-6 mb-3">
             <div class="card h-100 text-white bg-dark mb-3">
                  <div class="card-body">
                    <h4 class="card-title"><small>Visitar vínculos, para responder formularios externos</small></h4>
                  </div>
                  <div class="card-footer">
                    <a href="<?= base_url()?>Gestor/listar" class="btn btn-success">Ver más...</a>
                  </div>
              </div>
            </div>
        
        </div>

      </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <div class="card my-4">
            <h5 class="card-header">Pin de Registro</h5>
            <div class="card-body">
            Estimado usuario al compartir el código siguiente, usted habilita y vincula nuevos miembros para formular preguntas, solo comparta.</div>
<div class="alert alert-warning" role="alert">
  <h2 align="text-center"><center><?=$mypin;?></center></h2>
  </div>
             
          </div>
          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Descripción</h5>
            <div class="card-body">
             En este espacio el usuario puede administrar las preguntas que genere en la comunidad donde compartió el link, así como ver las preguntas que otros miembros o usuarios agregaron  si usted está anclado al pin de los demás usuarios registrados.
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->


    <!--
<?php
   $texto="";
   $i=0;
   foreach ($cant as $id){
 
?>
     
     <?php if($i%2==0){ ?>
     <div class="col-lg-6 col-md-6 mb-3">
     <div class="card h-100 text-white bg-secondary mb-3">
     <?php }else{ ?> 
     <div class="card h-100 text-white bg-dark mb-3">
     <?php }?>
          <div class="card-body">
            <h4 class="card-title"><small><?=$id->nombre;?></small></h4>
          </div>
          <div class="card-footer">
            <a href="<?= base_url()?>modelossys/calcular?id=1&sys=<?=$id->id_planta;?>" class="btn btn-success">Funcion transferencia</a>
          </div>
        </div>
      </div>


   
<?php
  $i++;
  } //bg-dark
?>


    -->