<?php 
	include('includes/header.php');
	include('includes/config.php');
	include('includes/auth.php');
?>
<?php
	if (isset($_POST['login']) && isset($_POST['password'])) {
		if (auth($_POST['login'], $_POST['password']) == true) {
			header('Location:index.php?justlogged');
		} else {
			echo "<div class='alert error'>Mauvais details de connexion :(</div>";
		}
	}
?>

<div class="content">
	<form class="login" method="POST">
		<input type="text" placeholder="Identifiant" name="login" /><br />
		<input type="password" placeholder="Password" name="password" /><br />
		<input type="submit" value="Connexion">
	</form>
</div>
<?php include('includes/footer.php'); ?>
