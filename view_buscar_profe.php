<!DOCTYPE html>
<html lang="es">
    <head>

        <!--Etiquetas meta-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Superprofe.co - Buscar Profesor</title>
        <link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">

        <!-- Bootstrap core Less -->
        <link href="<?php echo (base_url('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo (base_url('assets/css/landing-superprofe.css')); ?>" rel="stylesheet" type="text/css">
        
        <!--Bootstrap datetime picker-->
        <link href="<?php echo(base_url('assets/css/datetime/BeatPicker.min.css'));?>" rel="stylesheet" media="screen">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="<?php echo (base_url('assets/js/landing.js')); ?>"></script>
        <script src="<?php echo (base_url('assets/js/jquery.validate.js'));?>" ></script>
        <script src="<?php echo (base_url('assets/js/validate.js'));?>" ></script>
        <script src="<?php echo (base_url('assets/js/search.js'));?>" ></script>
    </head>
    <body role="document">

        <!-- Fixed navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('index'); ?>"><img src="<?php echo (base_url('assets/img/logo_superprofe.svg'));?>">SUPER<span>PROFE</span>.co</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav nav-pills pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($this->session->userdata('sFirstName'));?> <img class="img-header"<?php echo ($this->session->userdata('sImageUrl'));?>><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('login/logout'); ?>">Cerrar sessión</a></li>
                                <li><a href="">Actualizar perfil</a></li>                  
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/.nav-collapse -->
        <div class="jumbotron">
            <div class="container">
                <div class="row steps-center">
                    <!--Formulario para enviar los datos de consulta-->
                    <form  action="<?php echo base_url('busqueda/resultado_busqueda'); ?>" method="post" class="formulario">

                        <!--Area-->
                        <div class="col-md-2">
                            <label for="area">Area:</label>
                            <select name="area" id="area" class="form-control col-md-9" value="">
                                <option value="pleaseSelect">Area</option>
                                <?php 
                                    $areas = json_decode($areas, true);
                                    foreach ($areas as $key => $value_areas) {
                                ?> 
                                    <option value=<?php echo $value_areas['IdArea']; ?>>
                                        <?php echo $value_areas['Name']; ?>
                                    </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <!--Tema especifico-->
                        <div class="col-md-2">
                            <label for="tema">Tema especifico</label>
                            <select name="cbo_tema" id="cbo_tema" class="form-control col-md-9">
                                <option value="opt_default">Opción</option>
                            </select> 
                        </div>

                        <!--Ciudad: este campo se trae desde la base de amigas-->
                        <div class="col-md-2">
                            <label for="ciudad">Ciudad:</label>
                            <select name="ciudad" id="ciudad" class="form-control col-md-9">
                                <option value="pleaseSelect">Ciudad</option>
                                <?php 
                                    $cities = json_decode($cities, true);
                                    $cities = json_decode($cities['cities'], true);
                                    foreach ($cities as $key => $value_cities) {
                                ?> 
                                    <option value=<?php echo $value_cities['ID']; ?>>
                                        <?php echo utf8_decode($value_cities['Name']); ?>
                                    </option> 
                                <?php
                                    }
                                ?>      
                            </select>
                        </div>

                        <!--Fecha -->
                        <div class="col-md-2">
                            <label for="tema">Fecha</label>
                            <input type="text" class="form-control" data-beatpicker="true" data-beatpicker-position="['*','*']" data-beatpicker-module="today,clear,icon" placeholder="Seleccione la fecha" name="input_date" id="input_date" data-beatpicker-disable="{from:[2014,1,1],to:[2014 , 2 , '*']}">
                        </div>

                        <!-- Hora se carga un formulario -->

                        <div class="col-md-2">
                            <label for="tema">Hora</label>
                            <select name="cbo_hora" id="cbo_hora" class="form-control">
                                <option value="">opción</option>
                                <option value="6">6:00 am</option>
                                <option value="7">7:00 am</option>
                                <option value="8">8:00 am</option>
                                <option value="9">9:00 am</option>
                                <option value="10">10:00 am</option>
                                <option value="11">11:00 am</option>
                                <option value="12">12:00 pm</option>
                                <option value="13">1:00 pm</option>
                                <option value="14">2:00 pm</option>
                                <option value="15">3:00 pm</option>
                                <option value="16">4:00 pm</option>
                                <option value="17">5:00 pm</option>
                                <option value="18">6:00 pm</option>
                                <option value="19">7:00 pm</option>
                                <option value="20">8:00 pm</option>
                                <option value="21">9:00 pm</option>
                                <option value="22">10:00 pm</option>
                            </select>
                        </div>  
                         

                        <!--Boton buscar que ejecuta la consulta-->
                        <div class="col-md-2">
                            <label for=""></label>
                            <input type="submit" class="btn btn-primary col-lg-12" name="buscar" value="Buscar profe">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <section class="container">
            <?php echo validation_errors();?>

            <div class="alert alert-danger text-center">Recuerde ingresar los datos</div>

            <div class="container">

                <div class="col-md-12">
                     
                    <div class="row steps-center">
                    <div class="form-group">
            

                    <!--Resultados de la búsqueda que se recibe por medio de los parametros area, tema y ciudad-->
                    <?php

                        $results = json_decode($results, true);
                        if ($resultado_condiciones_completas && is_array($results))
                        {
                            foreach ($results as $key => $value_results) {

                        
                                if(array_search(md5($value_results['IdUser']),$id_arreglo_completas)!==false){
                                    

                    ?>
                    <div class="col-md-4">
                        <div class="panel-default">                                            
                            <div class="panel-heading"><h5 class="text-center"><?php echo $value_results['FirstName']; ?>  <?php echo $value_results['FamilyName']; ?></h5></div>
                            <div class="panel-body text-center">
                                <img class="img-profile"<?php echo $value_results['Image']; ?>>
                                <p class="par"><?php echo $value_results['Email'];?></p>
                                <p class="par">
                                    <?php 
                                            foreach ($cities as $key_cities => $value_cities) {
                                                if($value_cities['ID'] == $this->input->post('ciudad')){
                                                     echo utf8_decode($value_cities['Name']); 
                                                    break;
                                                }
                                            }
                                    ?>
                                </p>    
                                <p class="par">Area:</p>
                                <p class="par">precio: 10.000</p>
                                <a href="<?php echo base_url('registro/nuevaPagina'); ?>" class=" btn btn-info col-lg-12 ">Ver perfil</a>
                            </div>
                        </div>
                    </div>           
                    </div>           
                    </div>
                    <?php
                                }
                            }
                        }
                    ?>
                    <!--Fin de los resultados de búsqueda-->

                    <div class="row">
                        <div class="form-group">
                        <?php
                            /*$results = json_decode($results, true);*/
                            if ($resultado_condiciones_incompletas && is_array($results))
                            {
                                ?>
                                <div class="alert alert-danger text-center">Otras opciones en la franja escogida</div>
                                <?php

                                foreach ($results as $key => $value_results) {

                        
                                    if(array_search(md5($value_results['IdUser']),$id_arreglo_incompletas)!==false){
                        ?>
                        <div class="col-md-4">
                            <div class="panel-default">                                            
                                <div class="panel-heading"><h5 class="text-center"><?php echo $value_results['FirstName']; ?>  <?php echo $value_results['FamilyName']; ?></h5></div>
                                <div class="panel-body text-center">
                                    <img class="img-profile"<?php echo $value_results['Image']; ?>>
                                    <p class="par"><?php echo $value_results['Email'];?></p>
                                    <p class="par">
                                        <?php 
                                                foreach ($cities as $key_cities => $value_cities) {
                                                    if($value_cities['ID'] == $this->input->post('ciudad')){
                                                         echo utf8_decode($value_cities['Name']); 
                                                        break;
                                                    }
                                                }
                                        ?>
                                    </p>    
                                    <p class="par">Area: <?php echo $this->input->post('area');?></p>
                                    <p class="par">precio: 10.000</p>
                                    <a href="<?php echo base_url('registro/nuevaPagina'); ?>" class=" btn btn-info col-lg-12 ">Ver perfil</a>
                                </div>
                            </div>
                        </div>       
                    <?php
                                }
                            }
                        }

                    ?>  
                        </div>           
                    </div>
                </div>
            </div>
                    <!--Fin de los resultados de búsqueda-->
        </section>
        
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
        <script src="<?php echo (base_url('assets/js/datetime/BeatPicker.min.js')); ?>"></script>
        <script src="<?php echo (base_url('assets/js/datetime/locales/bootstrap-datetimepicker.es.js')); ?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                var statusGenerator = function (text) {
                    var statusElem = $(".status-box");
                    var child = $("<span style='display: block'></span>").text(text);
                    statusElem.append(child);
                };
                myDatePicker.on("select", function (data) {
                    statusGenerator(data.string + " selected")
                });
                myDatePicker.on("change", function (data) {
                    statusGenerator("Date picker changed current date: "+data.string);
                });
                myDatePicker.on("show", function () {
                    statusGenerator("Date picker show")
                });
                myDatePicker.on("clear", function (data) {
                    statusGenerator("Date picker cleared. cleared date: " + data.string)
                });
                myDatePicker.on("hide", function () {
                    statusGenerator("Date picker hide")
                });
            })
        </script>

        <script type="text/javascript">
$(document).ready(function(){

    var statusGenerator = function (text) {
        var statusElem = $(".status");
        var child = $("&lt;span>&lt;/span>").text(text);
        statusElem.append(child);
    };

    myDatePicker.on("select", function (data) {
        statusGenerator(data.string + " selected")
    });

    myDatePicker.on("change", function (data) {
        statusGenerator("Date picker changed current date: "+data.string);
    });

    myDatePicker.on("show", function () {
        statusGenerator("Date picker show")
    });

    myDatePicker.on("clear", function (data) {
        statusGenerator("Date picker cleared. cleared date: " + data.string)
    });

    myDatePicker.on("hide", function () {
        statusGenerator("Date picker hide")
    });
})
</script>
         <script type="text/javascript">
            $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            });
        </script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })
            (window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-52494721-1', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>
