<style>
	table{
		: inline;
	}
</style>
<div class="container body-admin">
	<h3 ><?php echo $title ?></h3>
	<div class="amigas-separator"></div>
		<div>
			<div class="col-md-6" style="margin-bottom:20px;">
			<h3><?= "Clases" ?></h3>
	            <table class="table table-striped table-bordered" style="font-size:12px;">
	  			<thead>
	        		<tr>
	            		<th>Fecha</th>
	            		<th>Creadas</th>
	            		<th>Programadas</th>
	        		</tr>
	    		</thead>	
	    		<tbody>
	    			<?php foreach($sol as $s){ ?>
	    			<tr>
	    				<td><?php echo $s["fecha"]; ?></td>
	    				<td><?php echo $s["rsol"]; ?></td>
	    				<?php foreach($prog as $p){ ?>
						 <?php if ($s["fecha"] == $p["fecha"]){ ?>
						 		<td class="hola"><?php echo $p["rpro"]; ?></td>
						 		<?php break; ?>
						<?php }else{ ?>

						<?php }} ?>
	    			</tr>
	    			<?php } ?>
	    		</tbody>
				</table>
			</div>
			<div class="col-md-6" style="margin-bottom:20px;">	
	    		<h3><?= "Horas" ?></h3>
				<table class="table table-striped table-bordered" style="font-size:12px;">
	  			<thead>
	        		<tr>
	            		<th>Fecha</th>
	            		<th>Horas</th>
	        		</tr>
	    		</thead>	
	    		<tbody>
	    			<?php 
	    			foreach($hor as $p){ ?>
	    			<tr>
	    				<td><?php echo $p["fecha"]; ?></td>
	    				<td><?php echo $p["horas"]; ?></td>
	    			</tr>
	    			<?php }
	    			?>
	    		</tbody>
				</table>
			</div>
		</div>
	</div>
</div>