<?php
include('/includes/config.php');

	function	auth($login, $pass) {
		$db = connect();
		$query = $db->prepare("SELECT * FROM users WHERE login = :login");
		$query->execute(array(
			'login' => $login
		));
		$data = $query->fetch();
		if ($data['password'] == sha1($pass)) {
			$_SESSION['id'] = $data['id'];
			$_SESSION['login'] = $login;
			$_SESSION['mail'] = $data['mail'];
			$_SESSION['pwon'] = $data['pwon'];
			$_SESSION['ploose'] = $data['ploose'];
			return (true);
		}
		return (false);
	}
?>
