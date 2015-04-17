<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Superprofe.co - Regístrate</title>
    <link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">
    <!-- Bootstrap core Less -->
    <link href="<?php echo (base_url('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo (base_url('assets/css/landing-superprofe.css')); ?>" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo (base_url('assets/js/landing.js')); ?>"></script>
    <script src="<?php echo (base_url('assets/js/jquery.validate.js'));?>" ></script>
    <script src="<?php echo (base_url('assets/js/validate.js'));?>"></script>
    <script src="<?php echo (base_url('assets/js/login/login.js')); ?>"></script>
</head>

<body class="fondo_admin">
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('index'); ?>"><img src="<?php echo base_url('assets/img/logo_superprofe.svg'); ?>">Super<span>Profe</span>.co</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="msj2 alert alert-warning alert-danger" role="alert" style="display:none" id="alert">
            <div class="msj2">
            <h4></h4>
            <ol>
                <li>
                    <label for="txtEmail" class="error">Ingresa un email valido</label>
                </li>
                <li>
                    <label for="txtPassword" class="error">Ingresa una contraseña</label>
                </li>
            </ol>
            </div>  
        </div>
        <div>
        <div class="container">
            <div class="row steps-center">
                <div class="col-md-12"></div>
            </div>
            <div class="col-md-6">
                
            <div class="row steps-center panel_busqueda">
                <div class="col-md-12">
                        <h3 class="text-center sub-titulos">INICIAR SESION</h3> 
                            <form action="<?php echo base_url('administrador/ingreso'); ?>" method="post" role="form" class="form-horizontal" id="form3">
                                <fieldset>
                                
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="txtEmail">Usuario</label>
                                            <input id="txtEmail" name="txtEmail" type="email" class="form-control" id="" placeholder="Usuario" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="">Contraseña</label>
                                            <input id="txtPassword" name="txtPassword" type="password" class="form-control" id="" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                    
                                    <?php echo($message); ?>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <!--<input type="submit" class="btn-profe btn-login col-lg-12" value="Ingresar" id="btnlogin">-->
                                            <button type="submit"  class="btn-profe btn-login btn col-lg-12">Ingresar</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-2"></div>
            </div>
            </div>
        </div>
    </div>
 
	<script>
		var base_url = '<?php echo base_url(); ?>';
		function enviar () {
			document.getElementById('form3').submit();
		}
	</script>
</body>
</html>