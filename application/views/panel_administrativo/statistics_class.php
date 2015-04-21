<style>
	table{
		: inline;
	}
</style>
<div class="container body-admin">
	<h3 ><?php echo $title ?></h3>
	<div class="amigas-separator"></div>
		<div>
			<div class="col-md-12" style="margin-bottom:20px;">
            <table class="table table-striped table-bordered" style="font-size:12px;">
  			<thead>
        		<tr>
            		<th>Fecha</th>
            		<th>Solicitadas</th>
        		</tr>
    		</thead>	
    		<tbody>
    			<?php 
    			foreach($sol as $s){ ?>
    			<tr>
    				<td><?php echo $s["fecha"]; ?></td>
    				<td><?php echo $s["rsol"]; ?></td>
    			</tr>
    			<?php }
    			?>
    		</tbody>
			</table>
			<table class="table table-striped table-bordered" style="font-size:12px;">
  			<thead>
        		<tr>
            		<th>Fecha</th>
            		<th>Solicitadas</th>
        		</tr>
    		</thead>	
    		<tbody>
    			<?php 
    			foreach($sol as $s){ ?>
    			<tr>
    				<td><?php echo $s["fecha"]; ?></td>
    				<td><?php echo $s["rsol"]; ?></td>
    			</tr>
    			<?php }
    			?>
    		</tbody>
			</table>
			</div>
		</div>
	</div>
</div>