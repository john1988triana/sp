

var showLegal = window.location.hash;

function politicas(event)
{
	$( '#li_uso' ).removeClass( "active" );
	$( '#li_politicas' ).addClass( "active" );
	
	$( '#policy' ).addClass( "active" );
	$( '#use' ).removeClass( "active" );
	
}

function uso(event)
{
	$( '#li_politicas' ).removeClass( "active" );
	$( '#li_uso' ).addClass( "active" );
	
	$( '#policy' ).removeClass( "active" );
	$( '#use' ).addClass( "active" );
	
}


function loadUrl(location)
{
	console.log(location);
	this.document.location.href = location;
}