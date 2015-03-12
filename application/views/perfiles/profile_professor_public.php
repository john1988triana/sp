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
<div class="container" <?php if(isset($unique)){ echo 'style="margin-top:120px;"';}?>>
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
	<div class="row perfil-profesor experticia">
		<h3 class="title-profesor">AGENDA</h3>
		<div class="col-md-12 agenda-profesor">
			<div class="col-md-offset-1" id="calendar"></div>
			<button type="submit" class="btn-schedule btn" onclick="" style="margin-top: 45px; display:none;">Programar mi clase</button>
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


<?php echo "<script>
		base_url = '".base_url()."';
		id_user = '".$id_user."';
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