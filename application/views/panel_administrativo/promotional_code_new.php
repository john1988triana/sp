<div class="row code-gen-container">
	<div class="col-md-3 col-xs-3"></div>
	<div class="col-md-6 col-xs-6 div-area">
		<h3>Click para generar Codigo promocional</h3>
		<div class="col-md-4">
			<a onClick="random_code();"><div class="btn btn-profe btn-gen-code">Generar Codigo</div></a>
		</div>
		<div class="col-md-8 background-code"><span id="codigo-promocional"></span></div>
	</div>
	<div class="col-md-3 col-xs-3"></div>
	<script type="text/javascript">
		var num = Math.floor(Math.random() * 900000) + 100000;
		function random_code () {
		document.querySelector("#codigo-promocional").innerHTML = "" + num + "";
		}
	</script>
</div>