<div class="container body-admin">
	<h3 ><?php echo $title ?></h3>
	<div class="amigas-separator"></div>
		<div>
        
        	<?php 
			if(isset($error)) {
			?>
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              <?php 
			  echo $error['error'];
			  ?>
            </div>
            <?php }
			?>
        
			<div class="col-md-12" style="margin-bottom:20px;">
				<div class="col-md-4"></div>
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
				</div>
			</div>
            <table id="list_table" class="class table table-striped table-bordered" style="font-size:12px;">
  			<thead>
        		<tr>
                <?php if($this->session->userdata('isTeacher')==1):?>
				<th><input type="checkbox" id="title_checkbox"></th>
				<?php endif;?>
            	<th>#</th>
            	<th>Fecha Solicitud</th>
            	<th>Área</th>
            	<th>Temática</th>
            	<th>Nivel</th>
            	<th>Ciudad</th>
            	<th>Dirección</th>
            	<th>Fecha Clase</th>
				<th>Hora</th>
            	<th>Cant.Horas</th>
            	<th>Estudiante</th>
            	<th>Profesor</th>
            	<th>Valor clase</th>
				<?php if($this->session->userdata('isTeacher')==1):?>
				<th>Comisión SuperProfe</th>
				<?php endif;?>
            	<th>Estado</th>
        		</tr>
    		</thead>
    		
    		<tbody>
    			<?php 
    			foreach($class as $c){ ?>
        		<tr class="tbody_table">
                	<?php if($this->session->userdata('isTeacher')==1 && $c["status"] == 6):?>
                    <td><input class="checkbox_ele" type="checkbox"></td>
                    <?php else:?>
                    <td></td>
                    <?php endif;?>
            		<td class="row-id"><span class="ele_id"><?php echo $c["id"]; ?></span><input type="hidden" class="hash" value="<?php echo $c["hash"];?>"></input></td>
            		<td><?php echo $c["date"]; ?></td>
					<td><?php foreach($areas as $area){if($area->IdArea== $c["id_area"]){echo $area->Name;break;}} ?></td>
            		<td><?php echo $c["topic"]; ?></td>
					<td><?php foreach($levels as $level){if($level["id"] == $c["id_level"]){echo utf8_decode($level["name"]);break;}} ?></td>
            		<td><?php foreach($cities as $city){if($city->ID == $c["city"]){echo utf8_decode($city->Name);break;}} ?></td>
					<td><?php echo $c["address"]; ?></td>
            		<td><?php echo date("d-m-Y",strtotime($c["start"])); ?></td>
            		<td><?php echo  date("H:i",strtotime($c["start"])); ?></td>
            		<td>
						<?php 
						$datetime1 = new DateTime($c["start"]);
						$datetime2 = new DateTime($c["end"]);
						$interval = $datetime1->diff($datetime2);
						echo $interval->format("%h"); ?></td>
            		<td>
						<?php 
						if(empty($c["sFName"])){
							echo "Asignar";
						}else{
							echo $c["sFName"]." ".$c["sLName"];
						} ?>
            		<td>
						<?php 
						if(empty($c["pFName"])){
							echo "Sin Profe";
						}else{
							echo $c["pFName"]." ".$c["pLName"];
						} ?>
					</td>
            		<td>
						<?php if($this->session->userdata('isTeacher')==1){echo $c["price_public"];}else{echo $c["price_public"] + $c["price_sp"];} ?>
					</td>
					<?php if($this->session->userdata('isTeacher')==1):?>
					<td class="sp_price">
						<?php echo $c["price_sp"]?>
					</td>
					<?php endif;?>
            		<td><?php foreach ($states as $value) { ?> <?php if($value['id']==$c["status"]){echo $value["name"];}?><?php } ?></td>
        		</tr>
        		<?php } ?>
                
                <?php if($this->session->userdata('isTeacher')==1):?>
                <tr>
                	<td align="right" colspan="14">
                    	Acumulado: 
                    </td>
                    <td id="total_value" colspan="2">0</td>
                </tr>
                <tr>
                	<td align="right" colspan="14">
                    	Acciones: 
                    </td>
                    <td align="center" id="total_value" colspan="2">
                    	<div class="btn btn-default btn-sm" style="margin-bottom:5px;">Pagar ON-LINE</div>  
                        <div class="btn btn-default btn-sm" onClick="uploadData()">Subir consignación</div>
                    </td>
                </tr>
				<?php endif;?>
                
                <tr id="upload_tr">
                	<td align="center" colspan="16">
                    <?php echo form_open_multipart('perfil/subirPago', array('id'=>'upload_data'));?>
                    <!--form method="post" id="upload_data" action="<?php echo base_url("perfil/subirPago");?>"-->
                    <label for="uploadData">Carga copia del comprobante de consignación: </label>
                    <input type="file"  name="userfile" size="20" />
                    <input type="hidden" name="form_value" id="form_value" value=""/>
                    <input type="hidden" name="form_array" id="form_array" value=""/>
                    <input type="submit" id="" class="btn btn-success"/>
                    </form>
                    </td>
                </tr>
    		</tbody>
			</table>
		</div>
        
	</div>

<div class="modal fade" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1>Processing...</h1>
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
$("#upload_tr").hide();

$("#title_checkbox").click(function(){
	var $checkboxes = $(".tbody_table").find('input[type=checkbox]');
    $checkboxes.prop('checked', $(this).is(':checked'));
	
	listTotal();
});

$(".checkbox_ele").click(function(){
	listTotal();
});

function listTotal() {
	var IdsArray = new Array();
	var total = 0;
	
	$('#list_table > tbody  > tr').each(function() {
		
		if($(this).find(".checkbox_ele").is(':checked')){
			total = total + Number($(this).find(".sp_price").html());
			IdsArray.push(Number($(this).find(".ele_id").html()));
		}
	});
	$("#total_value").html(String(total));
	
	$("#form_value").val(String(total));
	$("#form_array").val(JSON.stringify(IdsArray));
}


function uploadData(){
	if($("#total_value").html() != "0"){
		$("#upload_tr").show(500);
	}else {
		swal({
			title: "Error!",
			text: "Es necesario tener al menos un elemento seleccionado",
			type: "error",
			confirmButtonText: "Aceptar" 
		});
	}
}

</script>