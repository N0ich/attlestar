<?php include('includes/config.php'); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/inscription.php'); ?>
<?php
	if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['mail'])) {
		if ($_POST['password'] != $_POST['password2']) {
			echo "<div class='alert error'>Les deux mot de passe ne correspondent pas!</div>";
		} else if (isplayer($_POST['login'])) {
			echo "<div class='alert error'>Ce pseudo est deja pris!</div>";
		} else if (strlen($_POST['password']) < 7) {
			echo "<div class='alert error'>Le password doit faire plus de 7 caracteres</div>";
		} else if (strlen($_POST['password']) > 50) {
			echo "<div class='alert error'>Le password ne doit pas depasser 50 caracteres</div>";
		} else {
			inscription($_POST['login'], $_POST['password'], $_POST['mail']);
			echo "<div class='alert success'>Inscription Reussie!</div>";
		}
	}
?>
<div class="content">
	<form class="inscription" method="POST">
		<h3>S'inscrire</h3>
		<input required type="text" name="login" placeholder="Identifiant" <?php if (isset($_POST['login'])) { echo "value='".$_POST['login']."'"; } ?>/><br>
		<input required type="password" name="password" placeholder="Mot de passe"><br>
		<input required type="password" name="password2" placeholder="Confirmation"><br>
		<input required type="email" placeholder="Mail" name="mail" <?php if (isset($_POST['mail'])) { echo "value='".$_POST['mail']."'"; }?>><br>
		<input type="submit" value="Valider">
	</form>
</div>
<?php include('includes/footer.php'); ?>
