<div class="row code-gen-container">
	<div class="col-md-3 col-xs-3"></div>
	<div class="col-md-6 col-xs-6 div-area">
		<h3>Click para generar Codigo promocional</h3>
		<div class="row date-picker-gen">
			<div class=" col-md-6">
				<h5>Desde:</h5>
				<input class="datepicker from" style="border:none;outline:none;" name="from" id="from" type="text"></input>
			</div>
			<div class=" col-md-6">
				<h5>Hasta:</h5>
				<input class="datepicker to" style="border:none;outline:none;" name="to" id="to" type="text"></input>
			</div>
		</div>
		
		<div class="col-md-4">
			<a onClick="random_code();"><div class="btn btn-profe btn-gen-code">Generar Codigo</div></a>
		</div>
		<div class="col-md-8 background-code"><span id="codigo-promocional"></span></div>
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
		var num = Math.floor(Math.random() * 900000) + 100000;
		function random_code () {
		document.querySelector("#codigo-promocional").innerHTML = "" + num + "";
		}
	</script>
<script>

	$(function() {
	    $( "#from" ).datepicker({
	      onChange: function( selectedDate ) {
	      	alert("cerrando");
	        $( "#to" ).datepicker( "option", "minDate", selectedDate );
	      }
	    });
	    $( "#to" ).datepicker({
	      onChange: function( selectedDate ) {
	        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
	      }
	    });
  	});

</script>
