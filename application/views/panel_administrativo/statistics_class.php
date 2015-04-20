<div style="margin-top:120px">

<h3>Calendario</h3>

<div id="calendar" style="width:80%; margin:auto;"></div>
<?php var_dump($Todos); ?>
</div>
<link rel='stylesheet' href="<?php echo base_url("assets/css/fullcalendar.min.css"); ?>" />
<script src="<?php echo base_url("assets/js/calendar/lib/moment.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/fullcalendar.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/calendar/lang/es.js");?>"></script>
<script>
$(document).ready(function(){
	var base_url = "<?php echo base_url();?>";
	var date = new moment();
	//$.get(base_url+"administrador/statisticClass",function(resp){
	//	var classList = JSON.parse(resp);
	//	for(var i in classList){
	//		classList[i].title = "Clase de "+classList[i].topic +" en "+classList[i].address;
	//	}
		$('#calendar').fullCalendar({
			firstDay:1,
			lang:"es",
			allDaySlot:false,
			slotDuration:"01:00:00",
			axisFormat:'h(:mm)a',
			minTime:"07:00:00",
			maxTime:"21:00:00",
			height:"auto",
			eventColor:"#003333",
			//events: classList,
			selectable: false,
			editable: true,
			selectOverlap: false,
			slotEventOverlap : false,
			defaultView: "month",
			header: {
					left:   'title',
					center: '',
					right:  'month, today prev,next'
				}
		});
	//});
});
	
	
</script>