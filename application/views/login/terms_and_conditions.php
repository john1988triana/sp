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
    <script src="<?php echo (base_url('assets/js/login/politicas/politicas.js'));?>"></script>
</head>

<body>

    <!-- Navbar
    ================================================== -->
<div class="modal fade in" id="legal_modal" tabindex="-1" role="dialog" aria-labelledby="legalModal" aria-hidden="false" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Información Legal</h4>
                    </div>
                    <div class="modal-body">

                        <ul id="legalTab" class="nav nav-tabs" role="tablist">
                            <li id="li_uso"><a onclick="uso(event)" role="tab" data-toggle="tab">Condiciones de Uso</a></li>
                            <li id="li_politicas" class="active"><a onclick="politicas(event)" role="tab" data-toggle="tab">Política de Datos</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" id="use">
                                <iframe src="http://www.amigaslive.com/amigasStore/0021/acuerdos/acuerdoUso.html"></iframe>
                            </div>
                            <div class="tab-pane active" id="policy">
                                <iframe src="http://www.amigaslive.com/amigasStore/0021/acuerdos/politicas.html"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary" href="<?php echo(base_url('login/logout')); ?>" data-dismiss="modal">Cerrar</a>
                    	<a type="button" class="btn btn-primary" href="<?php echo(base_url('login/ok_condiciones')); ?>" data-dismiss="modal">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade in"></div>
</body>
</html>