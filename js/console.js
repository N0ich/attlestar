function	send(response) {
	$("#main #console #text").append(response + "<br />");
	$("#main #console #text").animate({ scrollTop: $("#main #console #text")[0].scrollHeight}, 1000);
}

$(document).ready(function(){

	function	shell(command) {
		com = command.split(' ');
		if (com[0] == "hi")
			send("Hello !");
		else if (com[0] == "move") {
			move(com[1], com[2], com[3]);
		}
		else
			send("("+ com[0] +")Command unknown.");
	}

	$("#main #console input").keydown(function(event){
		var		value;
		if (event.which == 13) {
			event.preventDefault();
			value = $("#main #console input").val();
			$("#main #console #text").append("> " + value + "<br />");
			$("#main #console input").val("");
			shell(value);
		}
	})
});
