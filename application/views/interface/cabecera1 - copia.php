<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <header>
<div class="container">
      <span class="d-none d-sm-block">
      <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
       
        <div class="carousel-item active">
          <img class="d-block w-100 h-100" src="images/cabecera1/dinamicos2.png" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Util para Trabajar desde cualquier lado</h5>
            <p>...</p>
          </div>
        </div>

        <div class="carousel-item">
          <img class="d-block w-100 h-100" src="images/cabecera1/dinamicos3.png" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Facil y Practico</h5>
            <p>...</p>
          </div>
        </div>



        <div class="carousel-item">
          <img class="d-block w-100 h-100" src="images/cabecera1/dinamicos.png" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Util para Trabajar desde cualquier lado</h5>
            <p>...</p>
          </div>
        </div>


        </div>



        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </span>
</div>




    <div class="container text-center d-sm-none" style="background-color: #DEECF0;">
      <p> &nbsp</p>Funcion de Transferencia
      <hr class="mx-auto" style="background-color: #1B2631;">
      
      <div onclick="location.href='<?php echo base_url(); ?>TranferFuncion/calcular'"  onclick="location.href='<?php echo base_url(); ?>images/cabecera1/openloop.png'" class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>L. Abierto<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      <div onclick="location.href='<?php echo base_url(); ?>TranferFuncion/close_loop'"   class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>L. cerrado<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      <div onclick="location.href='<?php echo base_url(); ?>TranferFuncion/Bode'"  class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>D. Bode<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      <div onclick="location.href='<?php echo base_url(); ?>TranferFuncion/Generador'"  class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>L.G.R<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      <div onclick="location.href='<?php echo base_url(); ?>TranferFuncion/Fuente'"  class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>SyS Fuente<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      
      <br>Modelos de sistemas
      <hr class="mx-auto" style="background-color: #1B2631;">

      <div onclick="location.href='<?php echo base_url(); ?>/Mdelsystf/'"  class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>Ball of Beam<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      <div onclick="location.href='<?php echo base_url(); ?>/Mdelsystf/'"  class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>DC Motor<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      <div onclick="location.href='<?php echo base_url(); ?>/Mdelsystf/'"  class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
        <center>Aero Pendulum<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>

      <br>Otras Caracteristicas
      <hr class="mx-auto" style="background-color: #1B2631;">

      <div onclick="location.href='<?php echo base_url(); ?>TranferFuncion/calcular'"  class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
       <center> Routh H.<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center></div>
      <div onclick="location.href='<?php echo base_url(); ?>TranferFuncion/calcular'" class="badge border border-dark" style="background-color: #1B2631;  color: #D0E5EC; width: 96px; height: 96px">
       <center> Polos D.<br>
          <img class="img-fluid d-block" width="70" height="70" src="<?php echo base_url();?>images/icons/menu1.png">
        </center>
      </div>
      <p> &nbsp</p>
    </div>

    </header>



<!-- Slide Three - Set the background image for this slide in the line below -->

<!--
          <div class="carousel-item active" style="background-image: url('images/cabecera1/dinamicos2.png'); background-size:100% auto;">
            <div class="carousel-caption d-none d-md-block">
              <h3>Bienvenido a LINA</h3>
              <p>Plataforma basica para simular control.</p>
            </div>
          </div>
          
          <div class="carousel-item" style="background-image: url('images/cabecera1/dinamicos3.png'); background-size:100% auto;">
            <div class="carousel-caption d-none d-md-block">
              <h3>Facil y Practico</h3>
              <p>.</p>
            </div>
          </div>
          
          <div class="carousel-item" style="background-image: url('images/cabecera1/dinamicos.png'); background-size:100% auto;">
            <div class="carousel-caption d-none d-md-block">
              <h3>Bienvenido a LINA</h3>
              <p>Plataforma basica para simular control.</p>
            </div>
          </div>
  -->