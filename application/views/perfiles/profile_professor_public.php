<div class="modal fade in" id="legal_modal" tabindex="-1" role="dialog" aria-labelledby="legalModal" aria-hidden="false" style="display: none;">
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
   			</div>
  		</div>
 	</div>
</div>

<!-- ROW PERFIL -->
<div class="container profile-redux" <?php if(isset($unique)){ echo 'style="margin-top:120px;"';}?>>
	<div class="row perfil-profesor">
		<div class="col-md-6 perfil-profesor-iz">
			<h3 style="color:#009966;" class="title-profesor">PERFIL</h3>
			<div>
            	<?php
					switch($level){
						case 1:	$color = "#4164B3";
								break;
						case 2:	$color = "#38A5CE";
								break;
						case 3:	$color = "#FE544B";
								break;
						case 4:	$color = "#FD931B";
								break;
						case 5:	$color = "#FFC136";
								break;
							
					}
				?>
            
				<img src="<?php echo base_url($picture); ?>" class="img-profile" style="border-color:<?php echo $color;?>">
			</div>
			<div class="estrellas star-profesor">
            
            	<?php
					switch($rate){
						case "0":	echo '<span class="glyphicon glyphicon-star" style="color: grey;"></span>
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span>';
									break;
						case "1":	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span>';
									break;
						case "2":	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
										<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span>';
									break;
						case "3":	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
										<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
										<span class="glyphicon glyphicon-star" style="color: #ffcc00"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span>';
									break;
						case "4":	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
										<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
										<span class="glyphicon glyphicon-star" style="color: #ffcc00"></span> 
										<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
										<span class="glyphicon glyphicon-star" style="color: grey;"></span>';
									break;
						case "5":	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
										<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
										<span class="glyphicon glyphicon-star" style="color: #ffcc00"></span> 
										<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
										<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>';
									break;
					}
				
				?>
				    
			</div>

			<div class="medallas-profesor">
            	<?php
					switch($level){
						case 1:	echo '<img src="assets/img/medallas_old/1_color.png" alt="" >
										<img src="assets/img/medallas_old/2_bn.png" alt="" class="no-medalla">
										<img src="assets/img/medallas_old/3_bn.png" alt="" class="no-medalla">
										<img src="assets/img/medallas_old/4_bn.png" alt="" class="no-medalla">
										<img src="assets/img/medallas_old/5_bn.png" alt="" class="no-medalla">';
								break;
						case 2:	echo '<img src="assets/img/medallas_old/1_color.png" alt="">
										<img src="assets/img/medallas_old/2_color.png" alt="">
										<img src="assets/img/medallas_old/3_bn.png" alt="" class="no-medalla">
										<img src="assets/img/medallas_old/4_bn.png" alt="" class="no-medalla">
										<img src="assets/img/medallas_old/5_bn.png" alt="" class="no-medalla">';
								break;
						case 3: echo '<img src="assets/img/medallas_old/1_color.png" alt="">
										<img src="assets/img/medallas_old/2_color.png" alt="">
										<img src="assets/img/medallas_old/3_color.png" alt="">
										<img src="assets/img/medallas_old/4_bn.png" alt="" class="no-medalla">
										<img src="assets/img/medallas_old/5_bn.png" alt="" class="no-medalla">';
								break;
						case 4:	'<img src="assets/img/medallas_old/1_color.png" alt="">
										<img src="assets/img/medallas_old/2_color.png" alt="">
										<img src="assets/img/medallas_old/3_color.png" alt="">
										<img src="assets/img/medallas_old/4_color.png" alt="">
										<img src="assets/img/medallas_old/5_bn.png" alt="" class="no-medalla">';
								break;
						case 5:	'<img src="assets/img/medallas_old/1_color.png" alt="">
										<img src="assets/img/medallas_old/2_color.png" alt="">
										<img src="assets/img/medallas_old/3_color.png" alt="">
										<img src="assets/img/medallas_old/4_color.png" alt="">
										<img src="assets/img/medallas_old/5_color.png" alt="">';
								break;
							
					}
				?>
            
            
			</div>
			
			<div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" name="userfile" type="file" value="upload" onchange="sub(this)"/></div>
		</div>
		<div class="col-md-6 perfil-profesor-der">
			<h3 style="color:#009966;" class="title-profesor"><?php echo $FirstName." ".$FamilyName?></h3>
			<div id="bio-profesor"><?php echo $profile;?>	
			</div>
		</div>
	</div>


	<!-- Experticia -->


	<div class="row experticia perfil-profesor">
		<h3 class="title-profesor">EXPERTICIA</h3>
		<div class="amigas-separator"></div>
		<div id="areas-wrapper">
        
			<?php 
				for( $i = 0; $i < count($selected_areas) ; $i++){
					echo "<div class=\"numero-competencia\">"."&nbsp;" . ($i+1) . ".&nbsp;"."</div><div class=\"valor-competencia\">".$selected_areas[$i]->Name." - ".$selected_areas[$i]->level."</div><div class=\"public-competencia numero-competencia\"'>&nbsp;&nbsp;</div><br>";
				}
			?>
		</div>
	</div>


	<!-- Videos -->


	<div class="row videos-profesor perfil-profesor">
		<h3 class="title-profesor">VIDEOS</h3>
		<a href="https://www.youtube.com/channel/UCPtXapQsvzIgyYa6Rc50Ikg" target="_blank"><button type="button" class="btn suscribir-btn">Suscribirse</button></a>
		
		<div class="row container-videos">
        
        	<?php
			
			if(count($videos) > 0) {
				foreach ($videos as &$video) {
					?>
					<div class="col-md-4">
						<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe data-id='<?php echo $video["id"]?>' src='<?php echo $video["video_url"]?>' frameborder='0' allowfullscreen></iframe></div>
                    </div>
			<?php		
				}	
			}
			?>
			
		</div>
	</div>

	<!-- Estudios -->

	<div class="row perfil-profesor">
		<h3 class="title-profesor">FORMACIÓN ACADEMICA</h3>

				<div id="exp-wrapper-est">
				<?php 
					for( $i = 0; $i < count($experience) ; $i++){
						if($experience[$i]["type"]==0){ //id for laboral exp 
							continue;
						}
						echo "<div class=\"form-group textarea exp-profesor\" >
								<div class='grid-exp'>Institución: </div> <div class='grid-exp exp-var'>".$experience[$i]["institution"]."</div><br>
								<div class='grid-exp'>Profesión: </div> <div class='grid-exp exp-var'>".$experience[$i]["title"]."</div><br>
								<div class='grid-exp'>Año: </div> <div class='grid-exp exp-var'>".date("Y",strtotime($experience[$i]["from"]))." hasta ".date("Y",strtotime($experience[$i]["to"]))."</div><br>
								<div class=\"amigas-separator\"></div>
							</div>";
					}
				?>
				</div>
			<div class="amigas-separator"></div>
	</div>


	<!-- Experiencia -->


	<div class="row experticia perfil-profesor" style="border-bottom:none;">
		<h3 class="title-profesor">EXPERIENCIA LABORAL</h3>
				<div id="exp-wrapper-pro">
				<?php 
					for( $i = 0; $i < count($experience) ; $i++){
						if($experience[$i]["type"]==1){ //id for educational exp 
							continue;
						}
						echo "<div class=\"form-group exp-profesor\" class=\"col-xs-3\">
								<div class='grid-exp'>Institución: </div><div class='grid-exp exp-var'>".$experience[$i]["institution"]."</div><br>
								<div class='grid-exp'>Titulo: </div><div class='grid-exp exp-var'>".$experience[$i]["title"]."</div><br>
								<div class='grid-exp'>Año: </div><div class='grid-exp exp-var'>".date("Y-m",strtotime($experience[$i]["from"]))." hasta ".date("Y-m",strtotime($experience[$i]["to"]))."</div><br>
								<div class=\"amigas-separator\"></div>
						  	</div>";
					}
				?>
				</div>
			
			<div class="amigas-separator"></div>
	</div>
	<div id="div_agenda" class="row perfil-profesor experticia">
		<h3 class="title-profesor">AGENDA</h3>
		<div class="col-md-12 agenda-profesor">
        	<div>
            <div id="cover_calendar" style="background-color:rgba(0,0,0,0); position: absolute; width: 100%; height: 83%; z-index: 1000;"></div>
			<div class="col-md-offset-1" id="calendar"></div>
            </div>
			<button id="btn-schedule" type="submit" class="btn-schedule btn" onclick="" style="margin-top: 45px; ">Quiero programar mi clase</button>
		</div>
	</div>


			
									


	<div class="container testimonials-ctrl heroes-ctrl " style="display:none;">
		

		<div class="row" style="margin-top:30px;">

			<h3 class="title-profesor" style="margin-bottom:80px;">COMENTARIOS</h3>
			<div class="col-md-6 col-md-offset-3">

					<div class="col-md-12 test-pack comment-pack">
						<div class="col-md-3">
							<div class="container-testimonials-img center-block">
								<img src="<?php echo base_url("application/uploads/test_1.jpg");?>">
							</div>
						</div>
						<div class="col-md-9">
							<h4>
								Hernán Rivera
							</h4>
						</div>
						<div class="col-md-12">
							<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."</p>
						</div>
					</div>


					<div class="col-md-12 test-pack comment-pack">
						<div class="col-md-3">
							<div class="container-testimonials-img center-block">
								<img src="<?php echo base_url("application/uploads/test_1.jpg");?>">
							</div>
						</div>
						<div class="col-md-9">
							<h4>
								Hernán Rivera
							</h4>
						</div>
						<div class="col-md-12">
							<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."</p>
						</div>
					</div>


					<div class="col-md-12 test-pack comment-pack">
						<div class="col-md-3">
							<div class="container-testimonials-img center-block">
								<img src="<?php echo base_url("application/uploads/test_1.jpg");?>">
							</div>
						</div>
						<div class="col-md-9">
							<h4>
								Hernán Rivera
							</h4>
						</div>
						<div class="col-md-12">
							<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."</p>
						</div>
					</div>

					<button type="button" class="btn btn-agregar" style="margin:auto;display:block;width:100%;">Ver mas</button>

			</div>
		</div>

	</div>
