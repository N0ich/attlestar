<?php
	include('includes/config.php');
	include('includes/header.php');
?>
<div class="content">
	<?php
		$db = connect();
		$query = $db->query("SELECT ".$_GET['player']."player FROM lobby");
		$data = $query->fetch();
		$tab = explode(',', $data[$_GET['player']."player"]);
		for ($i = 0; $tab[$i] != $_SESSION['id'] && $i < count($tab[$i]); $i++);
		if ($tab[$i]) {
			echo "<h1>La partie va commencer! Tenez-vous pret!</h1>";
			for ($i = 0; $i < count($tab); $i++) {
				if ($result)
					$result .= "player".($i + 1)."=".$tab[$i]."&";
				else
					$result = "player".($i + 1)."=".$tab[$i]."&";
			}
			header('Location: attlestar/index.php?'.$result);
		}
	?>
</div>
