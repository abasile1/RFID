function refresh() {
	$( "#here" ).load(window.location.href + " #here" );     
}
 
 
setInterval("refresh()", 3000) 

