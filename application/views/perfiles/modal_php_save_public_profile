<div class="modal fade" id="agendar" tabindex="-1" role="dialog" aria-labelledby="agendar" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content popup-iniciar">

      <div class="modal-header">

		AGENDAR PROFESOR

        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

      </div>

      <div class="modal-body">




      	<form action="<?php echo base_url('busqueda')?>" method="get">
					
					<!--Tema especifico-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="tema">Escribe la Tem&aacute;tica que Requieres:</label>
							<input type="text" name="topic" id="topic" class="form-control col-md-9" placeholder="Ej: Factorización" value="<?php echo $topic ?>">
						</div>
							<div class="error"><?php echo $errors["topic"]; ?></div>
					</div>
					
					<!--Nivel especifico-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="tema">Escoge el nivel de la clase:</label>
							<select name="level" id="level" class="form-control col-md-9">
								<option value="">Nivel</option>
								<?php 
									foreach ($levels as $key => $value) {
								?> 
									<option value="<?php echo $value['id'];?>" <?php if($value['id']==$level){echo "selected";}?>>
										<?php echo utf8_decode($value['name']); ?>
									</option> 
								<?php
									}
								?>      
							</select>
						</div>
							<div class="error"><?php echo $errors["level"]; ?></div>
					</div>

					<!--Ciudad: este campo se trae desde la base de amigas-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="ciudad">En qu&eacute; Ciudad Quieres Tomar la Clase?:</label>
							<select name="city" id="city" class="form-control col-md-9">
								<option value="">Ciudad</option>
								<?php 
									$cities = json_decode($cities, true);
									$cities = json_decode($cities['cities'], true);
									foreach ($cities as $key => $value_cities) {
								?> 
									<option value="<?php echo $value_cities['ID'];?>" <?php if($value_cities['ID']==$city){echo "selected";}?>>
										<?php echo utf8_decode($value_cities['Name']); ?>
									</option> 
								<?php
									}
								?>      
							</select>
						</div>
							<div class="error"><?php echo $errors["city"]; ?></div>
					</div>

					<!--Tema especifico-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="tema">Escribe la Direcci&oacute;n Donde vas a Tomar la Clase:</label>
							<input type="text" name="address" id="address" class="form-control col-md-9" value="<?php echo $address;?>">						
						</div>
							<div class="error"><?php echo $errors["address"]; ?></div>
					</div>
					
					<!--Teléfono-->
					<div class="row">
						<div class="col-md-12 txt-busqueda">
							<label for="tema">Escribe tu tel&eacute;fono:</label>
							<input type="text" name="phone" id="phone" class="form-control col-md-9" value="<?php echo $phone;?>">						
							
						</div>
						<div class="error"><?php echo $errors["phone"]; ?></div>
					</div>
					
					<!--Boton buscar que ejecuta la consulta-->
					<div class="row">
						<div class="col-md-12">
							<label for=""></label>
							<input type="submit" class="btn-busqueda-profe btn-profe btn col-lg-12 busqueda_b" value="Agendar Profesor">
						</div>
					</div>
					</form>






      </div>

      <div class="modal-footer">

        

      </div>

    </div>

  </div>
</div>
