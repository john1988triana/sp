
<div class="jumbotron jumbo-landing">
	<div class="img-land">
		<div class="container">
		  	<h1>Profesores Particulares<br>
			<span>de <?php echo $topic_no_sign;?></span></h1>
	  	</div>
  	</div>
</div>

<section class="container-fluid landing-check">
	
	<div class="col-md-12 check-title">
		<h2>En Super<wbr>Profe encuentras el Profesor
que necesitas para...</h2>
	</div>
	<div class="col-md-12">
		<div class="col-md-7">
			<h3>
				<ul>
					<li><img src="../assets/img/checkicon.png">Clases Particulares de <span><?php echo $topic;?></span></li>
					<li><img src="../assets/img/checkicon.png">Refuerzo Académico </li>
					<li><img src="../assets/img/checkicon.png">Apoyo Escolar</li>
					<li><img src="../assets/img/checkicon.png">Preparar un Examen o un Parcial</li>
					<li><img src="../assets/img/checkicon.png">Tomar tu clase ya sea a domicilio o virtual</li>
				</ul>
				El costo de la hora de los profesores oscila entre <span>$25.000</span> y <span>$35.000</span> pesos.
			</h3>

		</div>
		<div class="col-md-3">
			<div class="circle-mask">
				<img class="img-area" src="<?php echo base_url("assets/img/" . $url_image);?>">
			</div>
		</div>	
	</div>
</section>
<hr id="separador-busqueda-landing">
<section class="container" id="results-section">
    
<h2 class="text-center letra-profes">ALGUNOS DE NUESTROS SUPERPROFES DE <?php echo $topic_no_sign?></h2>
<div class="container text-center" style="height:40px;">
Ordena por:   <select name="order_select" id="order_select">
  <option value="nombre" selected="selected">Nombre</option>
  <option value="rating">Rating</option>
  <option value="precio">Precio</option>
  <option value="nivel">Nivel</option>
