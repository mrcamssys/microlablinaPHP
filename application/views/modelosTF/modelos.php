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
          <a href="<?php echo base_url(); ?>Mdelsystf">Modelos Matemáticos</a>
        </li>
        <li class="breadcrumb-item active">Funciones de Transferencia</li>
      </ol>

      <div class="row">        
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        <div class="row text-center">
<?php
   $texto="";
   $i=0;
   foreach ($cant as $id){
 
?>
     
      <div class="col-lg-6 col-md-6 mb-3">
     <?php if($i%2==0){ ?>
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
 </div>
    </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <div class="card my-4">
            <h5 class="card-header">Vínculos Alternativos de TF</h5>
<div class="alert alert-warning" role="alert">
  Las herramientas que aparecen en esta lista son de modo Experimental, usted puede cambiar los datos de manera autonoma, pero dependiendo el orden de los modelos que desee implementar varían los resultados y las aproximaciones decimales.
  </div>
             <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href='<?php echo base_url()."TranferFuncion/calcular";?> '>Función de Transferencia<hr></a>
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
                      <a href='<?php echo base_url()."TranferFuncion/Fuente";?> '>Función de transferencia con diferentes señales<hr></a>
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