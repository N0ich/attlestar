<?php
	session_start();
	include_once('../includes/config.php');

	function	show_chat() {
		$db = connect();
		$id = $_SESSION['id_game'];
		$mquery = "SELECT * FROM chat".$id;
		$query = $db->query($mquery);
		while ($data = $query->fetch()) {
			echo "<span class='hour'>".$data['time']."</span><i class='icon-user'></i>".$data['login']."<i class='icon-arrow-right2'></i> <span class='msg'>".$data['message']."</span><br />";
		}
	}

	if ($_SESSION['login']) {
		if ($_GET['message'] != "2e36f5748d06238ecb29f42458090a4d") {
			if ($_GET['message']) {
				date_default_timezone_set("Europe/Madrid");
				$db = connect();
				$query = $db->prepare('INSERT INTO chat'.$_SESSION['id_game'].'(login, message, time) VALUES(:login, :msg, :time)');
				$query->execute(array(
					'login' => $_SESSION['login'],
					'msg' => $_GET['message'],
					'time' => date("H:i")
				));
			}
		}
		show_chat();
	}
?>
