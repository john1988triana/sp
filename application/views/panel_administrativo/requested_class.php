<div class="container body-admin">
	<h3 ><?php echo $title ?></h3>
	<div class="amigas-separator"></div>
		<div>
			<div class="col-md-12" style="margin-bottom:20px;">
				<div class="col-md-4"></div>
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<a href="<?php echo base_url("administrador/csv/clases"); ?>"  target="_blank">Descargar Base de Datos</a>
				</div>
			</div>
            <table class="class table table-striped table-bordered" style="font-size:12px;">
  			<thead>
        		<tr>
            	<th>#</th>
            	<th>Fecha Solicitud</th>
            	<th>Área</th>
            	<th>Temática</th>
            	<th>Nivel</th>
            	<th>Ciudad</th>
            	<th>Dirección</th>
                <th>Barrio</th>
            	<th>Fecha Clase</th>
				<th>Hora</th>
            	<th>Cant.Horas</th>
            	<th>Estudiante</th>
            	<th>Celular</th>
            	<th>Profesor</th>
            	<th>Valor clase</th>
            	<th>Comisión SP</th>
            	<th>Estado</th>
                <th>Observaciones</th>
				<?php if($editable): ?>
            	<th>Guardar</th>
				<?php endif; ?>
				<?php if(isset($rateable)): ?>
				<th>Calificación</th>
				<th>Comentario</th>
				<th>Guardar</th>
				<?php endif; ?>
        		</tr>
    		</thead>
    		
    		<tbody>
    			<?php 
    			foreach($class as $c){ ?>
        		<tr>
            		<td class="row-id"><?php echo $c["id"]; ?><input type="hidden" class="hash" value="<?php echo $c["hash"];?>"></input></td>
            		<td><?php echo $c["date"]; ?></td>
					<td><?php foreach($areas as $area){if($area->IdArea== $c["id_area"]){echo $area->Name;break;}} ?></td>
            		<td><?php echo $c["topic"]; ?></td>
            		<td><?php echo $c["level"]; ?></td>
            		<td><?php foreach($cities as $city){if($city->ID == $c["city"]){echo utf8_decode($city->Name);break;}} ?></td>
					<td>
					<?php if($editable): ?>
						<input class="form-control address" style="width:200px;" value="<?php echo $c["address"] ?>"></input>
					<?php else: ?>
						<?php echo $c["address"]; ?>
					<?php endif; ?>
					</td>
                    <td>
					<?php if($editable): ?>
						<input class="form-control neighbor" style="width:120px;" value="<?php echo $c["neighbor"] ?>"></input>
					<?php else: ?>
						<?php echo $c["neighbor"]; ?>
					<?php endif; ?>
					</td>
            		<td>
					<?php if($editable): ?>
						<input class="datepicker form-control start" style="width:100px;" value="<?php echo date("d-m-Y",strtotime($c["start"])); ?>"> </input>
					<?php else: ?>
						<?php echo date("d-m-Y",strtotime($c["start"])); ?>
					<?php endif; ?>
					</td>
            		<td>
					<?php if($editable): ?>
						<input class="form-control start-time" style="width:80px;" value="<?php echo date("H:i",strtotime($c["start"])); ?>"> </input>
					<?php else: ?>
						<?php echo  date("H:i",strtotime($c["start"])); ?>
					<?php endif; ?>
					</td>
            		<td>
					<?php if($editable): ?>
						<input class="spinner duration" style="width:50px;" value="<?php 
						$datetime1 = new DateTime($c["start"]);
						$datetime2 = new DateTime($c["end"]);
						$interval = $datetime1->diff($datetime2);
						echo $interval->format("%h"); ?>"></input>
					<?php else: ?>
						<?php 
						$datetime1 = new DateTime($c["start"]);
						$datetime2 = new DateTime($c["end"]);
						$interval = $datetime1->diff($datetime2);
						echo $interval->format("%h"); ?>
					<?php endif; ?>
					</td>
            		<td>
					<?php if($editable): ?>
						<a href="<?php echo base_url("administrador/clases/detalles/".$c["hash"]); ?>"><?php 
						if(empty($c["sFName"])){
							echo "Asignar";
						}else{
							echo $c["sFName"]." ".$c["sLName"];
						} ?></a>
					<?php else: ?>
						<?php 
						if(empty($c["sFName"])){
							echo "Asignar";
						}else{
							echo $c["sFName"]." ".$c["sLName"];
						} ?>
					<?php endif; ?></td>
            		<td><?php echo $c["phone"] ?></td>
            		<td>
					<?php if($editable): ?>
						<a href="<?php echo base_url("administrador/clases/detalles/".$c["hash"]); ?>"><?php 
						if(empty($c["pFName"])){
							echo "Asignar";
						}else{
							echo $c["pFName"]." ".$c["pLName"];
						} ?></a>
					<?php else: ?>
						<?php 
						if(empty($c["pFName"])){
							echo "Asignar";
						}else{
							echo $c["pFName"]." ".$c["pLName"];
						} ?>
					<?php endif; ?>
					</td>
            		<td>
					<?php if($editable): ?>
						<input class="form-control price-pub" style="width:100px;" value="<?php echo $c["price_public"] ?>"> </input>
                      	<script type="application/javascript"> $(".price-pub").autoNumeric('init', {mDec:'0', aSep: '.', aDec: ',', aSign: '$ '});</script>
                      
					<?php else: ?>
						<?php echo $c["price_public"]; ?>
					<?php endif; ?>
            		<td>
					<?php if($editable): ?>
						<input class="form-control price-sp" style="width:100px;" value="<?php echo $c["price_sp"] ?>"> </input>
                        <script type="application/javascript"> $(".price-sp").autoNumeric('init', {mDec:'0', aSep: '.', aDec: ',', aSign: '$ '});
                        
                        
                        
                        </script>
                        
                        
                        
                        
                        
                        
					<?php else: ?>
						<?php echo $c["price_sp"]; ?>
					<?php endif; ?>
            		<td>
						<?php if($editable_status): ?>
						<select class="state">
							<?php foreach ($states as $value) { ?> 
								<option value="<?php echo $value['id']; ?>" <?php if($value['id']==$c["status"]){echo "selected";}?>>
									<?php echo $value['name']; ?>
								</option>
							<?php } ?>
						</select>
						<?php else: ?>
							<?php foreach ($states as $value) { ?> 
								<?php if($value['id']==$c["status"]){echo $value["name"];}?>
							<?php } ?>
						<?php endif; ?>
					</td>
                    <td>
                    <?php if($editable): ?>
                    	<textarea class="notes" rows="3"><?php if($c["notes"] != ""):?><?php echo $c["notes"] ?><?php endif; ?></textarea>
					<?php else: ?>
						<?php echo $c["notes"]; ?>
					<?php endif; ?>
                    </td>
					<?php if($editable): ?>
					<td>
					<button class="saveRow" type="button" >Guardar</button>
					</td>
					<?php endif; ?>
					<?php if(isset($rateable)): ?>
					<td>
						<?php if($c["rate"]==0): ?>
							<input class="spinner rate" style="width:50px;" value="<?php echo $c["rate"]; ?>"></input>
						<?php else: ?>
							<?php echo $c["rate"]; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($c["rate"]==0): ?>
							<textarea class="comment" maxlength="300" ><?php echo $c["comment"]; ?></textarea>
						<?php else: ?>
							<?php echo $c["comment"]; ?>
						<?php endif; ?>
					</td>
					<td>
					<?php if($c["rate"]==0): ?>
						<button class="saveComment" type="button" >Guardar</button>
					<?php endif; ?>
					</td>
					<?php endif; ?>
					
        		</tr>
        		<?php } ?>
    		</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1>Guardando información...</h1>
			</div>
			<div class="modal-body">
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" style="width: 100%;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<link  rel="stylesheet" href="<?php echo (base_url('assets/css/jquery.bootstrap-touchspin.min.css')); ?>"></link>
<script src="<?php echo (base_url('assets/js/jquery.bootstrap-touchspin.min.js')); ?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>
<script>
var base_url = "<?php echo base_url("");?>";
$('#pleaseWaitDialog').on('hidden.bs.modal', function () {
  window.location.reload();
});
$(".datepicker").datepicker({format: 'dd-mm-yyyy',
	onRender: function(date) {
		var now = new Date();
		return date.valueOf() < now.valueOf() ? 'disabled' : '';
	}});
