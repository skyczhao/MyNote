// book.js
// version 1.0 (Dec, 22th. 2012)
// created by chenzhao for web2.0 project

window.onload = function()
{
	var goodbut = document.getElementById( "good" );
	goodbut.addEventListener( 'click', addgood );
	var badbut = document.getElementById( "bad" );
	badbut.addEventListener( 'click', addbad );
	var addbut = document.getElementById( "addnote" );
	addbut.addEventListener( 'click', addnote);
}

function addgood( event )
{
	var goodpoint = document.getElementById('goodp');
	goodpoint.innerText = parseInt( goodpoint.innerText ) + 1;
	
	var $url = window.location.search;
	var $param = $url.split('=');
	var $did = $param[1];
	
	$.ajax({
		type: "post",
		url: "ajax/point.php",
		dataType: 'text',
		data: 'did=' + $did + "&op=good&point=" + goodpoint.innerText
	}
	);
}

function addbad( event )
{
	var badpoint = document.getElementById('badp');
	badpoint.innerText = parseInt( badpoint.innerText ) + 1;
	
	var $url = window.location.search;
	var $param = $url.split('=');
	var $did = $param[1];
	
	$.ajax({
		type: "post",
		url: "ajax/point.php",
		dataType: 'text',
		data: 'did=' + $did + "&op=bad&point=" + badpoint.innerText
	}
	);
}

function addnote( event )
{
	var $url = window.location.search;
	var $param = $url.split('=');
	var $did = $param[1];
	
	window.location.href = "EditNote.php?did=" + $did;
}