</div>	

<div class="amigas-separator"></div>
<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1>Actualizando perfil.</h1>
			</div>
			<div class="modal-body">
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" style="width: 100%;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-centered" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>



<!-- inico login modal -->


<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content popup-iniciar">

      <div class="modal-header">

		INICIA SESIÓN PARA PROGRAMAR TU CLASE

        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

      </div>

      <div class="modal-body">

		<form action="<?php echo base_url('login/log_in'); ?>" method="post" role="form" class="form-horizontal" id="form3">
			<input id="userprofile" name="userprofile" type="hidden" value="<?php echo $userprofile;?>">
			<fieldset>

				<div class="form-group">

					<div class="col-lg-12">

						<label for="txtEmail">Correo electrónico</label>

						<input id="txtEmail" name="txtEmail" type="email" class="form-control" id="" placeholder="Correo electrónico" required>

					</div>

				</div>



				<div class="form-group">
					<div class="col-lg-12">
						<label for="">Contraseña</label>
						<input id="txtPassword" name="txtPassword" type="password" class="form-control" id="" placeholder="Contraseña" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-12">

						<button type="submit"  class="btn-profe btn-login btn col-lg-12 popup-ingresar">Ingresar</button>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-12">

						<a href="<?php echo base_url('login/resetPassword'); ?>" class="text-center" target="_blank">Olvidaste tu contraseña?</a>
					</div>
				</div>

				<div class="form-group">

					<div class="col-lg-12">

						<a href="<?php echo base_url('registro/alumno/') . "?userprofile=" . $userprofile ; ?>" class="btn-estu btn-login btn col-lg-12">Regístrarme</a>

					</div>

				</div>

				<div class="form-group">     

					<div class="text-center"><label for="">ó inicia con tu cuenta de</label></div>

					<div class="col-lg-12">

						<a href="<?php echo $sLoginGoogle ?>"class="btn btn-google btn-login col-md-12">Google</a>

					</div>

				</div>

				<div class="form-group">

					<div class="col-lg-12">

						<a href="<?php echo $sLoginFacebook; ?>"class="btn btn-facebook btn-login col-md-12">facebook</a>

					</div>

				</div>

			</fieldset>

		</form>

      </div>

      <div class="modal-footer">

        

      </div>

    </div>

  </div>