</select>
</div>

  <div class="container" id="container_teachers">
		<div class="row">

			<div class="col-md-3">
				<div class="panel-default panel-perfil panel-perfil center-block">                                            
				<h3 class="text-center tt-txt-panel-perfil" style="color:#009966;">Miller E. Hernández</h3>
					<div class="panel-body text-center">
						<img class="img-profile" style="margin: 0px auto;" src="<?php echo base_url("assets/img/profesor-miller-matematicas.png");?>">
						<div class="estrellas">
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>    
						</div>
						<div class="medallas-profesor">
							<img src="<?php echo base_url("assets/img/medallas/1.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/2.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/3.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/4.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/5b.svg");?>" alt="" class="no-medalla">
						</div>
						<h3 class="medalla-tag">Experto</h3>

						<h4 class="par txt-panel-perfil">Bogotá</h4>  
						<h4 class="par txt-panel-perfil">Licenciado en Física</h4>    
						<h4 class="par txt-panel-perfil">Algebra</h4>
						<h4 class="par txt-panel-perfil">precio: <span style="color: rgb(0, 184, 92);"> $ 35.000 </span></h4>
					</div>
					<div class="cta-perfil-profesor"><h3>ver perfil</h3></div>
				</div>
			</div>


			<div class="col-md-3">
				<div class="panel-default panel-perfil panel-perfil center-block">                                            
				<h3 class="text-center tt-txt-panel-perfil" style="color:#009966;">Carolina Suárez</h3>
					<div class="panel-body text-center">
						<img class="img-profile" style="margin: 0px auto;" src="<?php echo base_url("assets/img/profesora-carolina-matematicas.png");?>">
						<div class="estrellas">
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: grey;"></span>    
						</div>
						<div class="medallas-profesor">
							<img src="<?php echo base_url("assets/img/medallas/1.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/2.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/3.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/4b.svg");?>" alt="" class="no-medalla">
							<img src="<?php echo base_url("assets/img/medallas/5b.svg");?>" alt="" class="no-medalla">
						</div>
						<h3 class="medalla-tag" style="color: #FE544B;">Master</h3>

						<h4 class="par txt-panel-perfil">Bogotá</h4>  
						<h4 class="par txt-panel-perfil">Estadísta</h4>    
						<h4 class="par txt-panel-perfil">Algebra</h4>
						<h4 class="par txt-panel-perfil">precio: <span style="color: rgb(0, 184, 92);"> $ 35.000 </span></h4>
					</div>
					<div class="cta-perfil-profesor"><h3>ver perfil</h3></div>
				</div>
			</div>


			<div class="col-md-3">
				<div class="panel-default panel-perfil panel-perfil center-block">                                            
				<h3 class="text-center tt-txt-panel-perfil" style="color:#009966;">Daniel Sandoval</h3>
					<div class="panel-body text-center">
						<img class="img-profile" style="margin: 0px auto;" src="<?php echo base_url("assets/img/profesor-daniel-matematicas.png");?>">
						<div class="estrellas">
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: grey;"></span>    
						</div>
						<div class="medallas-profesor">
							<img src="<?php echo base_url("assets/img/medallas/1.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/2.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/3b.svg");?>" alt=""  class="no-medalla">
							<img src="<?php echo base_url("assets/img/medallas/4b.svg");?>" alt="" class="no-medalla">
							<img src="<?php echo base_url("assets/img/medallas/5b.svg");?>" alt="" class="no-medalla">
						</div>
						<h3 class="medalla-tag" style="color: #38A5CE;">Profesional</h3>

						<h4 class="par txt-panel-perfil">Bogotá</h4>  
						<h4 class="par txt-panel-perfil">Estudiante de Economía</h4>    
						<h4 class="par txt-panel-perfil">Algebra</h4>
						<h4 class="par txt-panel-perfil">precio: <span style="color: rgb(0, 184, 92);"> $ 30.000 </span></h4>
					</div>
					<div class="cta-perfil-profesor"><h3>ver perfil</h3></div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel-default panel-perfil panel-perfil center-block">                                            
				<h3 class="text-center tt-txt-panel-perfil" style="color:#009966;">Daniel Sandoval</h3>
					<div class="panel-body text-center">
						<img class="img-profile" style="margin: 0px auto;" src="<?php echo base_url("assets/img/profesor-daniel-matematicas.png");?>">
						<div class="estrellas">
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
							<span class="glyphicon glyphicon-star" style="color: grey;"></span>    
						</div>
						<div class="medallas-profesor">
							<img src="<?php echo base_url("assets/img/medallas/1.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/2.svg");?>" alt="">
							<img src="<?php echo base_url("assets/img/medallas/3b.svg");?>" alt=""  class="no-medalla">
							<img src="<?php echo base_url("assets/img/medallas/4b.svg");?>" alt="" class="no-medalla">
							<img src="<?php echo base_url("assets/img/medallas/5b.svg");?>" alt="" class="no-medalla">
						</div>
						<h3 class="medalla-tag" style="color: #38A5CE;">Profesional</h3>

						<h4 class="par txt-panel-perfil">Bogotá</h4>  
						<h4 class="par txt-panel-perfil">Estudiante de Economía</h4>    
						<h4 class="par txt-panel-perfil">Algebra</h4>
						<h4 class="par txt-panel-perfil">precio: <span style="color: rgb(0, 184, 92);"> $ 30.000 </span></h4>
					</div>
					<div class="cta-perfil-profesor"><h3>ver perfil</h3></div>
				</div>
			</div>			

		</div>
	</div> 
</section>

