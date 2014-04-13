<?php
	include('includes/header.php');
	include('includes/play.php');
?>
<div class="content">
	<h1>Jouer!</h1>
	<h3>Nombre de joueurs</h3>
	<select id="player">
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
	</select>
	<input type="submit" value="Chercher des adversaires!" onclick="lobby()">
	<div id="wait_players"></div>
</div>
