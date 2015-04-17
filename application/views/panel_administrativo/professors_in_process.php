<div class="container body-admin">
	<h3 ><?php echo $title ?></h3>
	<div class="amigas-separator"></div>
		<div>
			<div class="col-md-12" style="margin-bottom:20px;">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<input class="form-control" id="search" placeholder="Buscar Profesor por número de documento"></input>
				</div>
				<div class="col-md-4">
					<button id="filter">Buscar</button>
				</div>
			</div>
            <table class="pfs table table-striped table-bordered" style="font-size:12px;">
  			<thead>
        		<tr>
            	<th><a href="<?php echo base_url("administrador/profesores/proceso"); ?>">#</a></th>
            	<th>Fecha</th>
            	<th>Nombre</th>
            	<th>Apellido</th>
				<th><a href="<?php echo base_url("administrador/profesores/proceso/cc"); ?>">Documento</a></th>
				<th>Email</th>
            	<th>Calificación</th>
            	<th>Perfil</th>
            	<th>Ciudad</th>
            	<th>Área</th>
            	<th>Antecedentes</th>
            	<th>Referencias Profesionales</th>
				<th>Referencias Personales</th>
            	<th>Entrevista</th>
            	<th>Prueba Personal</th>
            	<th>Contrato</th>
				<th>Precio</th>
				<th>Comisión SP</th>
            	<th><a href="<?php echo base_url("administrador/profesores/proceso/active"); ?>">Activo</a></th>
            	</tr>
    		</thead>
    		
    		<tbody>
    			<?php var_dump($professors); ?>
    			<?php 
    			foreach($professors as $c){ ?>
    				
        		<tr>
            		<td class="row-id"><?php echo $c["id"];?></td>
            		<td><?php echo $c["registro"]; ?></td>
            		<td><a href="<?php echo base_url("administrador/profesores/detalles/".$c["id_user"]); ?>" ><?php echo $c["firstName"]; ?></a></td>
            		<td><?php echo $c["lastName"]; ?></td>
            		<td class="doc"><?php echo $c["doc_number"]; ?></td>
					<td><?php echo $c["email"]; ?></td>
					<td><?php echo $c["rate"]; ?></td>
            		<td><?php echo $c["profile"]; ?></td>
            		<td class="city"><?php foreach($cities as $city){if($city->ID == $c["id_city"])echo utf8_decode($city->Name);break;}?></td>
            		<?php $d = $professorsf->getProfessorarea($c["id"]); ?>
            		<td class="areas"><?php foreach ($d as $ar) {
            				foreach($areas as $area){
								if($area->IdArea == $ar['id_area']){
									echo $area->Name."-";
									foreach($levels as $l){if($l["id"] == $ar["id_level"]){echo $l["name"].", ";break;}};
								}
							}
            		}?>

					</td>
            		<td>
						<?php if($editable): ?>
						<select class="validation_background">
							<option value="0" <?php if($c["validation_background"]==0){echo "selected";} ?>>No</option>
							<option value="1" <?php if($c["validation_background"]==1){echo "selected";} ?>>Si</option>
						</select>
						<?php else: ?>
							<?php echo $c["validation_background"]; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($editable): ?>
						<select class="validation_professional_ref">
							<option value="0" <?php if($c["validation_professional_ref"]==0){echo "selected";} ?>>No</option>
							<option value="1" <?php if($c["validation_professional_ref"]==1){echo "selected";} ?>>Si</option>
						</select>
						<?php else: ?>
							<?php echo $c["validation_professional_ref"]; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($editable): ?>
						<select class="validation_personal_ref">
							<option value="0" <?php if($c["validation_personal_ref"]==0){echo "selected";} ?>>No</option>
							<option value="1" <?php if($c["validation_personal_ref"]==1){echo "selected";} ?>>Si</option>
						</select>
						<?php else: ?>
							<?php echo $c["validation_personal_ref"]; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($editable): ?>
						<select class="validation_interview">
							<option value="0" <?php if($c["validation_interview"]==0){echo "selected";} ?>>No</option>
							<option value="1" <?php if($c["validation_interview"]==1){echo "selected";} ?>>Si</option>
						</select>
						<?php else: ?>
							<?php echo $c["validation_interview"]; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($editable): ?>
						<select class="validation_personal_test">
							<option value="0" <?php if($c["validation_personal_test"]==0){echo "selected";} ?>>No</option>
							<option value="1" <?php if($c["validation_personal_test"]==1){echo "selected";} ?>>Si</option>
						</select>
						<?php else: ?>
							<?php echo $c["validation_personal_test"]; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($editable): ?>
						<select class="validation_agreement">
							<option value="0" <?php if($c["validation_agreement"]==0){echo "selected";} ?>>No</option>
							<option value="1" <?php if($c["validation_agreement"]==1){echo "selected";} ?>>Si</option>
						</select>
						<?php else: ?>
							<?php echo $c["validation_agreement"]; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($editable): ?>
						<input class="price" style="width:60px;" value="<?php echo $c["price"]; ?>"></input>
						<?php else: ?>
							<?php echo $c["price"]; ?>
						<?php endif; ?>
					
					</td>
					<td>
						<?php if($editable): ?>
						<input class="fee_sp" style="width:60px;" value="<?php echo $c["fee_sp"]; ?>"></input>
						<?php else: ?>
							<?php echo $c["fee_sp"]; ?>
						<?php endif; ?>
					
					</td>
					<td>
						<?php if($editable): ?>
						<select style="width:50px" class="active">
							<option value="0" <?php if($c["active"]==0){echo "selected";} ?>>No</option>
							<option value="1" <?php if($c["active"]==1){echo "selected";} ?>>Si</option>
						</select>
						<?php else: ?>
							<?php echo $c["active"]; ?>
						<?php endif; ?>
					</td>
        		</tr>
        		<?php } ?>
    		</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1>Processing...</h1>
			</div>
			<div class="modal-body">
				<div class="progress progress-striped active">
					<div class="bar" style="width: 100%;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\,' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&.');
};
var base_url = "<?php echo base_url("");?>";
function updateProfessor(){
	$("#pleaseWaitDialog").modal();
	var row = $(this).parents("tr");
	data = {
		pfs:{
			id : row.find(".row-id").text(),
			validation_background : row.find(".validation_background").val(),
			validation_professional_ref : row.find(".validation_professional_ref").val(),
			validation_personal_ref : row.find(".validation_personal_ref").val(),
			validation_interview : row.find(".validation_interview").val(),
			validation_personal_test : row.find(".validation_personal_test").val(),
			validation_agreement : row.find(".validation_agreement").val(),
			price : row.find(".price").val().replace(",","").replace(".",""),
			fee_sp : row.find(".fee_sp").val().replace(",","").replace(".",""),
			active : row.find(".active").val()
		}
	}
	$.post(base_url+"administrador/actualizar/professor/",data,function(resp){
		var rta = JSON.parse(resp);
		if(rta){
			$("#pleaseWaitDialog").modal('hide');
		}
	});
	row.find(".price").val(parseInt(data.pfs.price).format());
	row.find(".fee_sp").val(parseInt(data.pfs.fee_sp).format());
}
$(".pfs input").change(updateProfessor);
$(".pfs select").change(updateProfessor);
$("#filter").click(function(){
	$("tbody tr").each(function(){
		if($("#search").val() == ""){
			$(this).css("display","");
		}else{
			if($(this).find(".doc:contains('"+$("#search").val()+"')").length){
				$(this).css("display","");
			}else{
				$(this).css("display","none");
			}
		}
	});
});
</script>