<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <h1 class="mt-4 mb-3">Login
        <small>Registrar o Ingresar a lina</small>
    </h1>
    <ol class="breadcrumb">
       <li class="breadcrumb-item">
       <a href="<?php echo base_url(); ?>">Pagina Principal</a>
       </li>
       <li class="breadcrumb-item active">Usuarios de la plataforma</li>
    </ol>
	
    <div id="loginbox" style="display:none; margin-top:50px;">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                
                
            </div>     
            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" ></div>                         
                <form id="loginform" method="post" class="form-horizontal" role="form">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Usuario o Correo">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Clave">
                    </div>
                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Recordar me
                            </label>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <a id="btn-login" href="#" class="btn btn-success">Continuar...  </a>
                            <input type="submit" name="" value="ingresar">
                            <a id="btn-fblogin" onClick="$('#loginbox').hide(); $('#signupbox').show()" class="btn btn-primary">Registrarme</a>
                        </div>
                    </div>
                </form>     
            </div>                     
        </div>  
    </div>

    <div id="signupbox" style="margin-top:50px">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3>Bienvenido!<br> Es hora de registrarte... </h3>
            <!--<div class="btn btn-success" style="float:right;"><a style="color: #FFFFFF;" id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Entrar</a></div>-->
        </div>  
 

<?php if($error==1){ ?>
<div class="alert alert-danger">
  <strong><?= $tipo; ?>!</strong> <?= $mensaje;?>.
</div>
<?php } 

if($error==2){?>
<div class="alert alert-success"><strong>En hora buena! <?=$error;?></strong>Ahora ya estas registrado</div>
<?php }?>

        <div class="panel-body" >
            <form id="signupform" class="form-horizontal" role="form" method="post" action="<?= base_url(); ?>/ULogin/registrar">                        
                <div id="signupalert" style="display:none" class="alert alert-danger">
                    <p>Error:</p>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Correo Electronico">
                    </div>
                </div>
                                    
                <div class="form-group">
                    <label for="firstname" class="col-md-3 control-label">Nombres:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombres">
                    </div>
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-md-3 control-label">Apellidos:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="apellido" placeholder="Apellidos">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Clave:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="clave1" placeholder="Clave">
                    </div>
                </div>

                 <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Repetir Clave:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="clave2" placeholder="Clave">
                    </div>
                </div>



                <div class="form-group"><div class="col-md-9">
              <div class="controls">
                <label>Nivel Educativo:</label>
                  <select name="cargo" class="browser-default custom-select">
                    <option selected="Estudiante">Estudiante</option>
                    <option value="Docente">Docente</option>
                    <option value="Ingeniero">Ingeniero</option>
                    <option value="Otro">Otro</option>
                  </select>
              </div></div>
            </div>

                <div class="form-group">
                    <label for="icode" class="col-md-3 control-label">Institución:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="institucion" placeholder="use una palabra">
                    </div>
                </div>

                <div class="form-group">                                        
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Guardar...</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div> 
		
</div><!--fin del contenedor-->