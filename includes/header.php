<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="style/style.css">
		<link rel="stylesheet" type="text/css" href="style/compiled.css">
		<link rel="stylesheet" type="text/css" href="style/icomoon.css">
		<link rel="stylesheet" type="text/css" href="style/nav.css">

		<script src="scripts/script.js"></script>
	</head>
	<body>
		<div class="wrapper">
		<header>
			<!-- Menu -->
			<nav class="menu">
				<ul>
					<li><a href="index.php"><i class="icon-home2"></i>Home</a></li>
					<li><a href="ladder.php"><i class="icon-trophy"></i>Ladder</a></li>
					<?php
						if (!isset($_SESSION['id'])) { ?>
							<li><a href="inscription.php"><i class="icon-rocket"></i>Inscription</a></li>
							<li><a href="connexion.php"><i class="icon-key"></i>Connexion</a></li>
						<?php } else { ?>
							<li><a href="play.php"><i class="icon-pacman"></i>Jouer</a></li>
							<li><a href="profile.php?id=<?php echo $_SESSION['id']?>"><i class="icon-user"></i><?php echo $_SESSION['login'] ?></a></li>
							<li><a href="deconnexion.php"><i class="icon-switch"></i>Deconnexion</a></li>
						<?php } ?>
				</ul>
			</nav>
		</header>
		<hr class="custom">
