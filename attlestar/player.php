<?php
	include('../includes/config.php');

	session_start();
	$db = connect();
	$tab = unserialize($_SESSION['players']);
	$query = $db->query('SELECT player FROM game WHERE id = '.$_SESSION['id_game']);
	$data = $query->fetch();
	$player = $tab[$data['player']];
	$query2 = $db->query('SELECT login FROM users WHERE id = '.$player);
	$data = $query2->fetch();
	echo "<h1>Player: ".$data['login']."</h1>";
	if ($player == $_SESSION['id'])
		echo "<button onclick='endofturn()'>Finir mon Tour</button><br />";
	echo "<button onclick='leave()'>Quitter la partie</button>";
?>
