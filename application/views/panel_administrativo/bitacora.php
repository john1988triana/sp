<div class="container body-admin">
	<h3 >Listado de Usuarios que usaron el código promocional</h3>
    <div class="amigas-separator"></div>
    <div>
    	<table class="class table table-striped table-bordered" style="font-size:12px;">
        	<thead>
            	<tr>
                	<th>#</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
            	<?php 
    			foreach($list as $promo){ ?>
        		<tr id="tr_<?php echo $promo["id"]; ?>">
                	<td><?php echo $promo["id"]; ?></td>
                    <td><?php echo $promo["firstName"]; ?> <?php echo $promo["lastName"]; ?></td>
                    <td><?php echo $promo["date"]; ?></td>
              </tr>
                
                <?php }?>
            	
            </tbody>
        </table>
    </div>
    
</div>

<script src="<?php echo (base_url('assets/js/datepicker/js/bootstrap-datepicker.js')); ?>"></script>

<script>

$(".datepicker").datepicker({format: 'yyyy-mm-dd',
	onRender: function(date) {
		var now = new Date();
		return date.valueOf() < now.valueOf() ? 'disabled' : '';
	}
});


function editElement(_this, id) {
	var _from = $("#from_"+ id).val();
	var _to = $("#to_" + id).val();
	var _value = $("#value_" + id).val();
	_value = _value.replace("$ ", "");
	_value = _value.replace(".","");
	var _max = $("#max_" + id).val();
	
	$.get( "<?php echo (base_url('administrador/editPromoById')); ?>", { id: id, vig_from:_from, vig_to:_to, value:_value, max_uses:_max} )
	.done(function( data ) {
		if(data == "true")
		{
			swal({
				title: "Listo!",
				text: "El registro fue actualizado exitosamente",
				type: "success" },
				function(){
					//window.location.reload();
				}
			);
		}
		else {
			swal({
				title: "Error!",
				text: "Se presentó un error al enviar tu solicitud. Intenta nuevamente.",
				type: "error" },
				function(){
					//window.location.reload();
				}
			);
		}
	});
}

function loadChilds(id) {
	window.location = "<?php echo (base_url('administrador/promociones/bitacora')); ?>/" + id;
}

function deleteElement(_this, id) {
	$(_this).attr("disabled","disabled");
	$.get( "<?php echo (base_url('administrador/deletePromoById')); ?>/" + id , { id: id } )
	.done(function( data ) {
		if(data == "true")
		{
			$("#tr_" + id).hide("100");
			swal({
				title: "Listo!",
				text: "El registro fue eliminado exitosamente",
				type: "success" },
				function(){
					//window.location.reload();
				}
			);
		}
		else {
			swal({
				title: "Error!",
				text: "Se presentó un error al enviar tu solicitud. Intenta nuevamente.",
				type: "error" },
				function(){
					//window.location.reload();
				}
			);
		}
	});
}

</script>