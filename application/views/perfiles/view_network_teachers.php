<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">
        <title>Superprofe.co - Red de profesores</title>

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
                        <li class=""><a href="#">Agenda</a></li>
                        <li class=""><a href="#">Facturación</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($this->session->userdata('sFirstName'));?> <img class="img-header" src="<?php echo ($this->session->userdata('sImageUrl'));?>"><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('login/logout');?>">Cerrar sessión</a></li>                
                            </ul>
                        </li>
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </div>
        <!--/Fixed navbar -->
        
        <div class="container">

            <div class="container">
                <div class="col-md-12 row2steps-center">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h5 class="text-center">
                            Tu perfil no es público porque aún no ha sido validado por nuestro equipo, también puedes solicitar a un colega que te recomiende.
                        </h5>
                        <p class="text-center"><a href="" class="btn btn-info text-center">Solicitar recomendación</a></p>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <div class="container">
                <div class="alert alert-danger">
                    <p class="text-center">
                        El profesor $nombre_profesor no ha confirmado tu solicitud de recomendación.
                    </p>
                    <p class="text-center">
                        Puedes esperar a una confirmación por parte de nuestro equipo o puedes solicitar a otro colega que te recomiende
                    </p>
                    <p class="text-center">
                        <a href="" class="btn btn-info text-center">Solicitar recomendación</a>
                    </p>
                </div>
            </div>
            <div class="container">
                <div class="alert alert-success">
                    <p class="text-center">
                        Estás recomendado por $nombre_profesor, tu calificación y comportamiento dentro de la comunidad afecta también su calificación.
                    </p>
                </div>
            </div>

            <div class="container">
                <div class="col-md-12">
                    <div class="col-md-2">
                        
                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title">Nombre profesor</h3>
                                <p class="glyphicon glyphicon-star"></p>
                                <p class="glyphicon glyphicon-star"></p>
                                <p class="glyphicon glyphicon-star"></p>
                                <p class="glyphicon glyphicon-star"></p>
                                <p class="glyphicon glyphicon-star"></p>
                            </div>

                            <div class="panel-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis molestias sint incidunt similique accusamus pariatur. Excepturi dignissimos blanditiis nulla modi eligendi culpa vel voluptas reiciendis, quos odit accusamus eum nam!
                                </p>
                            </div>

                            <div class="panel-footer">
                                <a href="#" class="glyphicon glyphicon-retweet">5</a>
                                <a href="#" class="glyphicon glyphicon-heart">10</a>
                            </div>
                        </div>
                        <!-- end .panel panel default-->
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

            <div class="container">
                    <h4>Solicitudes de recomendación</h4>
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">Nombre_profesor</div>
                                <div class="panel-body">
                                    <a href="">Rechazar</a>
                                    <a href="" class="btn btn-info text-center">Aceptar</a>
                            
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">Nombre_profesor</div>
                                <div class="panel-body">
                                    <a href="">Rechazar</a>
                                    <a href="" class="btn btn-info text-center">Aceptar</a>
                                </div>
                            </div>      
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="container">
            <h4>profesores en tu red</h4>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heding"><h4 class ="text-center">1er nivel</h4></div>
                    <div class="panel-body">
                        
                    </div> 
                </div>   
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heding"><h4 class ="text-center">2do nivel</h4></div>
                    <div class="panel-body">
                    </div>
                    
                </div>   
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heding"><h4 class ="text-center">Otros profesores</h4></div>
                    <div class="panel-body"> 
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

         <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>
    </body>
</html>