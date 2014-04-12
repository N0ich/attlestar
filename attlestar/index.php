<?php
session_start();
require_once 'php/Game.Class.php';
require_once 'php/Obstacle.Class.php';
require_once 'Class/Fleet.Class.php';
include 'php/header.php';
include 'php/utils.php';
?>
	<div id="aff"></div>
<?php
$game = new Game();

$style1 = new Style( array('color' => '#424242', 'opacity' => 0.95, 'name' => 'asteroide', 'border' => '1px inset #424242; border-radius: 20%') );

for ($i = 0; $i < 6; ++$i) {
    $a = array( 'name' => 'asteroide', 'style' => $style1);
    $a['sizex'] = mt_rand(5, 10);
    $a['sizey'] = mt_rand(5, 10);
    $a['posx'] = mt_rand(40, 110);
    $a['posy'] = mt_rand(20, 80);
    $obstacle = new Obstacle ($a);
    $game->getMap()->addElem($obstacle);
}

$fleet1 = new Fleet(array('size' => 5, 'player' => 1));
$fleet2 = new Fleet(array('size' => 5, 'player' => 2));

$game->getMap()->addElem($fleet1);
$game->getMap()->addElem($fleet2);
$game->refresh();
include 'php/footer.php';

?>
