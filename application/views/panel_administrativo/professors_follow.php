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
					<a href="<?php echo base_url("administrador/csv/profesores"); ?>" target="_blank">Descargar Base de Datos</a>
				</div>
			</div>
            <table class="pfs table table-striped table-bordered" style="font-size:12px;">
  			<thead>
        		<tr>
            	<th><a href="<?php echo base_url("administrador/profesores/proceso"); ?>">#</a></th>
            	<th>Nombre</th>
            	<th>Apellido</th>
				<th><a href="<?php echo base_url("administrador/profesores/proceso/cc"); ?>">Documento</a></th>
				<th>Email</th>
				<th>Calificación</th>
				<th>Celular</th>
				<th>Dirección</th>
				<th>Fecha Nacimiento</th>
				<th>Ciudad</th>
				<th>Areas</th>
				<th>Precio</th>
				<th>Comisión</th>
            	</tr>
    		</thead>
    		
    		<tbody>
    			<?php 
    			foreach($professors as $c){ ?>
        		<tr>
            		<td class="row-id"><?php echo $c["id"]; ?></td>
            		<td><?php echo $c["firstName"]; ?></td>
            		<td><?php echo $c["lastName"]; ?></td>
					<td class="doc"><?php echo $c["doc_number"]; ?></td>
					<td><?php echo $c["email"]; ?></td>
					<td><?php echo $c["rate"]; ?></td>
					<td><?php echo $c["phone"]; ?></td>
					<td><?php echo $c["address"]; ?></td>
					<td><?php echo $c["birthday"]; ?></td>
					<td class="city"><?php foreach($cities as $city){if($city->ID == $c["id_city"])echo utf8_decode($city->Name);break;}?></td>
            		<td class="areas"><?php $as = explode(",",$c["areas"]);
							foreach($areas as $area){
								foreach($as as $a){
									if($a == $area->IdArea){
										echo $area->Name.",";
										break;
									}
								}
							}?>
					</td>
					<td><?php echo $c["price"]; ?></td>
					<td><?php echo $c["fee_sp"]; ?></td>
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
<script>
jQuery.expr[":"].contains = jQuery.expr.createPseudo(function(arg) {
    return function( elem ) {
        return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});
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
			$(".modal-header h1").html("Actualizaci�n Completa");
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
			var b = $(this).find(".doc:contains('"+$("#search").val()+"')").length >0;
			b = b || $(this).find(".city:contains('"+$("#search").val()+"')").length >0;
			b = b || $(this).find(".areas:contains('"+$("#search").val()+"')").length >0;
			if(b){
				$(this).css("display","");
			}else{
				$(this).css("display","none");
			}
		}
	});
});
</script>