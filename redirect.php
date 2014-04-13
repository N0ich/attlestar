<?php
	include('includes/config.php');
	include('includes/header.php');
?>
<div class="content">
	<?php
		$db = connect();
		$query = $db->query("SELECT * FROM lobby");
		$data = $query->fetch();
		$tab = explode(',', $data[$_GET['player']."player"]);
		for ($i = 0; $tab[$i] != $_SESSION['id'] && $i < count($tab[$i]); $i++);
		if ($tab[$i]) {
			echo "<h1>La partie va commencer! Tenez-vous pret!</h1>";
			for ($i = 0; $i < count($tab); $i++) {
				if (isset($result))
					$result .= "player".($i + 1)."=".$tab[$i]."&";
				else
					$result = "player".($i + 1)."=".$tab[$i]."&";
			}
			$result .= "type=".$_GET['player']."&lobbyid=".$data['id'];
			header('Location: attlestar/index.php?'.$result);
		}
	?>
</div>
