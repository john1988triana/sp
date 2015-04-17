<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">
			<title><?= $title; ?></title>
			<meta name="description" content="Profesores Particulares para Clases Virtuales y a Domicilio para Refuerzos y Preparación de Exámenes. Aquí  los encuentras rápido, fácil y seguro!">
		<!-- Bootstrap core Less -->
		<link href="<?php echo (base_url('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo (base_url('assets/css/landing-superprofe.css')); ?>" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="<?php echo base_url("assets/css/sweet-alert.css")?>">
	    
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="<?php echo (base_url('assets/js/bootstrap.min.js')); ?>"></script>
	    <script src="<?php echo (base_url('assets/js/sweet-alert.min.js')); ?>"></script>
	</head>
	<body class="fondo_error">
		<div class="container">
			<div class="col-md-6 text-center">
				<h2 class="cod_title"><?= $code; ?></h2>
				<hr id="separador-busqueda"></hr>
				<h4><?= $content; ?></h4><br>
				<h3 style="font-size:2.5em;"><strong>Encuentra el Profesor<br>que Necesitas</strong></h3><br>
				<a class="btn-ingresa-aqui btn" href="<?php echo base_url("busqueda"); ?>"><div>Ingresando Aquí</div></a>

		</div>

		</div>
			
	</body>
</html>
