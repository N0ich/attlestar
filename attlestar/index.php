<?php
session_start();
require_once 'php/Game.Class.php';
require_once 'php/Obstacle.Class.php';
include 'php/header.php';
include 'php/utils.php';
?>
	<div id="aff"></div>
<?php
$game = new Game();

$style1 = new Style( array('color' => '#424242', 'opacity' => 0.95, 'name' => 'asteroide', 'border' => '1px inset #424242; border-radius: 20%') );

for ($i = 0; $i < 6; ++$i) {
	$size = genArray(10, 15, 10, 15);
	$pos = genArray(10, 70, 10, 120);
	$obstacle = new Obstacle (array( 'name' => 'asteroide', 'pos' => $pos, 'size' => $size, 'style' => $style1));
	$game->getMap()->addElem($obstacle);
}
header("Location: refmap.php");
include 'php/footer.php';

?>
