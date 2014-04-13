<?php
	include('../includes/config.php');
	session_start();
	if ($_SESSION['id'] && $_GET['player']) {
		if ($_GET['player'] == "2" || $_GET['player'] == "3" || $_GET['player'] == "4") {
			$db = connect();
			$myquery = "SELECT ".$_GET['player']."player FROM lobby";
			$query = $db->query($myquery);
			$data = $query->fetch();

			if ($data[$_GET['player']."player"]) {
				$tab = explode(',', $data[$_GET['player']."player"]);
				for ($i = 0; $tab[$i] != $_SESSION['id'] && $i < count($tab); $i++);
				if (!$tab[$i]) {
					$newparse = $data[$_GET['player']."player"].",".$_SESSION['id'];
					$myquery = "UPDATE lobby SET `".$_GET['player']."player` = '".$newparse."'";
					$query = $db->query($myquery);
				}
			} else
				$db->query('INSERT INTO lobby('.$_GET['player'].'player) VALUES("'.$_SESSION['id'].'")');
		}
	}
?>
