<div style="margin-top:110px">
	<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist">
	<?php $actual = 0;
	foreach($classes as $class){
		if($class["status"] != $actual){
			foreach($states as $state){
				if($state["id"] == $class["status"]){
					echo '<li role="'.$state["name"].'" ';
					if($actual==0){
						echo 'class="active"';
					}
					echo '><a href="#'.$state["name"].'" aria-controls="'.$state["name"].'" role="tab" data-toggle="tab">'.$state["name"].'</a></li>';
				}
			}
			$actual = $class["status"];
		} 
	}
	?>
	</ul>
	</div>
	<div class="tab-content">
	<?php
		$actual = 0;
		foreach($classes as $class){
			if($class["status"] != $actual){
				foreach($states as $state){
					if($state["id"] == $class["status"]){
						if($actual!= 0){
							echo '</div>';
						}
						echo '<div role="tabpanel" class="tab-pane active" id="'.$state["name"].'"><h4>'.$state["name"].'</h4>';
						$actual = $class["status"];
						break;
					}
				}
			}
			?>
			<div class="well center-block">
				<div class="panel panel-default" style="position:relative;">
					<div class="panel-heading">
						<h6><?php echo $class["pFName"].' '.$class["pLName"].' - '.$class["topic"];?></h6>
						<?php if($class["status"]>=6) {?>
                        <div style="position:absolute;top:10px;right:10px;width:90px;font-size:14px;" <?php if($class["status"]>=6){echo "class='star-editable'";}?>>
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=1){echo "style='color:#FFCC00;'";}?>></span>
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=2){echo "style='color:#FFCC00;'";}?>></span> 
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=3){echo "style='color:#FFCC00;'";}?>></span> 
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=4){echo "style='color:#FFCC00;'";}?>></span> 
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=5){echo "style='color:#FFCC00;'";}?>></span>
						</div>
                        <?php } ?>
					</div>
					<div class="panel-body">
						<div class="col-md-7">
							<h5><b>Dirección:</b> <?php echo $class["address"];?></h5>
							<h5><b>Ciudad:</b> Bogotá - Colombia</h5>
							<h5><b>Teléfono:</b> <?php echo $class["phone"];?></h5>
						</div>
						<div class="col-md-3">
							<div class="calendar-profile">
								<div class="align-img-calendar">
									<h4><?php echo date("l",strtotime($class["start"])); ?></h4>
									<h1 style="margin-top:10px;margin-bottom:0px;"><?php echo date("d",strtotime($class["start"])); ?></h1>
									<h6><?php echo date("F",strtotime($class["start"])); ?></h6>
									<h6><?php echo date("H:i",strtotime($class["start"])); ?> - <?php echo date("H:i",strtotime($class["end"])); ?></h6>
								</div>
							</div>
						</div>
					</div>
                    
                    <?php 
					
					if($class["status"]>=6) {
						if($this->session->userdata('isTeacher') == 1 && $class["student_rate"] == 0){
					?>
                    	<div>
                            <button onClick="btCheckAction('<?php echo $class["hash"]; ?>');" type="button" class="btn btn-agregar" style="margin:auto;display:block;width:100%;">Calificar estudiante</button>
                        </div>
                        
                    <?php }elseif($this->session->userdata('isTeacher') == 0 && $class["rate"] == 0) { ?>
                    	<div>
                            <button onClick="btCheckAction('<?php echo $class["hash"]; ?>');" type="button" class="btn btn-agregar" style="margin:auto;display:block;width:100%;">Calificar profesor</button>
                        </div>
                    <?php }}?>
                    
				</div>
                <?php if(($class["status"]>=6) && ($class["comment"] != null || $class["student_comment"] != null)) {?>
                <div class="row">
                	<div class="col-md-3" style="height:65px; float:right;">
                		<button onclick="toggleComments(this,'<?php echo $class["id"]; ?>')" type="button" class="btn btn-agregar" style="margin:auto;display:block;width:100%;">Ver comentarios</button>
                	</div>
                </div>
                
                <!-- //////////////// -->
                
                <div id="comm_<?php echo $class["id"]; ?>" class="row comment_element" style="text-align:left; border:1px solid #009966; background-color:#FFFFFF;">
                    <?php if($class["comment"] != null) {?>
                    	<div class="col-md-12 test-pack comment-pack" style="padding:3%; margin-bottom: 0px;">
                            <div class="col-md-3">
                                <div class="container-testimonials-img center-block">
                                    <img style="background-color: #fff; min-height: 70px; width:100%" src="<?php echo base_url($class["sPicture"]);?>">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h4>
                                    <?php echo $class["sFName"] . " " . $class["sLName"];?>
                                </h4>
                            </div>
                            <div class="col-md-12">
                                <p><?php echo $class["comment"];?></p>
                            </div>
                        </div>
                    <?php }?>
                    
               		<?php if($class["student_comment"] != null) {?>
                    	<div class="col-md-12 test-pack comment-pack" style="padding:3%; margin-bottom: 0px;">
                            <div class="col-md-3">
                                <div class="container-testimonials-img center-block">
                                    <img style="background-color: #fff; min-height: 70px; width:100%" src="<?php echo base_url($class["pPicture"]);?>">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h4>
                                    <?php echo $class["pFName"] . " " . $class["pLName"];?>
                                </h4>
                            </div>
                            <div class="col-md-12">
                                <p><?php echo $class["student_comment"];?></p>
                            </div>
                        </div>
                    <?php }?>
                </div>
                
                <?php }?>
                
			</div>			
			<?php
		}
		?>
	</div>
