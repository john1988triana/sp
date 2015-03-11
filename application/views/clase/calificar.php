<section class="container text-center" style="margin-top:120px;">
	
	<h1>Califica a tu <span><?php if($type == 1){
				echo "Profesor";
			}else{
				echo "Estudiante";
			}?></span></h1>
	<div class="row">
		<div class="div-area col-md-12 text-center" style="margin-top:20px;">
			<div class="col-md-6 text-center">
			<h3><span><?php if($type == 1){
				echo "Profesor";
			}else{
				echo "Estudiante";
			}?></span> <?php if($type == 1){
				echo $pFName ." ".$pLName;
			}else{
				echo $sFName ." ".$sLName;
			}?></h3>
			</div>
            
            <?php
			
			if(($type == 1) && ($rate > 0))
			{
				?>
                <div class="col-md-6">
					<h3>Ya se evaluó el profesor. Muchas gracias.</h3>
				</div>
                
            <?php
			}
			else if(($type == 2) && ($student_rate > 0)){
				?>
                <div class="col-md-6">
					<h3>Ya se evaluó el estudiante. Muchas gracias.</h3>
				</div>
                
            <?php
			}
			else {
			?>
			
          <div class="col-md-6">
				<div class="rating">
					<span id="star_5">★</span>
					<span id="star_4">★</span>
					<span id="star_3">★</span>
					<span id="star_2">★</span>
					<span id="star_1">★</span>
				</div>
			</div>
            
            <script>
				
            $("#star_1").click(function(){
				$("#star_1").addClass("rating_up");
				$("#star_2").removeClass("rating_up");
				$("#star_3").removeClass("rating_up");
				$("#star_4").removeClass("rating_up");
				$("#star_5").removeClass("rating_up");
				$("#rate").val("1");
			});
			$("#star_2").click(function(){
				$("#star_1").addClass("rating_up");
				$("#star_2").addClass("rating_up");
				$("#star_3").removeClass("rating_up");
				$("#star_4").removeClass("rating_up");
				$("#star_5").removeClass("rating_up");
				$("#rate").val("2");
			});
			$("#star_3").click(function(){
				$("#star_1").addClass("rating_up");
				$("#star_2").addClass("rating_up");
				$("#star_3").addClass("rating_up");
				$("#star_4").removeClass("rating_up");
				$("#star_5").removeClass("rating_up");
				$("#rate").val("3");
			});
			$("#star_4").click(function(){
				$("#star_1").addClass("rating_up");
				$("#star_2").addClass("rating_up");
				$("#star_3").addClass("rating_up");
				$("#star_4").addClass("rating_up");
				$("#star_5").removeClass("rating_up");
				$("#rate").val("4");
			});
			$("#star_5").click(function(){
				$("#star_1").addClass("rating_up");
				$("#star_2").addClass("rating_up");
				$("#star_3").addClass("rating_up");
				$("#star_4").addClass("rating_up");
				$("#star_5").addClass("rating_up");
				$("#rate").val("5");
			});
            
            </script>
            <form id='form' method='POST'>
            
            <input name="rate" type="hidden" id="rate" value="0">
            
			<div class="col-md-6 col-md-offset-3" style="margin-top:40px;">
					<textarea name="comment" rows="2" class="form-control" id="comment" placeholder="Escribe una reseña corta de tu experiencia"></textarea>
					<input type="submit" class="btn-busqueda-profe btn-profe btn col-lg-12 busqueda_b" value="Calificar">
			</div>
            
          </form>
            
			<?php
			}
			?>
            
			
	  </div>

		

	</div>

</section>