<div class="container">
<?php if(validation_errors()!=""){?>
<div class="msj3 alert alert-warning alert-danger" role="alert" id="alert3">
	<?php echo validation_errors();?>
</div>
<?php }?>
	<div class="container">
		<div class="row steps-center" style="">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="login-panel panel-registro panel panel-default">
			
				<h3 class="text-center asi-funciona" style="color:#003333">Completa los datos</h3>
			

			<div class="panel-body">
				<div class="row steps-center">
					<div class="col-md-3"></div>
						<div class="col-md-6">
							<form name="formcp" class="form-horizontal" role="form" method="post" action="<?php echo (base_url('registro/validateCompleteProfile'));?>">   
								
								<div class="form-group">
									<label for="">Fecha de nacimiento: </label>
									<div class="input-group date">
										<div class="input-append date" data-date-format="dd-mm-yyyy">
												  <input class="span2 form-control" name="cpNumDateTime" size="16" id="cpNumDateTime"value="<?php echo ($data_user[0]['DayBorn']) ? $data_user[0]['DayBorn'] . '-' . $data_user[0]['MonthBorn'] . '-' . $data_user[0]['YearBorn'] : '';?>" placeholder="Selecciona una opción" data-date="12-02-2012" type="text">
												  <span class="add-on"><i class="icon-th"></i></span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div>
										<label for="">Tipo de documento:</label>
										<select name="cpTypeDocument" class="form-control col-md-9" id="cpTypeDocument">  
											<?php 
												foreach($document_type as $value_document_type){
													if($value_document_type["id_doctype"] == 4 || $value_document_type["id_doctype"] == 5){continue;}
													if($data_user[0]['DocType'] == $value_document_type['id_doctype']){
														?>
															<option value="<?php echo $value_document_type['id_doctype'];?>" selected="selected"><?php echo $value_document_type['name']; ?></option>
														<?php
													}else{
														 ?>
															<option value="<?php echo $value_document_type['id_doctype'];?>"><?php echo $value_document_type['name']; ?></option>
														<?php
													}	                                                    
												}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<div>
										<label for="numDoc">Numero de documento</label>
										<input type="text" id="cpNumDoc" class="form-control" value="<?php if(isset($data_user[0]['DocNumber'])){echo $data_user[0]['DocNumber'];}else{ echo '';} ?>" placeholder="Ingresa tu documento de identidad" name="cpNumDoc">
									</div>
								</div>

								<div class="form-group">
									<div class="">
										<label for="numPhone">Numero de Celular</label>
										<input type="text" id="cpNumPhone" class="form-control" placeholder="Ingresa tu numero de celular" name="cpNumPhone" value="<?php if($data_user[0]['Phone'] != 'NULL'){echo $data_user[0]['Phone'];}else{echo '';}?>">
									</div>
								</div>

								<div class="form-group">
									<div class="">
										<label for="addressTeacher">Dirección de residencia</label>
										<input type="text" id="addressTeacher" class="form-control" value="<?php if(isset($data_user[0]['Address'])){echo ($data_user[0]['Address']);} ?>" placeholder="ingresa tu dirección de residencia" name="cpAddressTeacher">
									</div>
								</div>

								<div class="form-group">
									<div> 
										<label for="">País de residencia:</label>
										<select id="cbo_country" name="cbo_country" class="form-control col-md-9">    
		   
									<?php 
										foreach($countries as $key => $value_countries){
											$value = $value_countries['IdCountry'] . '_' . $value_countries['Name'];
											if($value_countries['IdCountry'] == $data_user[0]['Country']){
												?>
													<option value="<?php echo $value; ?>" code="<?php echo $value_countries['Code']; ?>" selected="selected"><?php echo $value_countries['Name'];?></option>
												<?php
											}else{
												?>
													<option value="<?php echo $value; ?>" code="<?php echo $value_countries['Code']; ?>"><?php echo $value_countries['Name'];?></option>
												<?php
											}
										}
									?>
									</select>
									</div>
								</div>
				
								<div class="form-group">
									<div class="">
										<label for="">Ciudad de residencia:</label>
										<select id="cbo_city" name="cbo_city" class="form-control col-md-9">
											<?php 
												foreach($cities as $key => $city){
													$value = $city->ID . '_' . $city->Name;
													if($city->ID == $data_user[0]['City']){
														?>
															<option value="<?php echo $value; ?>" code="<?php echo $city->ID; ?>" selected="selected"><?php echo utf8_decode($city->Name);?></option>
														<?php
													}else{
														?>
															<option value="<?php echo $value; ?>" code="<?php echo $city->ID; ?>"><?php echo utf8_decode($city->Name);?></option>
														<?php
													}
												}
											?>
										 </select>
									</div>
								</div>

								<div class="form-group">
									<div>
										<!--<input type="submit" class=" btn btn-info col-lg-12 " value="Siguiente" name="btnCompleteProfile" id="btnCompleteProfile">-->
										<button type="submit" class="btn-siguiente-registro btn" name="btnCompleteProfile" value="siguiente"><div>Siguiente</div></button>
									</div>
								</div>
							</form>
						</div>
					<div class="col-md-3"></div>
				</div>                        
			</div>

			</div>
			<div class="col-md-3"></div>
			<div class="col-md-2"></div>
		</div>
	</div>

 
		</div>
		<div class="row steps-center">
			<div class="col-md-12"></div>
		</div>
</div>  
<div class="amigas-separator"></div>
<link rel='stylesheet' href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>"></link>
<script src="<?php echo base_url("assets/js/datepicker/js/bootstrap-datepicker.js"); ?>"></script>
 <script type="text/javascript">
	// When the document is ready
	$(document).ready(function () {
		$("#cbo_country").change(function(){
			var cod = {Code:$(this).find("option:selected").attr("code")};
			$.post("<?php echo base_url("registro/ajaxCities");?>",cod,function(resp){
				var cities = JSON.parse(resp);
				var options = '<option value="" selected="selected">Selecciona una opción</option>';
				for(var i in cities){
					options += "<option value='"+cities[i].ID+"'>"+cities[i].Name+"</option>";
				}
				$("#cbo_city").html(options);
			});
			}
		);
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate() + 1, 0, 0, 0, 0);
		/*$("#dp3").css("cursor","not-allowed");
		$("#dp3").attr("disabled",true);*/
		//$("#dp3").val((nowTemp.getMonth() + 1)+"/"+(nowTemp.getDate() + 1)+"/"+2014)
		//$("#cbo_hora").attr("disabled",true)
		$("#cpNumDateTime").css("width","273px");
		var ingreso_fecha = $('#cpNumDateTime').datepicker({
			format: 'dd-mm-yyyy',
			language: "es",
			autoclose: true
		})
		ingreso_fecha.on('changeDate', function(ev) {
		 
		}).data('datepicker');
	});

	
		
</script>