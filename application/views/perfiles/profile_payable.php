<div class="container body-admin">
	<h3 ><?php echo $title ?></h3>
	<div class="amigas-separator"></div>
		<div>
			<div class="col-md-12" style="margin-bottom:20px;">
				<div class="col-md-4"></div>
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
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
        		<tr>
            		<td class="row-id"><?php echo $c["id"]; ?><input type="hidden" class="hash" value="<?php echo $c["hash"];?>"></input></td>
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
					<td>
						<?php echo $c["price_sp"]?>
					</td>
					<?php endif;?>
            		<td><?php foreach ($states as $value) { ?> <?php if($value['id']==$c["status"]){echo $value["name"];}?><?php } ?></td>
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
$("#pleaseWaitDialog").modal();
	var row = $(this).parents("tr");
	var start = row.find(".start").val() +" "+ row.find(".start-time").val();
	start = new moment(start,"DD-MM-YYYY HH:mm");
	data = {
		cls:{
			hash : row.find(".row-id .hash").val(),
			address : row.find(".address").val(),
			start : start.format("YYYY-MM-DD HH:mm:ss"),
			end : new moment(start).add(row.find(".duration").val(),'h').format("YYYY-MM-DD HH:mm:ss"),
			price_public : row.find(".price-pub").val(),
			price_sp : row.find(".price-sp").val(),
			status : row.find(".state option:selected").val()
		}
	}
	
	$.post(base_url+"administrador/actualizar/clase/",data,function(resp){
		var rta = JSON.parse(resp);
		if(rta){
			$(".modal-header h1").html("Actualización Completa");
		}
	});
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
			$(".modal-header h1").html("Actualización Completa");
		}
	});
});
</script>