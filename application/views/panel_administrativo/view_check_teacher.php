<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">
        <title>Superprofe.co - Mis clases</title>

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

        <!-- Fixed navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('index'); ?>">
                        <img src="<?php echo (base_url('assets/img/logo_superprofe.svg'));?>">SUPER<span>PROFE</span>.co
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class=""><a href="<?php echo base_url('');?>"><span class="glyphicon glyphicon-calendar"></span> Agenda</a></li>
                        <li class=""><a href="<?php echo base_url('facturacion/index');?>"><span class="glyphicon glyphicon-credit-card"></span> Facturación</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($this->session->userdata('sFirstName'));?> <img class="img-header" src="<?php echo ($this->session->userdata('sImageUrl'));?>"><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('');?>"><span class="glyphicon glyphicon-user"></span> Mi perfil</a></li>
                                <li><a href="<?php echo base_url('');?>"><span class="glyphicon glyphicon-cog"></span> Configuración</a></li>
                                <li><a href="<?php echo base_url('');?>"><span class="glyphicon glyphicon-briefcase"></span> Red de profesores</a></li>  
                                <li><a href="<?php echo base_url('login/logout');?>"><span class="glyphicon glyphicon-off"></span> Cerrar sessión</a></li>                
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <!--/Fixed navbar -->
        
        <div class="container">

            <h3><span class="glyphicon glyphicon-ok"></span> Proceso de verificación</h3>
            <div class="amigas-separator"></div>

            <div class="progress">

                <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                    <span class="sr-only">45% Complete</span>
                </div>
            </div>

            <div class="well col-md-12">
                <div class="col-md-5">
                    <h4>1. Verificación de antecedentes penales</h4>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            En proceso
                        </label>
                    </div>                      
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            Ok
                        </label>
                    </div>                      
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            No admitido
                        </label>
                    </div>                      
                </div>
            </div>

            <div class="well col-md-12">
                <div class="col-md-5">
                    <h4>2. Verificación referencias personales</h4>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            En proceso
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            Ok
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            No admitido
                        </label>
                    </div>
                </div>
            </div>

            <div class="well col-md-12">
                <div class="col-md-5">
                    <h4>3. Entrevistas</h4>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            En proceso
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            Ok
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            No admitido
                        </label>
                    </div>
                </div>
            </div>
            <div class="well col-md-12">
                <div class="col-md-5">
                    <h4>4. Prueba psicotecnica</h4>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            Ok
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            En proceso
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled="disabled">
                            No admitido
                        </label>
                    </div>
                </div>
            </div>                
        </div>
            

        <div class="amigas-separator"></div>
          
        <footer class="footer container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Aulas AMIGAS@</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://aulasamigas.com/noticia/reconocimientos-a-la-innovacion/" target="_blank">Reconocimientos</a></li>                    
                        <li><a href="http://aulasamigas.com/noticia/trabaja-con-aulas-amigas/" target="_blank">Trabaje con nosotros</a></li>
                        <li><a href="http://aulasamigas.com/noticia/prensa-y-medios/" target="_blank">Prensa y Medios</a></li>
                        <li><a href="http://aulasamigas.com/contactenos/" target="_blank">Contáctenos</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Productos</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://aulasamigas.com/productos/#tomi" target="_blank">Tomi</a></li>
                        <li><a href="http://aulasamigas.com/productos/#califica-la" target="_blank">califica.la</a></li>
                        <li><a href="http://aulasamigas.com/productos/#mimu" target="_blank">MIMU</a></li>
                        <li><a href="http://aulasamigas.com/productos/#cibox" target="_blank">CIBOX</a></li>
                        <li><a href="http://aulasamigas.com/productos/#e-kampus" target="_blank">e-Kampus</a></li>
                        <li><a href="http://aulasamigas.com/productos/#ciudadano-digital" target="_blank">Ciudadano Digital</a></li>
                        <li><a href="http://aulasamigas.com/productos/#plataforma" target="_blank">Plataforma</a></li>
                        <li><a href="http://aulasamigas.com/productos/#superprofe" target="_blank">Superprofe.co</a></li>
                        <li><a href="http://control.aulasamigas.com/services_state" target="_blank">Estado de Servicios</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Fundación</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://aulasamigas.org/#donaciones" target="_blank">Donaciones</a></li>
                        <li><a href="http://aulasamigas.org/#transformemos" target="_blank">Transformemos</a></li>
                        <li><a href="http://aulasamigas.org/#formemos" target="_blank">Formación de maestros</a></li>
                        <li><a href="http://aulasamigas.org/#se-voluntario" target="_blank">Se voluntario</a></li>
                        <li><a href="http://aulasamigas.org/con-el-apoyo-de/" target="_blank">Con el apoyo de</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Comunidad</h5>
                    <ul class="list-unstyled">
                        <li><a target="_blank" href="https://www.facebook.com/aulasamigas">Facebook</a></li>
                        <li><a target="_blank" href="https://twitter.com/aulasamigas">Twitter</a></li>
                        <li><a target="_blank" href="https://plus.google.com/109169941063321101583">Google+</a></li>
                        <li><a target="_blank" href="http://www.linkedin.com/company/aulas-amigas-">Liked in</a></li>
                        <li><a target="_blank" href="https://www.youtube.com/user/aulasamigastv">Youtube</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <a class="openLegalModal" href="#use"  data-toggle="modal" data-target="#legal_modal">Condiciones de uso</a> - 
                    <a class="openLegalModal" href="#policy" data-toggle="modal" data-target="#legal_modal">Política de Privacidad</a>
                </div>
                <div class="col-xs-6">
                    <div class="pull-right">Un producto <a>Aulas AMIGAS®</a></div>
                </div>
            </div>
        </footer>

        <script type="text/javascript">
            $(function () {
                $('.datepicker').datepicker()
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="<?php echo (base_url('assets/js/bootstrap.min.js')); ?>"></script>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                                    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-52494721-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>