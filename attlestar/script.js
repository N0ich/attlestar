function	aff_map() {
	map = file("aff_map.php");
	document.getElementById('map').innerHTML = map;
}

function	move(x, y) {
	newmap = file("move.php?x="+ x +"&y=" + y);
	document.getElementById('map').innerHTML = newmap;
	fire();
}

function	rot(x, y) {
	newmap = file("rot.php?x="+ x +"&y=" + y);
	document.getElementById('map').innerHTML = newmap;
	fire();
}

function	fire() {
	newmap = file("fire.php");
	document.getElementById('map').innerHTML = newmap;
}

function	damage(x, y) {
	newmap = file("damage.php?x="+ x +"&y=" + y);
	document.getElementById('map').innerHTML = newmap;
}

function	highlight(x, y) {
	newmap = file("highlight.php?x="+ x +"&y=" + y);
	document.getElementById('map').innerHTML = newmap;
}

function	rotate(x, y) {
	newmap = file("rotate.php?x="+ x +"&y=" + y);
	document.getElementById('map').innerHTML = newmap;
}

function	file(fichier) //Fonction de traitement AJAX
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

function	endofturn() {
	file('endofturn.php');
	player = file('player.php');
	document.getElementById('alert').innerHTML = player;
	aff_map();
	setTimeout('endofturn()', 20000);
}

function	leave() {
	choice = confirm("Voulez-vous vraiment quitter la partie?");
	if (choice == true) {
		//leave
	}
}
