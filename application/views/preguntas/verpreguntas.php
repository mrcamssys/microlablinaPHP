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
      <h1 class="mt-4 mb-3">Listado de Vínculos de plataformas

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
          <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titulo</th>
      <th scope="col">Fecha</th>
      <th scope="col">Config</th>
    </tr>
  </thead>
  <tbody>



 

<?php
$i=0;
 foreach ($preguntasz as $id) {
               // $texto=$texto.$id->descrip;
?>

   <tr>
      <th scope="row"><?=$i;?></th>
      <td><?=$id->Titulo;?></td>
      <td><?=$id->fecha_pub;?></td>
      <td>
       <a href="#" onclick="Eliminar('<?=$id->pin;?>','<?=$id->id_pregunta;?>')" class="btn btn-warning" role="button">Eliminar</a>
      <a href="<?=$id->URL;?>" target="_blank" class="btn btn-success" role="button">Ir</a></td>

    </tr>

<?php $i++; } ?>






  </tbody>
</table>





          

      </div>
        <!-- Sidebar Widgets Column -->
<div class="col-md-4">
        <div class="card my-4">
            <h5 class="card-header">Nuevas Preguntas</h5>
            <div class="card-body">
              Haga clic en el botón para habilitar el espacio de vinculo de preguntas.
            </div>
             <div class="card-footer">
                <a href="<?= base_url()?>Gestor/nueva" class="btn btn-success">Anexar</a>
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


  