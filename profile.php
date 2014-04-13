<?php 
	include('includes/config.php');
	include('includes/header.php');
?>
	<div class="content">
	<?php 
	$db = connect();
	$query = $db->prepare("SELECT * FROM users WHERE id = :id");
	$query->execute(array(
		'id' => $_GET['id']
	));
	$data = $query->fetch();
	if ($data) {
		if (!($data['img'])) {
			echo "<img class='profile' src='http://www.webdesignerforum.co.uk/uploads/profile/photo-1407.jpg?_r=1396701824'>";
		} else {
			echo "<img class='profile' src='".$data['img']."'>";
		}
		echo "<h1>".$data['login']."</h1>";
		if ($data['online'])
			echo "<h3 style='color: green;'>Online</h3>";
		else
			echo "<h3 style='color: red'>Offline</h3>";
		echo "<h4>Ratio de victoire: </h4>";
		if ($data['pwon'] + $data['ploose'])
			$ratio = intval(($data['pwon'] / ($data['pwon'] + $data['ploose']) * 100), 100);
		else
			$ratio = 0;
		echo $ratio."% ";
		if ($ratio < 10) {
			echo "<i class='icon-neutral'></i>";
		} else if ($ratio < 50) {
			echo "<i class='icon-smiley'></i>";
		} else if ($ratio < 70) {
			echo "<i class='icon-cool2'></i>";
		} else if ($ratio < 90) {
			echo "<i class='icon-shocked2'></i>";
		} else {
			echo "<i class='icon-evil'></i>";
		}
		echo "<br /><br />Nombre de partie jouees: ".($data['pwon'] + $data['ploose'])."<br />";
		echo "Nombre de partie gagnees: <span style='color: green'>".$data['pwon']."</span><br />";
		echo "Nombre de partie perdues: <span style='color: red'>".$data['ploose']."</span><br />";
		if ($_SESSION['id'] == $_GET['id']) {
			echo "<br /><a href='modif_profil.php'><button style='height: 80px; width: 250px; font-size: 20px;'>Modifier mon profil</button></a>";
		}
	} else {
		echo "<h1>Profile not found :(</h1>";
	}
?>
</div>
