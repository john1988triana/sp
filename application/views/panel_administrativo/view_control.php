<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">
    <title>Superprofe.co - panel de control</title>

    <!-- Bootstrap core Less -->
    <link href="<?php echo (base_url('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo (base_url('assets/css/landing-superprofe.css')); ?>" rel="stylesheet" type="text/css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo (base_url('assets/js/landing.js')); ?>"></script>
    <script src="<?php echo (base_url('assets/js/jquery.validate.js'));?>" ></script>
    <script src="<?php echo (base_url('assets/js/validate.js'));?>"></script>
    <script src="<?php echo (base_url('assets/js/login/login.js')); ?>"></script>
</head>
<body>
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('index'); ?>"><img src="<?php echo base_url('assets/img/logo_superprofe.svg'); ?>">Super<span>Profe</span>.co</a>
                    
                </div>
                <!--<div class="navbar-collapse collapse">
                    <ul class="nav nav-pills pull-right">
                        <li><a href="<?php echo base_url('login'); ?>">Iniciar Sesión</a></li>
                        <li><a href="como_funciona.html">Como funciona</a></li>
                        <li><a href="<?php echo base_url('login/inicioRegistrarse'); ?>">Registrate</a></li>
                        <li><a href="contacto.html">Contácto</a></li>
                    </ul>
                </div>/.nav-collapse -->

                <ul class="nav nav-pills pull-right" role="menu">
                    <!--<li><a href="#">Mi perfil</a></li>
                    <li><a href="#">Red de profesores</a></li>  --> 
                    <li><a href="<?php echo base_url('login/logout');?>">Cerrar sessión</a></li>               
                </ul>
            </div>
        </div>
    <div class="col-md-8 col-md-offset-2">
        <form action="<?php echo base_url('administrador/cargar_panel')?>" method="post">
        <table class="table table-condensed table-bordered table-hover">

            <tr>
                <th class="active text-center">CLASES</th>
                <th class="active text-center">PROFESORES</th>
                <th class="active text-center">ESTUDIANTES</th>
            </tr>
            <tr class="text-center">
                <td class=""><button type="submit" class="btn btn-link" onmousedown="cambiarEntrada('estado_clase')">Solicitudes</button></td>
                <td class=""><button type="submit" class="btn btn-link" onmousedown="cambiarEntrada('profes_en_proceso')">En proceso</button></td>
                <td class="">Clases de la semana</td>

            </tr>
            <tr class="text-center">
                <td>Programadas</td>
                <td>Perfiles</td>
                <td>Perfiles</td>
            </tr>
            <tr class="text-center">
                <td>Finalizadas</td>
                <td>Agendados para clase</td>
                <td>Reportes</td>
            </tr>
            <tr class="text-center">
                <td>Seguimiento a clases</td>
                <td>En Mora</td>
                <td>-</td>
            </tr>
            <tr class="text-center">
                <td>Reportes</td>
                <td>Reportes</td>
                <td>-</td>
            </tr>
            <!--<tr class="text-center">
                <td>Cont 6</td>
                <td>Cont 6</td>
                <td>Cont 6</td>
            </tr>-->
        </table>
        <?php 
                echo $datos;

        ?>
        <input type="hidden" name="entrada" id="entrada" value="">
        </form>
    </div>
    <script type="text/javascript"> 


        function cambiarEntrada (valor) {
            $("#entrada").val(valor)
        }
        function cambiarVerifiacionProfe (elemento,valor) {

            var val = elemento.value;
            if(val==1){
                elemento.value = 0
            }if(val==0){
                elemento.value = 1
            }

            
        }
    </script>
</body>
</html>