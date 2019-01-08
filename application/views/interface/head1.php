<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Carlos Arturno Moreno Susatama Trabajo de Grado UPN">
    <title>Micro-Lab Lina</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>images/cabecera1/linab2.png" >
    <meta name="subject" content="Esta plataforma está orientada, para que se ejecute en el navegador web, bien sea móvil o PC, es diseñada estudiantes que estén empezando el área de control, en esta ellos pueden simular un sistema dinámico de manera matemática, se espera que logren fortalecer conocimientos a la hora de reconocer las variables que afectan el comportamiento de una planta física." />
    <meta name="Description" content="El portal Micro-lab LINA es un espacio de interacción donde cada uno de los estudiantes de electronica de la comunidad podran experimentar mematicas de sistemas control basico "/>
    <meta name="Classification" content="Portal de internet desarrollado para el aprendizaje y fortalecimiento de sistemas de control I, ofertado en la Universidad Pedagogica Nacional"/>
    <meta name="Keywords" content="Sistemas Dinamicos, Colombia, LINA, Micro laboratorio, educación,  didactica, sistemas de control, lugar geometrico de las raices, modelamiento matematico, funcion de transferencia, diagrama de bode"/>
    <meta name="Geography" content="Colombia"/>
    <meta name="Language" content="spanish"/>
    <!-- libreria de estilos Bootstrap core CSS -->
    <link href="<?php echo base_url();?>stilos/muluser/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- libreria de estilos nmodernos del template -->
    <link href="<?php echo base_url();?>stilos/muluser/css/modern-business.css" rel="stylesheet">
    <link href="<?php echo base_url();?>stilos/muluser/css/microlablina.css" rel="stylesheet">
    <link href="<?php echo base_url();?>stilos/iconsfont.css" rel="stylesheet">

    <link href="<?php echo base_url();?>images/icons/menuicons.png" rel="icon">
    <!--librerias de proposito general-->
    <script src="<?php echo base_url();?>stilos/muluser/js/Chart.bundle.js"></script>
    <script src="<?php echo base_url();?>stilos/muluser/js/utils.js"></script>
    <!-- librerias de conversion matematica entendibe al usuario-->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 




    <!-- fin librerias de proposito general -->

    <script>
      /*
       $(document).ready(function()
       {
          $("#mostrarmodal").modal("show");
       });*/
    </script>




    <script type="text/javascript">
    function sendform(nombreformulario,url){
       document.getElementById(nombreformulario).action=url;
       document.getElementById(nombreformulario).submit();
    };

    $(window).load(function() {
        $(".loader").fadeOut("slow");
    });
    </script>


  </head>
  <body>

    <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
              <h3>Informacion de Administrador</h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
             <div class="modal-body">
                <h4>Modificadores</h4>
                En estos momentos la pagina esta siendo modificada con el fin de remplazar  o actualizar las librerias principales de matematicas.<br> se recomienda Tener paciencia.    
         </div>
             <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
         </div>
          </div>
       </div>
    </div>

    <div class="otros d_none d-lg-none collapse" id="navbarResponsivem">
      <div class="menu_icons_nver">
        <h1>Funcion de transferencia</h1>
        <ul>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/calcular"><span class="mlicon-tf"></span><p>Lazo Abierto</p></a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/close_loop"><span class="mlicon-tfclose"></span><p>Lazo Cerrado</p></a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/Bode"><span class="mlicon-bode"></span><p>Diag. Bode</p></a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/Generador"><span class="mlicon-lgr"></span><p>LGR</p></a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/Fuente"><span class="mlicon-fuente"></span><p>sys. Fuente</p></a>
          </li>
        </ul>
        <h1>Modelos de sistemas</h1>
        <ul>
          <li>
            <a href="<?php echo base_url(); ?>/Mdelsystf/"><span class="mlicon-ballbeam"></span><p>Ball of Beam</p></a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>/Mdelsystf/"><span class="mlicon-motor"></span><p>DC. Motor</p></a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>/Mdelsystf/"><span class="mlicon-arpendulo"></span><p>Aeropendulo</p></a>
          </li>
        </ul>
        <h1>Adicionales</h1>
        <ul>
          <li>
            <a href="<?php echo base_url(); ?>TranferFuncion/ruth"><span class="mlicon-ruth"></span><p>Routh H.</p></a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>beta1"><span class="mlicon-poldom"></span><p>Mover Polos</p></a>
          </li>
        </ul>
      </div>
    </div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <p><a class="navbar-brand" href="<?php echo base_url();?>">
        <div class="logo_lina" title="Laboratorio Virtual Lina" onclick="location.href = '<?php echo base_url();?>';">
        </div>
        </a></p>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-folder-plus"></span>
        </button>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsivem" aria-controls="navbarResponsivem" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-sigma"></span> Herramientas
        </button>

        


        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"><span class="icon-plataforma"></span>&nbsp La Plataforma</a>
            </li>       
<!--
            <li class="nav-item">
              <a class="nav-link" href="#"><span class="icon-contacto"></span>&nbsp eForo</a>
            </li>
-->
            <li class="nav-item dropdown d-none d-sm-block">
            <!--<li class="nav-item dropdown">-->
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="icon-sigma"></span>&nbsp Modelos de Sistemas
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg" aria-labelledby="navbarDropdownPortfolio">
                <a class="dropdown-item" href="<?php echo base_url();?>Mdelsystf/">Ball of Beam</a>
                <a class="dropdown-item" href="<?php echo base_url();?>Modelsysve/">Aeropendulo</a>
                <a class="dropdown-item" href="<?php echo base_url();?>Modelsysve/">Motor de corriente continua </a>
              </div>
            </li>

<!--Propuesta del menu nuevo -->
            <li class="nav-item dropdown d-none d-sm-block">
            <!--<li class="nav-item dropdown">-->
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="icon-herramientas"></span>&nbsp Herramientas
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg" aria-labelledby="navbarDropdownPortfolio">
                <a class="dropdown-item" href="<?php echo base_url();?>TranferFuncion/">Funcion de Tranferencia (T.F)</a>
                <a class="dropdown-item" href="<?php echo base_url();?>Ruth/l">Criterio de Routh</a>
                <a class="dropdown-item" href="<?php echo base_url();?>Ruth/l">Informacion</a>
          	  </div>
            </li>
  		

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-user"></span>&nbsp Ingresar</a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
      				  <form class="px-4 py-3">
      				    <div class="form-group">
      				      <label for="exampleDropdownFormEmail1">Usuario o Correo</label>
      				      <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
      				    </div>
      				    <div class="form-group">
      				      <label for="exampleDropdownFormPassword1">Contraseña</label>
      				      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
      				    </div>
      				    <button type="submit" class="btn btn-success">Entrar...</button>
      				  </form>
  				      <div class="dropdown-divider"></div>
				        <a class="dropdown-item" href="<?php echo base_url();?>/ULogin">Eres Nuevo? Registrate Aqui</a>
				        <a class="dropdown-item" href="#">Olvide mi clave?</a>
  	          </div>
            </li>

            </li>
          </ul>
        </div>
      </div>
    </nav>