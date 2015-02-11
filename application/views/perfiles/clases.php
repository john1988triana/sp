<div style="margin-top:110px">
	<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist">
	<?php $actual = 0;
	foreach($classes as $class){
		if($class["status"] != $actual){
			foreach($states as $state){
				if($state["id"] == $class["status"]){
					echo '<li role="'.$state["name"].'" ';
					if($actual==0){
						echo 'class="active"';
					}
					echo '><a href="#'.$state["name"].'" aria-controls="'.$state["name"].'" role="tab" data-toggle="tab">'.$state["name"].'</a></li>';
				}
			}
			$actual = $class["status"];
		} 
	}
	?>
	</ul>
	</div>
	<div class="tab-content">
	<?php
		$actual = 0;
		foreach($classes as $class){
			if($class["status"] != $actual){
				foreach($states as $state){
					if($state["id"] == $class["status"]){
						if($actual!= 0){
							echo '</div>';
						}
						echo '<div role="tabpanel" class="tab-pane active" id="'.$state["name"].'"><h4>'.$state["name"].'</h4>';
						$actual = $class["status"];
						break;
					}
				}
			}
			?>
			<div class="well">
				<div class="panel panel-default" style="position:relative;">
					<div class="panel-heading">
						<h6><?php echo $class["pFName"].' '.$class["pLName"].' - '.$class["topic"];?></h6>
						<div style="position:absolute;top:10px;right:10px;width:90px;font-size:14px;" <?php if($class["status"]>=6){echo "class='star-editable'";}?>>
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=1){echo "style='color:#FFCC00;'";}?>></span>
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=2){echo "style='color:#FFCC00;'";}?>></span> 
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=3){echo "style='color:#FFCC00;'";}?>></span> 
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=4){echo "style='color:#FFCC00;'";}?>></span> 
							<span class="glyphicon glyphicon-star" <?php if($class["rate"]>=5){echo "style='color:#FFCC00;'";}?>></span>
						</div>
					</div>
					<div class="panel-body">
						<div class="col-md-7">
							<h5><b>Dirección:</b> <?php echo $class["address"];?></h5>
							<h5><b>Ciudad:</b> Bogotá - Colombia</h5>
							<h5><b>Número:</b> <?php echo $class["phone"];?></h5>
						</div>
						<div class="col-md-3">
							<div class="calendar-profile">
								<div class="align-img-calendar">
									<h4><?php echo date("l",strtotime($class["start"])); ?></h4>
									<h1 style="margin-top:10px;margin-bottom:0px;"><?php echo date("d",strtotime($class["start"])); ?></h1>
									<h6><?php echo date("F",strtotime($class["start"])); ?></h6>
									<h6><?php echo date("H:i",strtotime($class["start"])); ?> - <?php echo date("H:i",strtotime($class["end"])); ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<?php
		}
		?>
	</div>
</div>
<script>
$(document).ready(function(){
	
});
</script>