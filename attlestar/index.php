<?php
session_start();
require_once 'php/SQLdata.Class.php';
require_once 'php/Game.Class.php';
require_once 'php/Obstacle.Class.php';
require_once 'Class/Fleet.Class.php';
include 'php/header.php';
include 'php/utils.php';
$game = new Game();

$style1 = new Style( array('color' => '#424242', 'opacity' => 0.95, 'name' => 'asteroide', 'border' => '1px inset #424242; border-radius: 20%') );

for ($i = 0; $i < 6; ++$i) {
	$a = array( 'name' => 'asteroide', 'style' => $style1);
	$a['sizex'] = mt_rand(5, 10);
	$a['sizey'] = mt_rand(5, 10);
	$a['posx'] = mt_rand(10, 70);
	$a['posy'] = mt_rand(30, 100);
	$obstacle = new Obstacle ($a);
	$game->getMap()->addElem($obstacle);
}
$fleet1 = new Fleet(array('size' => 5, 'player' => 1));
$fleet2 = new Fleet(array('size' => 5, 'player' => 2));

$game->getMap()->addElem($fleet1);
$game->getMap()->addElem($fleet2);
<<<<<<< HEAD
$sql = New SQLData;
$id = $sql->creatUnivers($game);
$_SESSION['id'] = $id;
$_SESSION['sql'] = $sql;
header("Location: game.php");
=======
$test = New SQLData;
$test->cleanUnivers();
$id = $test->creatUnivers($game);
$game = $test->getUnivers($id);
$game->refresh();

>>>>>>> 4b880a7d910a59c038cb1f3ef35f34db1929b6dd
include 'php/footer.php';

?>
