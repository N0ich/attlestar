<?php
include('includes/header.php');
?>
<div class="content">
	<?php
		if (isset($_GET['justlogged']) && isset($_SESSION['login'])) {
			echo "<div class='alert success'>Bienvenue ".$_SESSION['login']. "!</div>";
		}
	echo "<center><h3>Chat <i class='icon-bubble'></i></h3></center>";
		include('includes/chat.php');
	?>
</div>
<script> envoi('2e36f5748d06238ecb29f42458090a4d')</script>
<?php include('includes/footer.php');
