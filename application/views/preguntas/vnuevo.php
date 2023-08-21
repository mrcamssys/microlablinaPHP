<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
function Eliminar(pin,preg) {
  var txt;
  var r = confirm("Esta seguro que desea eliminar este dato!");
  if (r == true) {
   // txt = "You pressed OK!<";
    window.location = "<?=base_url();?>Gestor/elim?pin="+pin+"&id="+preg;
  } else {
    alert("El Dato no Fue eliminado");
  }
  //document.getElementById("demo").innerHTML = txt;
}
</script>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Registro de vinculo de preguntas

        <small>Administrador</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>Gestor">Banco de preguntas</a>
        </li>
        <li class="breadcrumb-item active">Lista de preguntas</li>
      </ol>

      <div class="row">        
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          


<?=$msg;?>
          

<form method="post" name="data1">

  <div class="form-group">
    <label for="exampleInputPassword1">Digíte el titulo</label>
    <input class="form-control form-control-lg" type="text" name="titulo" placeholder="Titulo del formulario agregado">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Digíte la URL</label>
    <input class="form-control form-control-lg" type="text" name="url" placeholder="Vinculo completo del formulario de preguntas de su gusto">
  </div>
  
  <button type="submit" class="btn btn-primary">Agregar</button>
</form>





      </div>
        <!-- Sidebar Widgets Column -->
<div class="col-md-4">
        <div class="card my-4">
            <h5 class="card-header">Nuevas Preguntas</h5>
            <div class="card-body">
              Haga clic en el botón para ir al las preguntas habilitadas en este espacio.
            </div>
             <div class="card-footer">
                <a href="<?= base_url()?>Gestor/verpreguntas" class="btn btn-success">Listar</a>
              </div>
          </div>


        
          <div class="card my-4">
            <h5 class="card-header">Pin de Registro</h5>
            <div class="card-body">
            Estimado usuario al compartir el código siguiente, usted habilita y vincula nuevos miembros para formular preguntas, solo comparta.</div>
<div class="alert alert-warning" role="alert">
  <h2 align="text-center"><center><?=$mypin;?></center></h2>
  </div>
             
          </div>
          <!-- Side Widget -->
          
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->


  