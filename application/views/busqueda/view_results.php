<section class="container" id="results-section">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12 alert text-center mensaje-busqueda-realizada"><p style="font-weight: bold;"><?php echo $message; ?></p></div>
		</div>                                      

		 <!--Resultados de la búsqueda que se recibe por medio de los parametros area, tema y ciudad-->
			<?php for ($i = 0 ; $i <=count($results); $i++) { ?>			
				<?php if($i == 0) :?>
                
                	<div class="col-md-3">
                        <div class="panel-default panel-perfil panel-perfil center-block">                                            
                        <h3 class="text-center tt-txt-panel-perfil" style="color:#009966;">Quieres que </br>escojamos por Ti?</h3>
                            <div class="panel-body text-center">
                                <img class="img-profile" style="margin: 0px auto;" src="<?php echo base_url("assets/img/Superprofe.jpg"); ?>">
                                <div class="estrellas">
                                    <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
                                    <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                                    <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                                    <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                                    <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>    
                                </div>
                                <div class="medallas-profesor">
                                    <img src="<?php echo base_url("assets/img/medallas/1.svg");?>" alt="">
                                    <img src="<?php echo base_url("assets/img/medallas/2.svg");?>" alt="">
                                    <img src="<?php echo base_url("assets/img/medallas/3.svg");?>" alt="">
                                    <img src="<?php echo base_url("assets/img/medallas/4.svg");?>" alt="">
                                    <img src="<?php echo base_url("assets/img/medallas/5b.svg");?>" alt="" class="no-medalla">
                                </div>
                                <h3 class="medalla-tag">Experto</h3>
        
                                <h4 class="par txt-panel-perfil">Seleccionaremos el mejor</h4>  
                                <h4 class="par txt-panel-perfil">SuperProfe para ti.</h4>    
                                <h4 class="par txt-panel-perfil"></h4>
                                <h4 class="par txt-panel-perfil">Precio: <span style="color: rgb(0, 184, 92);">  Desde $ 25.000 </span></h4>
                            </div>
                            <div onclick="requestClass();" class="cta-perfil-profesor"><h3>Escojan por Mi</h3></div>
                        </div>
                    </div>
                
                
				<?php else: ?>
					<?php if($i == 4): ?>
						<div><div class="btn-estu btn col-lg-12 ver_perfil txt-panel-perfil" onclick="$('#more').show();$(this).hide();">Ver más</div></div>
						<div id="more" style="display:none;">
					<?php endif; ?>
                    
                    
                    <div class="col-md-3">
                        <div class="panel-default panel-perfil panel-perfil center-block">                                            
                        <h3 class="text-center tt-txt-panel-perfil" style="color:#009966;"><?php echo $results[$i-1]->firstName; ?>  <?php echo $results[$i-1]->lastName; ?></h3>
                            <div class="panel-body text-center">
                            	<?php
									switch($results[$i-1]->level){
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
                            
                                <img class="img-profile" style="margin: 0px auto; border-color:<?php echo $color;?>" src="<?php echo base_url($results[$i-1]->picture); ?>">
                                <div class="estrellas <?php echo $results[$i-1]->id;?>">
                                	<?php
										switch($results[$i-1]->rate){
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
																<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
																<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
																<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>';
														break;
										}
									
									?>
                                
                                
                                    
                                </div>
                                <div class="medallas-profesor">
                                	<?php
										switch($results[$i-1]->level){
											case 1:	echo '<img src="assets/img/medallas/1.svg" alt="" >
															<img src="assets/img/medallas/2b.svg" alt="" class="no-medalla">
															<img src="assets/img/medallas/3b.svg" alt="" class="no-medalla">
															<img src="assets/img/medallas/4b.svg" alt="" class="no-medalla">
															<img src="assets/img/medallas/5b.svg" alt="" class="no-medalla">';
													break;
											case 2:	echo '<img src="assets/img/medallas/1.svg" alt="" >
															<img src="assets/img/medallas/2.svg" alt="">
															<img src="assets/img/medallas/3b.svg" alt="" class="no-medalla">
															<img src="assets/img/medallas/4b.svg" alt="" class="no-medalla">
															<img src="assets/img/medallas/5b.svg" alt="" class="no-medalla">';
													break;
											case 3: echo '<img src="assets/img/medallas/1.svg" alt="" >
															<img src="assets/img/medallas/2.svg" alt="">
															<img src="assets/img/medallas/3.svg" alt="">
															<img src="assets/img/medallas/4b.svg" alt="" class="no-medalla">
															<img src="assets/img/medallas/5b.svg" alt="" class="no-medalla">';
													break;
											case 4:	'<img src="assets/img/medallas/1.svg" alt="" >
															<img src="assets/img/medallas/2.svg" alt="">
															<img src="assets/img/medallas/3.svg" alt="">
															<img src="assets/img/medallas/4.svg" alt="">
															<img src="assets/img/medallas/5b.svg" alt="" class="no-medalla">';
													break;
											case 5:	'<img src="assets/img/medallas/1.svg" alt="" >
															<img src="assets/img/medallas/2.svg" alt="">
															<img src="assets/img/medallas/3.svg" alt="">
															<img src="assets/img/medallas/4.svg" alt="">
															<img src="assets/img/medallas/5.svg" alt="">';
													break;
												
										}
									?>

                                </div>
                                <h3 class="medalla-tag"><?php
														switch($results[$i-1]->level){
															case 1:	echo "Junior";
																	break;
															case 2:	echo "Profesional";
																	break;
															case 3:	echo "Master";
																	break;
															case 4:	echo "Experto";
																	break;
															case 5:	echo "Elite";
																	break;
																
														}
													?></h3>
        
                                <h4 class="par txt-panel-perfil">Ciudad: <?php foreach($cities as $city){if($city->ID == $this->input->get("city"))echo utf8_decode($city->Name);break;}?></h4>  
                                <h4 class="par txt-panel-perfil">Area: <?php foreach($areas as $a)if($a->IdArea == $this->input->get("area")){echo $a->Name;break;}  ?></h4>    
                                <h4 class="par txt-panel-perfil">Precio: <span style="color:#00B85C;"><?php echo "$".($results[$i-1]->fee_sp + $results[$i-1]->price)?></span></h4>
                            </div>
                            <div onclick="<?php echo "refreshTeacherDetail('".($results[$i-1]->id_user)."','".$results[$i-1]->firstName."','".$results[$i-1]->lastName."','".$results[$i-1]->picture."',".$results[$i-1]->rate.",'".($results[$i-1]->price+$results[$i-1]->fee_sp)."','".$results[$i-1]->City."')" ?>" class="cta-perfil-profesor"><h3>Ver perfil</h3></div>
                        </div>
                    </div>
                   
                    
                    		
					<?php if($i >= 3 && $i == count($results)): ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php } ?>	
	</div>	

</section>

<div class="row" style="display:none" id="tip-teacher">

	<div class="col-md-12 alert text-center mensaje-busqueda-realizada"><p style="font-weight: bold;">Revisa el perfil del Profesor y SI decides tomar clase con él mas abajo encontrarás el bóton  "Programar mi Clase" para que puedas agendarla.</p></div>

</div>

<hr id="separador-busqueda" style="margin-bottom:0px;"></hr>

<section class="container" id="teacher-detail" style="display:none">

	<div class="col-md-4" style="border-right-style: dashed;border-right-width: 2px;">

		<h3 class="text-center" id="detail-name" style="color:#009966;"></h3>

		<div class="panel-body text-center">

			<img class="img-profile" id="detail-image" style="margin: 0px auto;" src="">

			<div class="estrellas" id="detail-stairs">

				<span class="glyphicon glyphicon-star"></span>

				<span class="glyphicon glyphicon-star"></span> 

				<span class="glyphicon glyphicon-star"></span> 

				<span class="glyphicon glyphicon-star"></span> 

				<span class="glyphicon glyphicon-star"></span>    

			</div>


			<h4 class="par" id="detail-city">Ciudad:</h4>      

			<h4 class="par" id="detail-area">Area: </h4>

			<h4 class="par" id="detail-price">precio: <span style="color:#00B85C;"></span></h4>

			<h3 class="text-center" style="color:#009966;">PERFIL</h3>

			<p id="detail-profile"></p>

		</div>

	</div>

	<div class="col-md-8">

		<h3 class="text-center" style="color:#009966;">FORMACIÓN ACADEMICA
			<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Estos son los estudios que tiene este profesor"></span>
		</h3>


		<p id="detail-studies"></p>

		<h3 class="text-center" style="color:#009966;">EXPERIENCIA LABORAL
			<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Esta es la experiencia laboral que tiene este Profesor"></span>
		</h3>

		<p id="detail-exp"></p>

	</div>

</section>

<hr id="separador-busqueda" style="margin-top:0px;"></hr>


<section class="container" id="teacher-availability" style="display:none">

	<div class="col-md-5">

		<span class="calendar-instructions">Arrasta el cuadro verde para ajustar la hora de clase. Recuerda que debes moverlo en los espacios disponibles del profesor</span>
		<a data-toggle="modal" data-target="#video_modal" href="">
			<span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="En este video puedes ver un ejemplo de como se selecciona la clase"></span>
		</a>

		<div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Como agendar tu clase </h4>
					</div>
					<div class="modal-body">
						<!--<iframe width="100%" height="400" src="//www.youtube.com/embed/x97biL1lKBE" frameborder="0" allowfullscreen></iframe>-->

						<iframe width="100%" height="400" src="assets/media/agendar_clase.mp4" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div> 
		<div id="calendar"></div>

		<div class="legend">

			<div style="float:left;"><div class="black-square"></div>No Disponible</div>

			<div style="float:left;"><div class="white-square"></div>Disponible</div>

			<div style="float:left;"><div class="green-square"></div>Clase</div>

		</div>

	</div>

	<div class="col-md-7">

		<div class="promo-section">

			

			<h4 style="text-align:center;">Si tienes un código promocional digítalo aquí:</h4>

			<div style="width:330px;margin:auto;"><span class="glyphicon glyphicon-question-sign prf" data-toggle="tooltip" data-placement="right" title="Si no tienes codigo de Aulas Amigas deja este espacio en blanco"></span><input class="promo-code" type="text"></input></div>

			<div class="clearfix"></div>

			<button type="submit" class="btn-schedule btn" onclick="saveClass();">Programar mi clase</button>
			
			<!--<div class="row" style="display:none">-->
			<div class="row">
				<div class="col-md-12 alert text-center mensaje-busqueda-realizada">
					<p style="font-weight: bold;">Te enviaremos un correo con la confirmación y agendamiento de la clase.</p>
				</div>
			</div>
			<!--</div>-->

		</div>

	</div>

</section>

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content popup-iniciar">

      <div class="modal-header">

		INICIAR SESIIÓN

        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

      </div>

      <div class="modal-body">

		<form action="<?php echo base_url('login/log_in'); ?>" method="post" role="form" class="form-horizontal" id="form3">

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

						<button type="submit"  class="btn-profe btn-login btn col-lg-12 popup-ingresar">Ingresar</a>

					</div>

				</div>

				<div class="form-group">

					<div class="col-lg-12">

						<a href="<?php echo base_url('login/resetPassword'); ?>" class="text-center" target="_blank">Olvidaste tu contraseña?</a>

					</div>

				</div>

				<div class="form-group">

					<div class="col-lg-12">

						<a href="<?php echo base_url('registro'); ?>" class="btn-estu btn-login btn col-lg-12">Regístrarme</a>

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

<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />

<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>

<script src="<?php echo base_url("assets/js/calendar/fullcalendar.min.js");?>"></script>

<script src="<?php echo base_url("assets/js/calendar/lang/es.js");?>"></script>

<script>

$(document).ready(function(){

	$("html, body").animate({ scrollTop: $('#results-section').offset().top }, 1000);

	$('[data-toggle="tooltip"]').tooltip();

});

	var request ={};

	function isOverlapping(event){

		var array = $('#calendar').fullCalendar('clientEvents');

		for(i in array){

			if(array[i]._id != event._id){

				var start= array[i].start;

				var end = array[i].end;

				var estart = event.start;

				var eend = event.end;

				if(!(start.format() > eend.format() || end.format() < estart.format())){

					return true;

				}

			}

		}

		return false;

	}

	function requestClass(){
		
		var base_url = "<?php echo base_url(); ?>";
		
		var _start_date = new moment("<?php echo $this->input->get("date"); ?>","DD-MM-YYYY").hour(<?php echo $this->input->get("time"); ?>);
		
		var _end_date = new moment(_start_date).add(2,'h')
		
		//$("#pleaseWaitDialog").modal();
		var data = {
			"id":"<?php echo $req_id; ?>",
			"address":request.address,
			"city":request.city,
			"id_area":request.id_area,
			"id_professor":"-1",
			"price":"25000",
			"topic":request.topic,
			"phone":request.phone,
			"status":2,
			"end":_end_date.format("YYYY-MM-DD, HH:mm:ss"),
			"start":_start_date.format("YYYY-MM-DD, HH:mm:ss"),
		};
		
		$.post(base_url+"busqueda/guardar",data,function(resp){
			var info = JSON.parse(resp);
			if(!info){
				$("#pleaseWaitDialog").modal("hide");
				$("#login").modal();
			}else{
				window.location.href=base_url+"clase/solicitar/<?php echo $req_id; ?>";
			}

		});
		

	}

	function refreshTeacherDetail(id,firstName,lastName,image,rate,price,city,date){

		request.id_professor = id;

		request.price = price;

		request.id_area = <?php echo $this->input->get("area") ?>;

		request.city = <?php echo $this->input->get("city") ?>;

		request.address = "<?php echo $this->input->get("address") ?>";

		request.topic = "<?php echo $this->input->get("topic") ?>";

		var auto = <?php echo $auto ?>;

		var base_url = "<?php echo base_url(); ?>";

		var date = new moment("<?php echo $this->input->get("date"); ?>","DD-MM-YYYY").hour(<?php echo $this->input->get("time"); ?>);

		var week = new moment("<?php echo $this->input->get("date"); ?>","DD-MM-YYYY").startOf('week');

		$("#teacher-availability").show(500);

		$("#tip-teacher").show();

		$("#teacher-detail").show(10,function(){

			$("html, body").animate({ scrollTop: $('#tip-teacher').offset().top-80 }, 1000);

		});

		$("#detail-name").html(firstName +" "+lastName);

		$("#detail-image").attr("src",base_url+image);

		$("#detail-area").html("Area: "+$("#area option:selected").text());

		$("#detail-city").html("Area: "+city);

		$("#detail-price").html("Precio: "+price);

		$.get(base_url+"perfil/experiencia/"+id,function(resp){

			var exp = JSON.parse(resp);

			$("#detail-exp").html("");

			$("#detail-studies").html("");

			for(var i in exp){

				var experience = exp[i];

				var div = "<div class=\"form-group\" class=\"col-xs-3\">"+

					"<h5>Institución: <b>"+experience.institution+"</b></h5>"+

					"<h5>Titulo: <b>"+experience.title+"</b></h5>"+

					"<h5>Año: <b>"+experience.from+" hasta "+experience.to+"</b></h5>"+

					"<div class=\"amigas-separator\"></div>"+

				"</div>";

				if(experience.type == 0){

					$("#detail-exp").append(div);

				}else{

					$("#detail-studies").append(div);

				}

			}

		});

		$.get(base_url+"perfil/info/"+id,function(resp){

			var info = JSON.parse(resp);

			$("#detail-profile").text(info.profile);

		});

		$.get(base_url+"perfil/disponibilidad/"+id,function(resp){

			var freeList = JSON.parse(resp);

			$.get(base_url+"perfil/ajaxClases/"+id+"/"+date.unix(),function(resp){

				var classList = JSON.parse(resp);

				var busyList = [];

				for(var i = 0 ; i < 7 ;i++){

					busyList.push({id:i-1,title:"No disponible",color:"#000",editable:false,

					start: (new moment(week)).hour(7).add(i,'d'),end: (new moment(week)).hour(21).add(i,'d')})

				}

				/** This function inverts the free to busy lapses it initially it suposes the full 

				*	week is busy then removes the lapses of "free" time

				*/

				function splitBusy(day,start,end){

					var l = busyList.length;

					for(var i = 0 ; i<l ; i++){

						if(busyList[i].start.day() == start.day()){

							var toSplit = busyList[i];

							if(toSplit.start >= start && toSplit.end > end){

								//move begining to the end of end

								toSplit.start.hour(end.hour());

							}else if(toSplit.end <= end && toSplit.start < start){

								//move the end to the begining of start

								toSplit.end.hour(start.hour());

							}else if(toSplit.start < start && toSplit.end > end){

								//split in two

								busyList.push({id:busyList.length,

									title:"No disponible",

									color:"#000",

									start: new moment(end),

									end: new moment(toSplit.end),

									editable:false

									})

								toSplit.end.hour(start.hour());

							}else{

								busyList.splice(i,1);

							}

							break;

						}

					}

				}

				for(var i = 0 ; i < freeList.length ;i++){

					var sday = freeList[i].start_day == 0 ? 7: freeList[i].start_day;

					var eday = freeList[i].end_day == 0 ? 7: freeList[i].end_day;

					freeList[i].id = i;

					freeList[i].title = "Disponible";

					freeList[i].start = new moment(week).add(sday-1,"d").add(freeList[i].start_time,"h");

					freeList[i].end = new moment(week).add(eday-1,"d").add(freeList[i].end_time,"h");

					splitBusy(sday,freeList[i].start,freeList[i].end);

				}

				if(auto){ //auto is true when there is no direct match on the time the user request

					date = freeList[0].start;

				}

				for(var i = 0 ; i < classList.length ;i++){

					busyList.push({

						id:busyList.length,

						title:"Agendado",

						editable:false,

						start:new moment(classList[i].start),

						end:new moment(classList[i].end)

					});

				}

				var e = {id:-2,	start:date,end:new moment(date).add(2,'h'),title:"clase",editable:true,color:"#009966"}; // class event object
				
				var overE = false;
				
				for(var i = 0 ; i< busyList.length ; i++){
					if(!(busyList[i].start.format() >= e.end.format() || busyList[i].end.format() <= e.start.format() )){
						overE = true;
					}
				}
				
				if(overE == false)
				{
					busyList.push(e);
					request.start = date;
					request.end = new moment(date).add(2,"h");
				}
				
				/*
				for(var i = 0 ; i< busyList.length ; i++){

					if(!(busyList[i].start.format() >= e.end.format() || busyList[i].end.format() <= e.start.format())){

						if(busyList[i].start.hours()>9){

							e.start = new moment(busyList[i].start).add(-2,'h');

							e.end = new moment(busyList[i].start);

						}else if(busyList[i].end.hours()<18){

							e.start = new moment(busyList[i].end);

							e.end = new moment(busyList[i].end).add(2,'h');

						}

					}

				}
				*/


				$('#calendar').fullCalendar("removeEvents");

				$('#calendar').fullCalendar({

					header:{left:"",center:"",right:""},

					firstDay:1,

					lang:"es",

					allDaySlot:false,

					slotDuration:"01:00:00",

					axisFormat:'h(:mm)a',

					minTime:"07:00:00",

					maxTime:"21:00:00",

					height:"auto",

					defaultView: 'agendaWeek',

					defaultDate: week,

					eventColor:"#003333",

					selectable: true,

					editable: true,

					selectOverlap: false,

					slotEventOverlap : false,
					
					eventDrop: function( event, delta, revertFunc, jsEvent, ui, view ) {
						
						var today = moment();
   						var tomorrow = today.add('days', 1);
						tomorrow.startOf('day');
						
						var start_date = moment(event.start.format("DD:MM:YYYY"), "DD:MM:YYYY");
						
						var start_time = moment(event.start.format("HH:mm:ss"), "HH:mm:ss");
						var end_time = moment(event.end.format("HH:mm:ss"), "HH:mm:ss");
						
						var min_time = moment("07:00:00", "HH:mm:ss");
						var max_time = moment("21:00:00", "HH:mm:ss");
						
						if(start_date < tomorrow)
						{
							swal({
								title: "Error!",
								text: "El día de la clase no puede ser pasada, ni ser hoy.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						if((start_time < min_time) || (start_time > end_time)) {
							swal({
								title: "Error!",
								text: "La clase debe iniciar mínimo a las 7:00 am.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						else if((end_time > max_time) || (start_time > end_time)) {
							swal({
								title: "Error!",
								text: "La clase debe terminar máximo a las 9:00 pm.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						else if (isOverlapping(event)) {
                            revertFunc();
                        }else{
							request.start = event.start;
							if(event.end){
								request.end = event.end;
							}
						}
					},
					
					eventResize: function(event, delta, revertFunc) {
						
						var start_time = moment(event.start.format("HH:mm:ss"), "HH:mm:ss");
						var end_time = moment(event.end.format("HH:mm:ss"), "HH:mm:ss");
						
						if(end_time.subtract(start_time).hours() <= 1)
						{
							swal({
								title: "Error!",
								text: "La clase debe ser de mínimo dos (2) horas.",
								type: "error",
								confirmButtonText: "Aceptar" });
							revertFunc();
						}
						else if (isOverlapping(event)) {

                            revertFunc();

                        }else{

							request.start = event.start;

							if(event.end){

								request.end = event.end;

							}

						}

					}

				});

				for(var i in busyList){

					$('#calendar').fullCalendar("renderEvent",busyList[i]);

				}

			});

		});

		for(var i=0; i < Math.round(rate); i++){				

			$("#detail-stairs span:nth-child("+(i+1)+")").css("color","#FFCC00");

		}

	}

	function saveClass(){

		var base_url = "<?php echo base_url(); ?>";

		$("#pleaseWaitDialog").modal();

		var data = {

			"id":"<?php echo $req_id; ?>",

			"address":request.address,

			"city":request.city,

			"end":request.end.format("YYYY-MM-DD, HH:mm:ss"),

			"start":request.start.format("YYYY-MM-DD, HH:mm:ss"),

			"id_area":request.id_area,

			"id_professor":request.id_professor,

			"price":request.price,

			"topic":request.topic,

			"phone":request.phone

		};

		$.post(base_url+"busqueda/guardar",data,function(resp){

			var info = JSON.parse(resp);

			if(!info){

				$("#pleaseWaitDialog").modal("hide");

				$("#login").modal();

			}else{

				window.location.href=base_url+"clase/solicitar/<?php echo $req_id; ?>";

			}

		});

	}

</script>