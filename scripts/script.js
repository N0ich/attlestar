function file(fichier) //Fonction de traitement AJAX
{
	if(window.XMLHttpRequest) // FIREFOX
		xhr_object = new XMLHttpRequest();
	else if(window.ActiveXObject) // IE
		xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
	else
		return(false);
	xhr_object.open("GET", fichier, false);
	xhr_object.send(null);
	if(xhr_object.readyState == 4) 
		return(xhr_object.responseText);
	else 
		return(false);
}

function	efface() {
	document.getElementById('message').value = "";
}

function	envoi(message) {
	result = file('/php/shoutbox.php?message=' + message);
	document.getElementById('chat').innerHTML = result;
	element = document.getElementById('chat');
	element.scrollTop = element.scrollHeight;
	setTimeout("envoi('2e36f5748d06238ecb29f42458090a4d')", 5000);
}
