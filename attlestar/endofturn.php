<?php
	include('../includes/config.php');
session_start();
$players = unserialize($_SESSION['players']);
if ($_SESSION['id'] == $players[1]) {
	$db = connect();
	$query = $db->query('SELECT player FROM game WHERE id = '.$_SESSION['id_game']);
	$query = $query->fetch();
		if ($query['player'] == $players[0]) {
			$result = 1;
		} else {
			$result =  $query['player'] + 1;
		}
		$db->query('UPDATE game SET player = '.$result.' WHERE id = '.$_SESSION['id_game']);
		$db = NULL;
		echo "Player: $result";
}
?>
