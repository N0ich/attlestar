<?php
	include('../includes/config.php');
	$db = connect();
	$query = $db->query('SELECT '.$_GET['player'].'player FROM lobby');
	$query = $query->fetch();
	if (count(explode(',', $query[$_GET['player']."player"])) == $_GET['player'])
		echo "ok";
	else
		echo "Veuillez patienter, ".(count(explode(',', $query[$_GET['player']."player"])) - 1)." joueurs trouves...";
?>
