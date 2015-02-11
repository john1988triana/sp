<section class="container" style="margin-top:120px;">
	<br><br><h1 class="text-center asi-funciona"><span style="color: rgb(0, 184, 92);">¿CÓMO ESTUVO TU CLASE?</span></h1>
	<div class="col-md-12 div-area">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h4 class="text-center">
			<?php if($type == 1){
				echo "Hola ".$sFName ." ".$sLName;
			}else{
				echo "Hola ".$pFName ." ".$pLName;
			}?>
			</h4>
			<p>
			<?php if($type == 1){
					if($rate!=0){
						echo "Gracias por calificar tu clase de ".$topic. " con el profesor ".$pFName;
					}else{
						echo "Esperamos que te haya ido muy bien en tu clase de ". $topic .", que hayas aprendido mucho.";
					}
				}else{
					if($student_rate!=0){
						echo "Gracias por calificar tu clase de ".$topic. " con el estudiante ".$sFName;
					}else{
						echo "Esperamos que te haya ido muy bien en tu clase de ". $topic .", que hayas aprendido mucho.";
					}
				}
			?>
			</p>
			
			<?php if($type == 1){
				if($rate==0){
				echo "<p>Califica de 1 a 5 a tu profesor ".$pFName ." ".$pLName ."</p>";
				echo "<form id='form' method='POST'>";
				echo '<div class="estrellas">
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span> 
										<span class="glyphicon glyphicon-star"></span> 
										<span class="glyphicon glyphicon-star"></span> 
										<span class="glyphicon glyphicon-star"></span>    
									</div>';
				echo "<div id='error' style='display:none;color:#f00;'>Debes elegir una estrella</div>";
				echo "<p> Y deja una felicitación o recomendación para el profesor</p>";
				echo "<input name='rate' type='hidden'></input>";
				echo "<textarea name='comment' ></textarea>";
				echo "<button type='button'>Calificar</butotn>";
				echo "</form>";
				}
			}else{
				if($student_rate==0){
				echo "<p>Califica de 1 a 5 a tu estudiante ".$sFName ." ".$sLName ."</p>";
				echo "<form id='form' method='POST'>";
				echo '<div class="estrellas">
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span> 
										<span class="glyphicon glyphicon-star"></span> 
										<span class="glyphicon glyphicon-star"></span> 
										<span class="glyphicon glyphicon-star"></span>    
									</div>';
				echo "<div id='error' style='display:none;color:#f00;'>Debes elegir una estrella</div>";
				echo "<p>Y deja un comentario o recomendación sobres clase para que ".$sFName." pueda mejorar su proceso de aprendizaje</p>";
				echo "<input name='student_rate' type='hidden'></input>";
				echo "<textarea name='student_comment' ></textarea>";
				echo "<button type='button'>Calificar</butotn>";
				echo "</form>";
				}
			}?>
		</div>
	</div>
	<script>
		var rate= 0;
		$("button").click(function(){
			if(rate==0){
				$("#error").show();
			}else{
				$("#error").hide();
				$("form").submit();
			}
		});
		$(".glyphicon-star").click(function(){
			rate = $(".glyphicon-star").index(this);
			$("#form input").val(rate+1);
		});
		$(".glyphicon-star").mouseover(function(){
			var index = $(".glyphicon-star").index(this);
			for(var i = 0 ; i <=index ; i++){
				$($(".glyphicon-star")[i]).css("color","#FFCC00");
			}
		});
		$(".estrellas").mouseout(function(){
			$(".glyphicon-star").css("color","");
			for(var i = 0 ; i <=rate ; i++){
				$($(".glyphicon-star")[i]).css("color","#FFCC00");
			}
		});
	</script>
</section>