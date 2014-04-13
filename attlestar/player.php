<?php
	include('../includes/config.php');
require_once 'php/SQLdata.Class.php';
require_once 'php/Game.Class.php';
require_once 'php/IElem.Class.php';
require_once 'Class/Fleet.Class.php';
require_once 'Class/Highlight.Class.php';
require_once 'php/Obstacle.Class.php';

function	show_ship($name, $hp, $pp) {
	echo "<div id='ship'>";
	echo "<center><i class='icon-rocket'></i> <span id='name'>$name</span></center><br />";
	echo "HP <i class='icon-heart'></i> : ";
	for ($i = 0; $i < $hp ; $i++)
		echo "<span class='hp'></span>";
	echo "<br />";
	echo "<br />";
	echo "PP <i class='icon-dashboard'></i> : ";
	for ($i = 0; $i < $pp ; $i++)
		echo "<span class='pp'></span>";
	echo "<br />";
	echo "<br />";
	echo "</div>";
}

	session_start();
	$db = connect();
	$tab = unserialize($_SESSION['players']);
	$query = $db->query('SELECT player FROM game WHERE id = '.$_SESSION['id_game']);
	$data = $query->fetch();
	$player = $tab[$data['player']];
	$current = $data['player'];
	$query2 = $db->query('SELECT login FROM users WHERE id = '.$player);
	$data = $query2->fetch();
	echo "<h1>Current Player:<br/>".$data['login']."</h1>";
	$class = new SQLdata();
	$game = $class->getUnivers($_SESSION['id_game']);
	$tab = $game->getMap()->getElem();
	foreach ($tab as $line) {
		if ($line instanceof Ship) {
			$style = $line->getStyle();
			$team = $style;
			$result = array();
			preg_match_all("/title=\"(.*)\"/", $team, $result);
			$team = $result[1][0][strlen($result[1][0]) - 1];
			if ($current == $team) {
				show_ship($line->getName(), $line->getHP(), $line->getPP());
			}
		}
	}	
	echo "<button onclick='leave()'>Quitter la partie</button>";

?>
