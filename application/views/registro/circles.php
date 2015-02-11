<div class="container" style="margin-top:120px">
<?php if($circles == 2): ?>
	<div class="row steps-center">
		<div class="col-md-12" id="circles" >
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn1_ok.png'));?>" alt="">
				<p class="text-center"> Reg&iacute;strate </p>
			</div>
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn2.png'));?>" alt="">
				<p class="text-center">Completa tus datos</p> 
			</div>
			<div class="col-md-3">			
				<img src="<?php echo (base_url('assets/img/btn3.png'));?>" alt="">
				<p class="text-center">Crea tu p&aacute;gina</p>
			</div>
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn4.png'));?>" alt="">
				<p class="text-center">Estamos validando tu cuenta</p>
			</div>  
		</div>
	</div>
<?php elseif($circles == 3): ?>
<div class="row steps-center">
		<div class="col-md-12" id="circles" style="">
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn1_ok.png'));?>" alt="">
				<p class="text-center">Reg&iacute;strate</p>
			</div>
			<div class="col-md-3">
			<a href="<?php echo (base_url('registro/datos_personales'));?>">
				<img src="<?php echo (base_url('assets/img/btn2_ok.png'));?>" alt="">
				<p class="text-center">Completa tus datos</p> 
			</a>
			</div>
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn3.png'));?>" alt="">
				<p class="text-center">Crea tu p&aacute;gina</p>
			</div>
			<div class="col-md-3">
				<a style="cursor:pointer" onclick="document.getElementById('mainform').submit(); event.preventDefault();">
					<img src="<?php echo (base_url('assets/img/btn4.png'));?>" alt="">
					<p class="text-center">Estamos validando tu cuenta</p>
				</a>
			</div>  
		</div>
	</div>
<?php elseif($circles == 4): ?>
	<div class="row steps-center">
		<div class="col-md-12" id="circles" style="">
			<!--<?php /*$condicion = ($data_user[0]['DayBorn'] || $data_user[0]['Address'] || $data_user[0]['DocNumber'] || $data_user[0]['Phone'] != 'NULL');*/?>-->
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn1_ok.png'));?>" alt="">
				<p class="text-center"> Reg&iacute;strate </p>
			</div>
			<div class="col-md-3">
			  <a href="<?php echo (base_url('registro/datos_personales'));?>">
				<img src="<?php echo (base_url('assets/img/btn2_ok.png'));?>" alt="">
				<p class="text-center">Completa tus datos</p> 
			  </a>
			</div>
			<div class="col-md-3">
			  <a href="<?php echo (base_url('registro/crea_pagina'));?>">
				<img src="<?php echo (base_url('assets/img/btn3_ok.png'));?>" alt="">
				<p class="text-center">Crea tu p&aacute;gina</p>
			  </a>
			</div>
			<div class="col-md-3">
				<img src="<?php echo (base_url('assets/img/btn4.png'));?>" alt="">
				<p class="text-center">Estamos validando tu cuenta</p>
			</div>  
		</div>
	</div>
<?php endif; ?>
</div>