<section>
	<div class="form-landing">
		<div class="container">
			<div class="col-md-6">
            
            	<form action="<?php echo base_url('registro/register'); ?>" role="form" class="form-horizontal" id="formRegUser" method="post">
                
				<h2>Registrate ya y empieza a <span>aprender.</span></h2>
                
                <div class="text-center" style="visibility:hidden;">
                      <p>
                        <label>
                          <input name="tipo_usuario" type="radio" id="tipo_usuario_0" value="acudiente">
                          soy Acudiente</label>
                        <label>
                          <input type="radio" name="tipo_usuario" value="estudiante" id="tipo_usuario_1" checked="checked">
                        soy Estudiante</label>
                        <br>
                      </p>
                    </div>
                
                
				<div class="form-group">
				  <label for="email">Email</label>
				  <input type="email" class="form-control" id="email" name="txtEmailNew" placeholder="Escribe tu email">
				</div>

				<div class="form-group">
				  <label for="fname">Nombre</label>
				  <input type="firstname" class="form-control" id="fname" name="txtName" placeholder="Escribe tu nombre">
				</div>

				<div class="form-group">
				  <label for="lname">Apellido</label>
				  <input type="lastname" class="form-control" id="lname" name="txtLast" placeholder="Escribe tu apellido">
				</div>
                
                <div class="form-group">
				  <label for="pass">Contraseña</label>
				  <input type="password" class="form-control" id="pass" name="txtPassword" placeholder="Escribe tu apellido">
				</div>
                
                <div class="form-group">
                	<label for="Pass2">Confirma tu contraseña</label>
					<input id="Pass2" name="txtPasswordConfirm" type="password" class="form-control" placeholder="Repite tu contraseña" required>
                </div>
                
                
                
                
				<div class="btn btn-lg landing-btn-form" onClick="submit();">Registrarme</div>
				<br>
				<br>
				<p>ó registrate con tu cuenta de</p>
				<a href=""><img src="<?php echo base_url("assets/img/facebook_icon.png");?>"></a>
				<a href=""><img src="<?php echo base_url("assets/img/google_icon.png");?>"></a>
                
                </form>
                
			</div>
		</div>
	</div>

