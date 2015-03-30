<div class="container body-admin">
	<h3 >Solicitudes de pago realizadas por el profesor.</h3>
	<div class="amigas-separator"></div>
		<div>
			<div class="col-md-12" style="margin-bottom:20px;">
				
			</div>
            <table class="pfs table table-striped table-bordered" style="font-size:12px;">
  			<thead>
        		<tr>
            	<th>#</th>
            	<th>Fecha</th>
                <th>Tipo</th>
				<th>Soporte</th>
				<th>Valor</th>
				<th>Estado</th>
                <th>Acciones</th>
            	</tr>
    		</thead>
    		
    		<tbody>
    			<?php 
    			foreach($details as $d){ ?>
        		<tr id="tr_<?php echo $d["id"]; ?>">
            		<td><?php echo $d["id"]; ?></td>
            		<td><?php echo $d["date"]; ?></td>
                    <td><?php echo $d["type"]; ?></td>
					<td><a target="_blank" href="<?php echo base_url($d["url"]); ?>">Ver soporte de pago</a></td>
					<td><?php echo (int)$d["value"]; ?></td>
					<td>
					<?php
						if($d["state"] == "VERIFICACION"){
					?>
                    	<select name="state_select_<?php echo $d["id"]; ?>" id="state_select_<?php echo $d["id"]; ?>">
                        	<option value="VERIFICACION" selected>EN VERIFICACION</option>
                            <option value="ACEPTADO">PAGO ACEPTADO</option>
                            <option value="RECHAZADO">PAGO RECHAZADO</option>
                        </select>
                    <?php } else {?>
                    		<?php echo $d["state"]; ?></td>
                    <?php } ?>
					
					
                    <td align="center"><div onClick="doChanges('<?php echo $d["id"]; ?>')" class="btn btn-default btn-sm">Guardar</div></td>
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

base_url = "<?php echo base_url("");?>";

function doChanges(id){
	
	var _state = $("#state_select_" + id).val();
	if(_state != "VERIFICACION") {
		$.post( base_url + "administrador/facturacion/savedetail", { id: id, state: _state })
			.done(function( data ) {
				swal({
					title: "Listo!",
					text: "Actualización exitosa.",
					type: "success" },
					function(){
						window.location.reload();
					}
				);
		});
	} else {
		swal({
			title: "Error!",
			text: "Es necesario cambiar el estado del pago.",
			type: "error",
			confirmButtonText: "Aceptar" 
		});
	}
}

</script>