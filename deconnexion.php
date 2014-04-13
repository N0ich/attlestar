<?php
	include('includes/config.php');
	session_start();
	$db = connect();
	$db->query('UPDATE users SET online = false WHERE id = '.$_SESSION['id']);
	$_SESSION['id'] = null;
	$_SESSION['login'] = null;
	$_SESSION['mail'] = null;
	$_SESSION['pwon'] = null;
	$_SESSION['ploose'] = null;
	session_destroy();
	header('Location: index.php?justdelog');
?>
