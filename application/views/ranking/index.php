
<h1 class="center-block text-center" style="margin-top:150px;">Ranking Superprofes</h1>

<div class="container margin-top" style="margin-top:30px;">
		

<!-- ====================  Inicio Template  ========================= -->


		
	<?php
	
	function getMonth($month_id) {
		$names = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
		return $names[$month_id-1];
	}
	$counter_general = 0;
	$change = 1;
	$prev = 0;
	$counter = 0;
	$first = true;
	
	foreach($ranking as &$rank){
		
		$counter_general++;
	?>
    
    <?php
		
		if($prev != $rank["month"]) {
			$change = 1;
			$counter = 0;
		}
		else {
			$change = 0;
		}
		
		$counter++;
		
		$prev = $rank["month"];
		
		if($change == 1) {
	?>
    
    <?php
	if($first == false){
	?>
    			</tbody>
			</table>
        
        </div>
    </div>
    
    <?php
	}
	?>
    
    <div class="row">
    	<h2 class="center-block text-center" style="margin-top:70px;margin-bottom:30px;font-size:28pt;"><?php echo getMonth($rank["month"])?> <?php echo $rank["year"]?></h2>
    	<div class="rank-table">
        	<table class="table table-hover"  valign="center">
				<thead>
			    	<tr>
			        	<th>#</th>
			          	<th>Superprofe</th>
			          	<th>Nombre</th>
			          	<th>Puntaje<br>(Horas de clase)</th>
			          	<th class="mobile-hide">Estrellas</th>
			    	</tr>
			    </thead>
			    <tbody>
        		  
	<?php
		}
	?>    
    	
                <tr>
                  <th scope="row text-center"><?php echo $counter;?></th>
                  <td><img class="img-profile img-ranking" style="margin: 0px auto;" src="<?php echo base_url($rank["picture"]);?>"></td>
                  <td><?php echo $rank["firstName"];?> <?php echo $rank["lastName"];?></td>
                  <td><?php echo $rank["ranking"];?></td>
                  <td class="mobile-hide">
                    <div class="estrellas">
                    	<?php
							switch($rank["level"]){
								case 1:	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
										break;
								case 2: echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
										break; 
								case 3:	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
										break;
								case 4:	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #cccccc;"></span>';
										break;
								case 5:	echo '<span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span> 
                        <span class="glyphicon glyphicon-star" style="color: #ffcc00;"></span>';
										break;
							}
						?>
                        
                    </div>
                </td>
                </tr>
       
    <?php
	if($counter_general == count($ranking)){
	?>
    			</tbody>
			</table>
        
        </div>
    </div>
    
    <?php
	}
	?>
                
    <?php
		$first = false;
	?>              
     
    	   
	<?php	   
	}
	?>
        
        
</div>



<!-- ====================  Fin Template  ========================= -->




	<style type="text/css">


		.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
		  
		  vertical-align: middle;
		  text-align: center;
		  
		}

	</style>