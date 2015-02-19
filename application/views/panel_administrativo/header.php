<!-- Fixed navbar --><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<?php if(isset($headers)){
		foreach($headers as $name => $content) {?>
			<meta name="<?php echo $name; ?>" content="<?php echo $content; ?>">
		<?php } 
	} ?>
	<link rel="icon" href="<?php echo (base_url('assets/img/logo_superprofe.ico')); ?>">
	<?php if(isset($title)): ?>
		<title><?echo $title;?></title>
	<? else: ?>
		<title>Profesores y clases Particulares a Domicilio en Bogotá - Encuentra el Profesor que Necesitas Aquí</title>
	<?endif; ?>
	<!-- Bootstrap core Less -->
	<link href="<?php echo (base_url('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo (base_url('assets/css/landing-superprofe.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/sweet-alert.css")?>"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo (base_url('assets/js/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo (base_url('assets/js/bootstrap-hover-dropdown.js')); ?>"></script>
    <script src="<?php echo (base_url('assets/js/sweet-alert.min.js')); ?>"></script>
	
</head>






<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo base_url('administrador'); ?>"><img src="<?php echo base_url('assets/img/logo_superprofe.svg'); ?>">Super<span>Profe</span>.co</a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Menu</span>
			</button>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav nav-pills pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Clases<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url("administrador/clases/nueva")?>">Nueva</a></li>
						<li><a href="<?php echo base_url("administrador/clases/solicitadas")?>">Solicitadas</a></li>
						<li><a href="<?php echo base_url("administrador/clases/programadas")?>">Programadas</a></li>
						<li><a href="<?php echo base_url("administrador/clases/finalizadas")?>">Finalizadas</a></li>
						<li><a href="<?php echo base_url("administrador/clases/pagadas")?>">Pagadas</a></li>
                        <li><a href="<?php echo base_url("administrador/clases/canceladas")?>">Canceladas</a></li>
						<li><a href="<?php echo base_url("administrador/clases/seguimiento")?>">Seguimiento</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profesores<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url("administrador/profesores/proceso")?>">En Proceso</a></li>
						<li><a href="<?php echo base_url("administrador/profesores/agendados")?>">Agendados</a></li>
						<li><a href="<?php echo base_url("administrador/profesores/perfiles")?>">Perfiles</a></li>
						<li><a href="<?php echo base_url("administrador/profesores/seguimiento")?>">Seguimiento</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Estudiantes<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url("administrador/estudiantes/perfiles")?>">Perfiles</a></li>
						<li><a href="<?php echo base_url("administrador/estudiantes/reportes")?>">Reportes</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Facturación<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url("administrador/facturacion/cobrar")?>">Cuentas por Cobrar</a></li>
						<li><a href="<?php echo base_url("administrador/facturacion/reportes")?>">Reportes</a></li>
					</ul>
				</li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Estadisticas<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url('login/logout'); ?>">Solicitadas</a></li>
						<li><a href="<?php echo base_url('login/logout'); ?>">Programadas</a></li>
						<li><a href="<?php echo base_url('login/logout'); ?>">Finalizadas</a></li>
						<li><a href="<?php echo base_url('login/logout'); ?>">Seguimiento</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Promociones<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url('administrador/promociones/nueva'); ?>">Generar Codigo</a></li>
						<li><a href="<?php echo base_url('administrador/promociones/lista'); ?>">Ver Codigos</a></li>
					</ul>
				</li>
				
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>


<script> $('.dropdown-toggle').dropdownHover(); </script>

