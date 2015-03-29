<div class="row code-gen-container">
	<div class="col-md-3 col-xs-3"></div>
	<div class="col-md-6 col-xs-6 div-area">
    <form method="post" id="form">
		<h3>Generador de Código promocional</h3>
        
        <?php 
			if(isset($error)){
		?>
        
        <div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          <?php  echo $error;?>
		</div>
		<?php 
			}
		?>


		<div class="row date-picker-gen">
			<div class=" col-md-6" id="datepicker">
				<h5>Desde:</h5>
				<input class="datepicker from" style="border:none;outline:none;" name="from" id="from" type="text" <?php if(isset($from)){ echo 'value="' . $from . '"';}?>></input>
			</div>
			<div class=" col-md-6">
				<h5>Hasta:</h5>
				<input class="datepicker to" style="border:none;outline:none;" name="to" id="to" type="text" <?php if(isset($from)){ echo 'value="' . $to . '"';}?>></input>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 input-value text-center">
				<h5>Valor: </h5>
				<input name="valor" id="valor" style="width:100px;" <?php if(isset($valor)){ echo 'value="' . $valor . '"';}?>>
			</div>
            <div class="col-md-6 input-value text-center">
				<h5>Usos permitidos: </h5>
				<input name="uses" id="uses" style="width:100px;" <?php if(isset($uses)){ echo 'value="' . $uses . '"';}?>>
			</div>
			<div class="col-md-3"></div>
		</div>
        
        <div class="row">
        	<div class="col-md-12 input-value text-center">
				<h5>Tipo de código: </h5>
				<select id="type_code" name="type_code">
                	<option value="0" <?php if(isset($type_code)){if($type_code == 0){ echo 'selected="selected"';}}?> >Auto generado</option>
                    <option value="1" <?php if(isset($type_code)){if($type_code == 1){ echo 'selected="selected"';}}?> >Manual</option>
                </select>
			</div>
        </div>
		
        
        <div class="row text-center" id="generate">
        	<div class="col-md-12">
            	<input class="btn-busqueda-profe btn-profe btn col-lg-12" style="margin-top:0px;" type="submit" id="generate_action" name="generate_action" value="Generar código">
                <!--a onClick="random_code();"><div class="btn btn-profe btn-gen-code">Generar Codigo</div></a-->
            </div>
        </div>
        
        <div class="row" id="created">
        	<div class="col-md-4">
           	  <input class="btn-busqueda-profe btn-profe btn col-lg-12" style="margin-top:0px;" type="submit" id="create_action" name="create_action" value="Guardar código">
                <!--a onClick="random_code();"><div class="btn btn-profe btn-gen-code">Generar Codigo</div></a-->
            </div>
            <div class="col-md-8 background-code text-center" style="padding-left:0px; padding-right:0px;"><input name="code" id="code" style="width:100%; text-align:center; background-color:transparent;border: none; height: 35px; font-size: 25px; color: #009966;"></div>
        </div>
		</form>
  </div>
	<div class="col-md-3 col-xs-3"></div>
</div>

<link rel='stylesheet' href="<?php echo base_url("assets/js/datepicker/css/datepicker.css"); ?>"></link>
<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />
<script src="<?php echo base_url("assets/js/datepicker/js/bootstrap-datepicker.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/fullcalendar.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lang/es.js");?>"></script>
<script type="text/javascript">
		var num = Math.floor(Math.random() * 9000000) + 1000000;
		
		function random_code () {
		document.querySelector("#codigo-promocional").innerHTML = "" + num + "";
		}
	</script>
<script>

	$(function() {
		
		if($("#type_code").val() == 0){
			$("#created").hide();
			$("#generate").show();
		}
		else {
			$("#created").show();
			$("#generate").hide();
		}
		
	    $( "#from" ).datepicker()
	    .on('changeDate', function (ev) {
	    	var _fromdate = $('#from').val();
         	
	    	$( "#to" ).val(_fromdate);
	    	$("#to").datepicker({
			    startDate: _fromdate ,
			});
	    });
	   	
		$("#valor").autoNumeric('init', {mDec:'0', aSep: '.', aDec: ',', aSign: '$ '});
		
		$("#type_code").change(function(){
			if($("#type_code").val() == 0){
				$("#created").hide(500);
				$("#generate").show(500);
			}
			else {
				$("#created").show(500);
				$("#generate").hide(500);
			}
			
		});
  	});

</script>