</div>

<div class="modal fade" id="classCheck" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content popup-iniciar">
        	 <div class="modal-header">
             	<h1 style="margin-top:0px;">Califica a tu <span><?php if($this->session->userdata('isTeacher') == 0){
					echo "Profesor";
				}else{
					echo "Estudiante";
				}?></span></h1>
             </div>
             
             <div class="modal-body">
             
             	<div class="row">
                    <div class="div-area col-md-12 text-center" style="margin-top:20px;">
                        
                        
                        <?php
                        
                        if(($this->session->userdata('isTeacher') == 0) && ($class["rate"] > 0))
                        {
                            ?>
                            <div class="col-md-6">
                                <h3>Ya se evaluó el profesor. Muchas gracias.</h3>
                            </div>
                            
                        <?php
                        }
                        else if(($this->session->userdata('isTeacher') == 1) && ($class["student_rate"] > 0)){
                            ?>
                            <div class="col-md-6">
                                <h3>Ya se evaluó el estudiante. Muchas gracias.</h3>
                            </div>
                            
                        <?php
                        }
                        else {
                        ?>
                        
                      <div class="col-md-12">
                            <div class="rating">
                                <span id="star_5">★</span>
                                <span id="star_4">★</span>
                                <span id="star_3">★</span>
                                <span id="star_2">★</span>
                                <span id="star_1">★</span>
                            </div>
                        </div>
                        
                        <script>
                            
                        $("#star_1").click(function(){
                            $("#star_1").addClass("rating_up");
                            $("#star_2").removeClass("rating_up");
                            $("#star_3").removeClass("rating_up");
                            $("#star_4").removeClass("rating_up");
                            $("#star_5").removeClass("rating_up");
                            $("#rate").val("1");
                        });
                        $("#star_2").click(function(){
                            $("#star_1").addClass("rating_up");
                            $("#star_2").addClass("rating_up");
                            $("#star_3").removeClass("rating_up");
                            $("#star_4").removeClass("rating_up");
                            $("#star_5").removeClass("rating_up");
                            $("#rate").val("2");
                        });
                        $("#star_3").click(function(){
                            $("#star_1").addClass("rating_up");
                            $("#star_2").addClass("rating_up");
                            $("#star_3").addClass("rating_up");
                            $("#star_4").removeClass("rating_up");
                            $("#star_5").removeClass("rating_up");
                            $("#rate").val("3");
                        });
                        $("#star_4").click(function(){
                            $("#star_1").addClass("rating_up");
                            $("#star_2").addClass("rating_up");
                            $("#star_3").addClass("rating_up");
                            $("#star_4").addClass("rating_up");
                            $("#star_5").removeClass("rating_up");
                            $("#rate").val("4");
                        });
                        $("#star_5").click(function(){
                            $("#star_1").addClass("rating_up");
                            $("#star_2").addClass("rating_up");
                            $("#star_3").addClass("rating_up");
                            $("#star_4").addClass("rating_up");
                            $("#star_5").addClass("rating_up");
                            $("#rate").val("5");
                        });
                        
                        </script>
                        <form id='form' method='POST'>
                        
                        <input name="rate" type="hidden" id="rate" value="0">
                        
                        <input name="request_hid" type="hidden" id="request_hid" value="0">
                        
                        <div class="col-md-6 col-md-offset-3" style="margin-top:40px;">
                                <textarea name="comment" rows="4" class="form-control" id="comment" placeholder="Escribe una reseña corta de tu experiencia"></textarea>
                                <input onClick="doCheck();" type="button" class="btn-busqueda-profe btn-profe btn col-lg-12 busqueda_b" value="Calificar">
                        </div>
                        
                      </form>
                        
                        <?php
                        }
                        ?>
                        
                        
                  </div>
            
                </div>
             
             </div>
             
        </div>
    </div>
</div>

<script>

var base_url = '<?php echo base_url(); ?>';

function btCheckAction(request_id) {
	$("#classCheck").modal();
	$("#request_hid").val(request_id);
}

function doCheck() {
	
	var id_request = $("#request_hid").val();
	var isTeacher = <?php echo $this->session->userdata('isTeacher');?>;
	var rate = $("#rate").val();
	var comment = $("#comment").val();
	
	$.get(base_url+"clase/calificar_clase?id_request="+id_request+"&is_teacher=" + isTeacher + "&rate=" + rate + "&comment=" + comment,function(resp){
		if(resp == "true")
		{
			$("#classCheck").modal("hide");
			swal({
				title: "Listo!",
				text: "Calificación enviada",
				type: "success",
				confirmButtonText: "Aceptar" },
				function(){
					location.reload();
			});
		}
		else {
			$("#classCheck").modal("hide");
			swal({
				title: "Error!",
				text: "Se presentó un error al enviar tu calificación. Por favor intenta nuevamente.",
				type: "error",
				confirmButtonText: "Aceptar" },
				function(){
					location.reload();
			});
		}
	});
}

function toggleComments(_this, id){
	$("#comm_" + id).toggle(500);
	if($(_this).text() == "Ver comentarios"){
		$(_this).text("Ocultar comentarios");
	}
	else {
		$(_this).text("Ver comentarios");
	}
	
}

$(document).ready(function(){
	$(".comment_element").hide();
});
</script>