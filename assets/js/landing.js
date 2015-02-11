$(document).on('ready', loadLanding);
var showLegal;
function loadLanding()
{
    $('.openLegalModal').click(openLegalModal);
    $('#legal_modal').on('shown.bs.modal', function() {
        $('#legal_modal a[href="#'+showLegal+'"]').tab('show')
    });
	$(".text-center span").css("color","#00B85C")
	$(".btn-profe").mouseover(function() {
		$(".btn-profe b").css("color","#00B85C")
	})
	$(".btn-estu").mouseover(function() {
		$(".btn-estu b").css("color","#143D29");
	})
	$(".btn-profe").mouseout(function() {
		$(".btn-profe b").css("color","#143D29")
	})
	$(".btn-estu").mouseout(function() {
		$(".btn-estu b").css("color","#00B85C");
	})
	$("#date").datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
		startDate: "+0d",
		language: "es",
		});
}
function openLegalModal()
{
    showLegal= this.hash.substr(1);
    console.log("di clic en "+ showLegal);
}




