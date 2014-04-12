<?php
	include('/includes/config.php');

	function	isplayer($name) {
		$db = connect();
		$query = $db->prepare("SELECT login FROM users WHERE login = :login");
		$query->execute(array(
			'login' => $name
		));
		$data = $query->fetch();
		if ($data['login']) {
			return (true);
		}
		return (false);
	}

	function	inscription($name, $pass, $mail) {
		$db = connect();
		$query = $db->prepare('INSERT INTO users(login, password, mail) VALUES(:name, :pass, :mail)');
		$query->execute(array(
			'name' => $name,
			'pass' => sha1($pass),
			'mail' => $mail
		));
	}
?>
