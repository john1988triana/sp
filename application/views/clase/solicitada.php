<?php setlocale(LC_ALL ,"es_CO");?>
<section class="container" style="margin-top:100px">
	<br><br><h1 class="text-center asi-funciona"><span style="color: rgb(0, 184, 92);">TU SOLICITUD HA SIDO ENVIADA CON EXITO.</span></h1>
	<div class="col-md-12 div-area">
	
	<!--<div class="col-md-6">
		<div class="panel-default panel-perfil">                                            
				<h3 class="text-center tt-txt-panel-perfil" style="color:#009966;"><?php echo $teacher["FirstName"]; ?>  <?php echo $teacher["FamilyName"]; ?></h3>
			<div class="panel-body text-center">
				<img class="img-profile" style="margin: 0px auto;" src="<?php echo base_url($teacher["picture"]); ?>">
				
				<h4 class="par txt-panel-perfil">Ciudad: <?php echo $request["city"] ?></h4>      
				<h4 class="par txt-panel-perfil">Area: <?php echo $request["area"] ?></h4>
				<h4 class="par txt-panel-perfil">precio: <span style="color:#00B85C;"><?php echo "$".($request["price_public"] + $request["price_sp"])?></span></h4>
			</div>
		</div>
	</div>-->

	<div class="col-md-12">	
		<h4 class="text-center">Tu solicitud de clase para el <?php echo date("l,d F Y",strtotime($request["start"]));?> a las <?php echo date("h:i a",strtotime($request["start"]));?> ha sido enviada al profesor:  <h4 class="text-center" style="color:#009966;"><?php echo $teacher["FirstName"]; ?>  <?php echo $teacher["FamilyName"]; ?>.</h4> <h4 class="text-center">En menos de 4 horas te enviaremos un correo confirmando tu clase. Si tienes alguna inquietud escríbenos a <span style="color: rgb(0, 184, 92);">hola@superprofe.co</span> ó llámanos al <span style="color: rgb(0, 184, 92);">301 470 5463.</span></h4>
		<h4 class="text-center">Recuerda que el valor total de la sesión de la clases es de: <span style="color:#00B85C;"><?php echo "$".($request["price_public"] + $request["price_sp"])?></span></h4>
		<img class="img-gracias" style="display:block;margin:auto;"src="<?php echo base_url("assets/img/gracias.jpg");?>">
	</div>
	</div>
</section>