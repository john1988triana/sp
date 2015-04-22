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
	            		<th>Horas</th>
	        		</tr>
	    		</thead>	
	    		<tbody>
	    			<?php foreach($sol as $s){ ?>
	    			<tr>
	    				<td><?php echo $s["fecha"]; ?></td>
	    				<td><?php echo $s["rsol"]; ?></td>
						<?php $found = false; foreach($prog as $p): 
							if ($s["fecha"] == $p["fecha"]): ?>
								<td><?= $p["rpro"]; ?></td><?php $found = true; break; ?>
							<?php endif; ?>
						<?php endforeach;
							if($found == false): ?>
								<td>0</td>
							<?php endif;
						?>
						<?php foreach($hor as $h): 
							if ($s["fecha"] == $h["fecha"]): ?>
								<td><?= $h["horas"]; ?></td><?php $found = true; break; ?>
							<?php endif; ?>
							<?php endforeach;
							if($found == false): ?>
								<td>0</td>
							<?php endif;
						?>
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
	    			foreach($hor as $h){ ?>
	    			<tr>
	    				<td><?php echo $h["fecha"]; ?></td>
	    				<td><?php echo $h["horas"]; ?></td>
	    			</tr>
	    			<?php }
	    			?>
	    		</tbody>
				</table>
			</div>
		</div>
	</div>
</div>