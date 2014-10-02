function	send(response) {
	$("#main #console #text").append(response + "<br />");
	$("#main #console #text").animate({ scrollTop: $("#main #console #text")[0].scrollHeight}, 1000);
}

$(document).ready(function(){

	function	shell(command) {
		if (command == "hi")
			send("Hello !");
		else if (command == "go") {
			go = true;
			send("Moving Ship...");
		}
		else
			send("Command unknown.");
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
