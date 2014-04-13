<?php
include('includes/header.php');
?>
<div class="content">
	<?php
		if (isset($_GET['justlogged']) && isset($_SESSION['login'])) {
			echo "<div class='alert success'>Bienvenue ".$_SESSION['login']. "!</div>";
		}
	if (isset($_SESSION['login'])) {
		echo "<center><h3>Chat <i class='icon-bubble'></i></h3></center>";
		include('includes/chat.php');
	} else {
		echo "<center><a href='inscription.php'><button>Inscrivez-vous et rejoignez l'Aventure!</button></a>
			<h3>Essayez de devenir le meilleur joueur!</h3><img src='style/ladder.png'>
			<h3>Remportez des matchs epiques!</h3><img height='500' src='style/game.png'></center>";
	}
	?>
</div>
<script> envoi('2e36f5748d06238ecb29f42458090a4d')</script>
<?php include('includes/footer.php'); ?>
