<section class="container" style="margin-top:100px">
	<br><br><h1 class="text-center asi-funciona"><span style="color: rgb(0, 184, 92);">TU CLASE HA SIDO CANCELADA.</span></h1>
	<div class="col-md-12 div-area">
	<div class="col-md-4">
		<div class="panel-default panel-perfil">                                            
				<h3 class="text-center" style="color:#009966;"><?php echo $teacher["FirstName"]; ?>  <?php echo $teacher["FamilyName"]; ?></h3>
			<div class="panel-body text-center">
				<img class="img-profile" style="margin: 0px auto;" src="<?php echo base_url($teacher["picture"]); ?>">
				
				<h4 class="par">Ciudad: <?php echo $request["city"] ?></h4>      
				<h4 class="par">Area: <?php echo $request["area"] ?></h4>
				<h4 class="par">precio: <span style="color:#00B85C;"><?php echo "$".($request["price_public"]  + $request["price_sp"])?></span></h4>
			</div>
		</div>
	</div>
	<div class="col-md-6">
	<h1>Hola <?php echo $request["pFName"]." ".$request["pLName"];?></h1>
	<p>Has cancelado tu clase, por favor revisa y ajusta tu horario, por que tenias disponibilidad en la hora solicitada.
	</p>
	<p>
	Ayúdanos a brindar el mejor servicio a nuestros estudiantes!
	</p>
	<p>
	Que tengas un excelente día
	</p>
	</div>
</section>
 
 
 
 