</div>

<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h1>Programando tu clase...</h1>

			</div>

			<div class="modal-body">

				<div class="progress">

					<div class="progress-bar progress-bar-striped active" style="width: 100%;"></div>

				</div>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

			</div>

		</div>

	</div>

</div>

<!-- fin login modal -->



<!--  fin datos modal -->

<div class="modal fade" id="agendar" tabindex="-1" role="dialog" aria-labelledby="agendar" aria-hidden="true">

	<div class="modal-dialog">

	    <div class="modal-content popup-iniciar">

			<div class="modal-header">
				AGENDAR PROFESOR
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

			</div>

			<div class="modal-body">

		      	<form action="" method="GET">
					
					<!--Tema especifico-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="topic_form">Escribe la Tem&aacute;tica que Requieres:</label>
							<input type="text" name="topic_form" id="topic_form" class="form-control col-md-9" placeholder="Ej: Factorización" value="">
						</div>
							<div id="topic_form_error" class="error">
					</div>
					
					<!--Nivel especifico-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="level_form">Escoge el nivel de la clase:</label>
							<select name="level_form" id="level_form" class="form-control col-md-9">
								<option value="0">Nivel</option>
								<?php 
									foreach ($levels as $key => $value) {
								?> 
									<option value="<?php echo $value['id'];?>" <?php if($value['id']==$level){echo "selected";}?>>
										<?php echo utf8_decode($value['name']); ?>
									</option> 
								<?php
									}
								?>      
							</select>
						</div>
							<div id="level_form_error" class="error"></div>
					</div>

					<!--Ciudad: este campo se trae desde la base de amigas-->
					<div class="row">
                    
						<div class="col-md-12 txt-busqueda">
							<label for="city_form">En qu&eacute; Ciudad Quieres Tomar la Clase?:</label>
							<select name="city_form" id="city_form" class="form-control col-md-9">
								<option value="0">Ciudad</option>
								<?php 
									$cities = json_decode($cities, true);
									$cities = json_decode($cities['cities'], true);
									foreach ($cities as $key => $value_cities) {
								?> 
									<option value="<?php echo $value_cities['ID'];?>">
										<?php echo utf8_decode($value_cities['Name']); ?>
									</option> 
								<?php
									}
								?>      
							</select>
						</div>
							<div id="city_form_error" class="error"></div>
					</div>

					<!--Tema especifico-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="address_form">Escribe la Direcci&oacute;n Donde vas a Tomar la Clase:</label>
							<input type="text" name="address_form" id="address_form" class="form-control col-md-9" value="">						
						</div>
							<div id="address_form_error" class="error"></div>
					</div>
					
					<!--Teléfono-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="phone_form">Escribe tu tel&eacute;fono:</label>
							<input type="text" name="phone_form" id="phone_form" class="form-control col-md-9" value="">						
							
						</div>
						<div id="phone_form_error" class="error"></div>
					</div>
					
					<!--Boton buscar que ejecuta la consulta-->
					<div class="row">
						<div class="col-md-12">
							<label for=""></label>
							<input id="btAgendar" type="button" class="btn-busqueda-profe btn-profe btn col-lg-12 busqueda_b" value="Agendar Profesor">
						</div>
					</div>
				</form>
	      	</div>
	    	<div class="modal-footer"></div>
	    </div>
  	</div>
