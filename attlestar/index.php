<?php
session_start();
require_once 'php/SQLdata.Class.php';
require_once 'php/Game.Class.php';
require_once 'php/Obstacle.Class.php';
require_once 'Class/Fleet.Class.php';
include 'php/header.php';
include 'php/utils.php';
include '../includes/config.php';


$weapons = "ressource/data/weapons.json";
$ships = "ressource/data/ships.json";
$db = connect();
if ($_SESSION['id'] == $_GET['player1']) {

	$game = new Game();
    Game::$shipData = loadJson($ships);
    Game::$weaponData = loadJson($weapons);
    print_r(Game::$shipData);
	$style1 = new Style( array('color' => '#424242', 'opacity' => 0.95, 'name' => 'asteroide', 'border' => '1px inset #424242; border-radius: 20%') );
	for ($i = 0; $i < 60; ++$i) {
		$a = array( 'name' => 'asteroide', 'style' => $style1);
		$a['sizex'] = mt_rand(5, 10);
		$a['sizey'] = mt_rand(5, 10);
		$a['posx'] = mt_rand(1, 130);
		$a['posy'] = ($a['posx'] > 30 && $a['posx'] < 130 ? mt_rand(1, 85) : mt_rand(30, 50));
		$obstacle = new Obstacle ($a);
		$game->getMap()->addElem($obstacle);
	}
	$player = array();
	$player[0] = $_GET['type'];
	for ($i = 1; $i <= $_GET['type']; $i++) {
		$player[$i] = $_GET["player".$i];
		${"fleet". $i} = new Fleet(array('race' => 'raceType1', 'player' => $i));
		$game->getMap()->addElem(${"fleet".$i});
	}
	$sql = New SQLData;
	$id = $sql->creatUnivers($game);
	$_SESSION['id_game'] = $id;
	$_SESSION['sql'] = $sql;
	$db->query('CREATE TABLE chat'.$id.' (login varchar(50), message TEXT, time TEXT)');
}
else {
	sleep(2);
	$query = $db->query('SELECT max(id) FROM game');
	$data = $query->fetch();
	$_SESSION['id_game'] = $data[0];
	$player = array();
	$player[0] = $_GET['type'];
	for ($i = 1; $i <= $_GET['type']; $i++) {
		$player[$i] = $_GET["player".$i];
	}
}
$_SESSION['players'] = serialize($player);
$_SESSION['isplay'] = 1;
$db->query('UPDATE game SET connected = connected + 1');
header("Location: game.php");
include 'php/footer.php';

?>