$(".spinner").TouchSpin({verticalbuttons: true,max: 5,min:1});
function updateClass(){

	var row = $(this).parents("tr");
	var start = row.find(".start").val() +" "+ row.find(".start-time").val();
	start = new moment(start,"DD-MM-YYYY HH:mm");
	if(row.find(".state option:selected").val() == 7){
		data = {
			cls:{
				hash : row.find(".row-id .hash").val(),
				status : row.find(".state option:selected").val()
			}
		}	
	}
	else{
		data = {
			cls:{
				hash : row.find(".row-id .hash").val(),
				address : row.find(".address").val(),
				start : start.format("YYYY-MM-DD HH:mm:ss"),
				end : new moment(start).add(row.find(".duration").val(),'h').format("YYYY-MM-DD HH:mm:ss"),
				price_public : row.find(".price-pub").val(),
				price_sp : row.find(".price-sp").val(),
				status : row.find(".state option:selected").val(),
				notes : row.find(".notes").val(),
				neighbor : row.find(".neighbor").val()
			}
		}
	}
	
	
	
	if(row.find(".state option:selected").val() == 5)
	{
		if(row.find(".notes").val() == "")
		{
			swal({
				title: "Error!",
				text: "Debe existir un registro de la causa de cancelación. Por favor registrala en el campo de observaciones.",
				type: "error",
				confirmButtonText: "Aceptar" },
				function() {
					window.location.reload();
				}
			);
		}
		else
		{
			//alert(JSON.stringify(data));
			swal({	title: "Estás seguro?",
					text: "Se cancelará la clase seleccionada!",   
					type: "warning",
					showCancelButton: true,
					cancelButtonText: "No",
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "si, cancélala!",
					closeOnConfirm: false },
					function(isConfirm){
						if (isConfirm) {
							$.post(base_url+"administrador/actualizar/clase/",data,function(resp){
								var rta = JSON.parse(resp);
								if(rta){
									//$(".modal-header h1").html("Actualización Completa");
									swal({
										title: "Cancelada!",
										text: "La clase seleccionada fue cancelada.",
										type: "success" },
										function(){
											window.location.reload();
										}
									);
								}
							});	
						}
						else {
							window.location.reload();
						}
						 
					}
				);
		}
	}
	else
	{
		$("#pleaseWaitDialog").modal();
		
		$.post(base_url+"administrador/actualizar/clase/", data,function(resp){
			var rta = JSON.parse(resp);
			if(rta){
				$("#pleaseWaitDialog").modal("hide");
				//$(".modal-header h1").html("Actualización Completa");
				swal({
					title: "Listo!",
					text: "Actualización exitosa.",
					type: "success" },
					function(){
						//window.location.reload();
					}
				);
			}
		});
	}

}
$(".class .saveRow").click(updateClass);
$(".class input").change(updateClass);
$(".class select").change(updateClass);
$(".class .saveComment").click(function(){
	$("#pleaseWaitDialog").modal();
	var row = $(this).parents("tr");
	var start = row.find(".start").val() +" "+ row.find(".start-time").val();
	start = new moment(start,"DD-MM-YYYY HH:mm");
	data = {
		cls:{
			hash : row.find(".row-id .hash").val(),
			rate : row.find(".rate").val(),
			comment: row.find(".comment").val()
		}
	}
	
	$.post(base_url+"administrador/actualizar/clase/",data,function(resp){
		var rta = JSON.parse(resp);
		if(rta){
			$("#pleaseWaitDialog").modal("hide");
			//$(".modal-header h1").html("Actualización Completa");
			swal({
					title: "Listo!",
					text: "Actualización exitosa.",
					type: "success" },
					function(){
						//window.location.reload();
					}
				);
		}
	});
});
</script>