</div>


<!--  fin datos modal -->






<?php echo "<script>
		base_url = '".base_url()."';
		var id_user = '".$id_user."';
		var id_area = ". $selected_areas[0]->id_area . ";
		$(document).ready(function(){
			//$(\"iframe#video_profe\").attr('src','".$youtube."')
		})</script>";
?>
<link rel='stylesheet' href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>"></link>
<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />
<script src="<?php echo base_url("assets/js/datepicker/js/bootstrap-datepicker.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/fullcalendar.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lang/es.js");?>"></script>
<script src="<?php echo base_url("assets/js/profile_public.js");?>"></script>
<script>

function getUrlVars()
{
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value){
		vars[key] = value;});
	return vars;
}

$(document).ready(function(){
	
 	var to_div = getUrlVars()["div"];	
	
	
	if(to_div) {
		$('html,body').animate({
		   scrollTop: $("#" + to_div).offset().top
		});
	}
	
});


$(".redondo").css("border-radius","10px")
$("span#terminos a").css("cursor","pointer");
$("span#terminos a").mousedown(function(event) {
	$("#legal_modal").fadeIn('500');
});
$(".close").mousedown(function(event) {
	$("#legal_modal").css("display","none")
});
$('[data-toggle="tooltip"]').tooltip();
</script>