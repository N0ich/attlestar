<?php include('includes/config.php');
	$db = connect();
	$query = $db->query("SELECT COUNT(*) FROM users WHERE online = true");
	$query = $query->fetch();
?>
<footer>
	<?php echo "Il y a ".$query[0]." utilisateur(s) en ligne<br />";?>
	dat footer, such git <a href="https://github.com/N0ich/attlestar"><i class="icon-github3"></i></a>, Much wow
</footer>
</body>
</html>
