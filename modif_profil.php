<?php
	include('includes/header.php');
	include('includes/config.php');
?>
<div class="content">
<?php 
	if (isset($_SESSION['login'])) {
		echo "<h1>Modifier mon profil</h1>";
		$id = $_SESSION['id'];
		echo "<form action='modif_profil.php' method='POST'>";
			echo "<input type='password' name='actpass' placeholder='Mot de passe actuel' ><br />";
			echo "<input type='password' name='newpass' placeholder='Modifier mon password' ><br />";
			echo "<input type='password' name='newpass2' placeholder='Confirmer' ><br />";
			echo "<hr />";
			echo "<input type='text' name='img' placeholder='Modifier mon Avatar'>";
			echo "<hr />";
			echo "<input type='mail' name='mail' placeholder='Modifer mon mail'>";
			echo "<hr />";
			echo "<input type='submit' value='Modifier!'>";
			echo "</form>";
			if (isset($_POST['newpass']) && isset($_POST['newpass2']) && isset($_POST['actpass'])) {
				if ($_POST['newpass'] == $_POST['newpass2']) {
					$db = connect();
					$query = $db->query('SELECT password FROM users WHERE id = '.$id);
					$data = $query->fetch();
					if ($data['password'] == sha1($_POST['actpass'])) {
						$db->query('UPDATE users SET password = '.sha1($_POST['password'])." WHERE id = ".$id);
						$success = "Votre mot de passe a bien ete mis a jour";
					} else {
						$error = "Le mot de passe actuel ne correspond pas!";
					}
				} else {
					$error = "Les mots de passes ne correspondent pas!";
				}
			} if (isset($_POST['img'])) {
				$db = connect();
				$db->query('UPDATE users SET img = '.$_POST['img'].' WHERE id = '.$id);
				$success = "Votre avatar a bien ete change!";
			} if (isset($_POST['mail'])) {
				$db = connect();
				$db->query('UPDATE users SET mail = '.$_POST['mail'].' WHERE id = '.$id);
				$success = "Votre mail a bien ete modifie!";
			}
				if (isset($error))
					echo "<div class='alert error'>".$error."</div>";
				if (isset($success))
					echo "<div class='alert success'>".$success."</div>";
	} else {
		echo "<h1>Error 404: Page not found.</h1>";
	}
?>
</div>
