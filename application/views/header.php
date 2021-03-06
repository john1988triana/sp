<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(isset($headers)){
		foreach($headers as $name => $content) { ?>
			<meta name="<?php echo $name; ?>" content="<?php echo $content; ?>">
		<?php } 
	} ?>
	<link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">
	<?php if(isset($title)): ?>
		<title><?= $title;?></title>
	<? else: ?>
		<title>Profesores y Clases Particulares Virtuales y a Domicilio.</title>
		<meta name="description" content="Profesores Particulares para Clases Virtuales y a Domicilio para Refuerzos y Preparación de Exámenes. Aquí  los encuentras rápido, fácil y seguro!">
	<? endif; ?>
	<!-- Bootstrap core Less -->
	<link href="<?php echo (base_url('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo (base_url('assets/css/landing-superprofe.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/sweet-alert.css")?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>" rel="stylesheet" type="text/css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo (base_url('assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo (base_url('assets/js/sweet-alert.min.js')); ?>"></script>
   	
	<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
		$.src='//v2.zopim.com/?2mD2YVGFNK0h0bWkoDYC5aRFZXR7YVq1';z.t=+new Date;$.
		type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
	</script>
	<!-- Google Tag Manager
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PHKBM3"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PHKBM3');</script>
	 End Google Tag Manager -->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top"  role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo base_url('index'); ?>"><img src="<?php echo base_url('assets/img/logo_superprofe.svg'); ?>" alt="Logo de Superprofe">Super<span>Profe</span>.co</a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Menu</span>
					<span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav nav-pills pull-right">
					<?php if($this->session->userdata("sIdUser")) : ?>
					<li style="padding-top: 8px;"><a href="<?php echo base_url(''); ?>">Inicio</a></li>
					<li style="padding-top: 8px;"><a href="<?php echo base_url('perfil/agenda'); ?>">Agenda</a></li>
					<li style="padding-top: 8px;"><a href="<?php echo base_url('perfil/clases'); ?>">Clases</a></li>
					<li style="padding-top: 8px;"><a href="<?php echo base_url('perfil/facturacion'); ?>">Facturación</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($this->session->userdata('sFirstName'));?> <img class="img-header" src="<?php echo base_url($this->session->userdata('sImageUrl')); ?>"><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url('perfil'); ?>">Perfil</a></li>
							<li><a href="<?php echo base_url('login/logout'); ?>">Cerrar sesión</a></li>
						</ul>
					</li>
					<?php else: ?>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Clases<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url("bogota/matematicas");?>" target="_self">Matemáticas</a></li>
	                        <li><a href="<?php echo base_url("bogota/fisica");?>" target="_self">Física</a></li>
	                        <li><a href="<?php echo base_url("bogota/quimica");?>" target="_self">Química</a></li>
	                        <li><a href="<?php echo base_url("bogota/ingles");?>" target="_self">Inglés</a></li>
	                        <li><a href="<?php echo base_url("bogota/refuerzoescolar");?>" target="_self">Apoyo Escolar</a></li>
	                        <li><a href="<?php echo base_url("bogota/algebra");?>" target="_self">Algebra</a></li>
	                        <li><a href="<?php echo base_url("bogota/calculo");?>" target="_self">Cálculo</a></li>
	                        <li><a href="<?php echo base_url("bogota/estadistica");?>" target="_self">Estadística</a></li>
	                        <li><a href="<?php echo base_url("bogota/contabilidad");?>" target="_self">Contabilidad</a></li>
						</ul>
					</li>
					<li><a href="<?php echo base_url('contactenos'); ?>">Contácto</a></li>
					<li><a href="/blog/">Blog</a></li>
					<li><a href="tel:+573014705463"><span class="glyphicon glyphicon-earphone"></span> 3014705463</a></li>
					<li><a href="<?php echo base_url('login'); ?>">Iniciar Sesión</a></li>
					<li><a href="<?php echo base_url('registro'); ?>">Registrate</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>