<script>
$(document).ready(function(){
	
	$("#container_teachers").hide();
	
	$("#order_select").change(function(){
		
		$("#container_teachers").hide("200");
		
		loadData($(this).val());
	});
	
	function loadData(order){
		var topic = "";
		var area = 0;
		var level = 0;
		var row_count = 0;
		
		var type = "<?php echo $topic_no_sign;?>";
		var topic = "<?php echo $topic?>";
		
		switch(type) {
			case "Matematicas": area = 4;
					break;
			case "Fisica": area = 15;
					break;
			case "Quimica": area = 14
					break;
			case "Ingles": area = 5
					break;
			case "Refuerzo y Apoyo Escolar": area = 17
					break;
			case "Algebra": area = 4;
							level = 3
					break;
			case "Calculo": area = 4;
							level = 3;
					break;
			case "Estadistica": area = 4;
								level = 4;
					break;
			case "Contabilidad": area = 4;
								 level = 4;
					break;
		}
		
		
		var request = $.ajax({
			url: "/bogota/getTeachers",
			method: "GET",
			data: { id_area : area, level: level, order: order },
			dataType: "json"
		});
		 
		request.done(function( msg ) {
			
			var pre_counter = 0;
			var _data = "";
			var _level = "";
			var _color = "";
			var _medal = "";
			var _stars = "";
			$("#container_teachers").html("");
			
			
			$.each(msg,function( index, value ) {
				
				switch(value.rate) {
				case "0":	_stars = '<span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
							break;
				case "1":	_stars = '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
							break;
				case "2":	_stars = '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
							break;
				case "3":	_stars = '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
							break;
				case "4":	_stars = '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
							break;
				case "5":	_stars = '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span><span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>';
							break;
			}
				
				switch(value.level) {
					case "1":_level = "Junior";
							_color = "#4164B3";
							_medal = '<img src="/assets/img/medallas/1.svg" alt=""><img src="/assets/img/medallas/2b.svg" alt="" class="no-medalla"><img src="/assets/img/medallas/3b.svg" alt="" class="no-medalla"><img src="/assets/img/medallas/4b.svg" alt="" class="no-medalla"><img src="/assets/img/medallas/5b.svg" alt="" class="no-medalla">';
							break;
					case "2":_level = "Profesional";
							_color = "#38A5CE";
							_medal = '<img src="/assets/img/medallas/1.svg" alt=""><img src="/assets/img/medallas/2.svg" alt=""><img src="/assets/img/medallas/3b.svg" alt="" class="no-medalla"><img src="/assets/img/medallas/4b.svg" alt="" class="no-medalla"><img src="/assets/img/medallas/5b.svg" alt="" class="no-medalla">';
							break;
					case "3":_level = "Master";
							_color = "#FE544B";
							_medal = '<img src="/assets/img/medallas/1.svg" alt=""><img src="/assets/img/medallas/2.svg" alt=""><img src="/assets/img/medallas/3.svg" alt=""><img src="/assets/img/medallas/4b.svg" alt="" class="no-medalla"><img src="/assets/img/medallas/5b.svg" alt="" class="no-medalla">';
							break;
					case "4":_level = "Experto";
							_color = "#FD931B";
							_medal = '<img src="/assets/img/medallas/1.svg" alt=""><img src="/assets/img/medallas/2.svg" alt=""><img src="/assets/img/medallas/3.svg" alt=""><img src="/assets/img/medallas/4.svg" alt=""><img src="/assets/img/medallas/5b.svg" alt="" class="no-medalla">';
							break;
					case "5":_level = "Elite";
							_color = "#FFC136";
							_medal = '<img src="/assets/img/medallas/1.svg" alt=""><img src="/assets/img/medallas/2.svg" alt=""><img src="/assets/img/medallas/3.svg" alt=""><img src="/assets/img/medallas/4.svg" alt=""><img src="/assets/img/medallas/5.svg" alt="">';
							break;
				}
				
				var html = '<div class="col-md-3"><div class="panel-default panel-perfil panel-perfil center-block"><h3 class="text-center tt-txt-panel-perfil" style="color:#009966;">' + value.firstName + ' ' + value.lastName + '</h3><div class="panel-body text-center"><img class="img-profile" style="margin: 0px auto; border-color:' + _color +'" src="/' + value.picture + '"><div class="estrellas">' + _stars + '</div><div class="medallas-profesor">' + _medal + '</div><h3 class="medalla-tag">' + _level + '</h3><h4 class="par txt-panel-perfil">Bogotá</h4><h4 class="par txt-panel-perfil perfil-titulo">' + value.title + '</h4><h4 class="par txt-panel-perfil">' + topic + '</h4><h4 class="par txt-panel-perfil">precio: <span style="color: rgb(0, 184, 92);"> $ ' + (Number(value.price) + Number(value.fee_sp)).toString() + ' </span></h4></div><div class="cta-perfil-profesor"><h3>ver perfil</h3></div></div></div>';
				
				
				if(pre_counter == 0) {
					pre_counter++;
					if(row_count > 0){
						_data = _data + '<div class = "row hide temp_hidden">';
					} 
					else {
						_data = _data + '<div class = "row">';
					}
					
					_data = _data + html;
				}
				else if(pre_counter < 3) {
					pre_counter++;
					_data = _data + html;
				}
				else if(pre_counter == 3) {
					pre_counter = 0;
					_data = _data + html;
					_data = _data + '</div>';
					if(row_count == 0){
						_data = _data + '<div class="row text-center ver_mas_bt"><h3>ver mas</h3></div>'
					}
					row_count++;
				}
			});
			
			$("#container_teachers").html(_data);
			
			
			$("#container_teachers").show("200");
			
			$(".ver_mas_bt").click(function(){
				$(".temp_hidden").hide();
				$(".ver_mas_bt").hide();
				$(".temp_hidden").removeClass("hide");
				$(".temp_hidden").show("100");
			});
			
		});
		 
		request.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		});
	}
	
	
	loadData("nombre");
	
});

</script>
	
</section>