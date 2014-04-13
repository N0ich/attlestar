<?php
	include('includes/config.php');
	include('includes/header.php');

	echo "<div class='content'><center>";
	echo "<table>";
	echo "<tr>
			<th>Position</th>
			<th>Login</th>
			<th>Victoires</th>
			<th>Defaites</th>
			<th>Ratio</th>
		  </tr>";
	$db = connect();
	$i = 1;
	$query = $db->query('SELECT * FROM `users` ORDER BY (pwon / (pwon + ploose)) DESC');
	while ($data = $query->fetch()) {
		if ($i == 1) {
			$image = "icon-rocket";
		} else if ($i == 2) {
			$image = "icon-evil";
		} else if ($i == 3) {
			$image = "icon-fire";
		} else {
			$image = "icon-thumbs-up";
		}
		echo "<tr>
			<td>$i <i class='".$image."'></i></td>
			<td><a href='profile.php?id=".$data['id']."'>".$data['login']."</a></td>
			<td style='color: green;'>".$data['pwon']."</td>
			<td style='color: red'>".$data['ploose']."</td>
			<td>".intval(($data['pwon'] / ($data['pwon'] + $data['ploose']) * 100), 100)."%</td>
			</tr>";
		$i++;
}
	echo "</table></center>";
	include('includes/footer.php');
?>
