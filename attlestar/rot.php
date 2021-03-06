<?PHP

session_start();
require_once 'php/SQLdata.Class.php';
require_once 'php/Game.Class.php';
require_once 'php/IElem.Class.php';
require_once 'Class/Fleet.Class.php';
require_once 'Class/Highlight.Class.php';
require_once 'php/Obstacle.Class.php';

$id = $_SESSION['id_game'];
$ship = unserialize($_SESSION['ship']);
$sql = New SQLdata;
$game = $sql->getUnivers($id);
$x = $_GET['x'];
$y = $_GET['y'];
$game->getMap()->unsetCoord($ship);
if ($ship->getOrientation() == 2 || $ship->getOrientation() == 4)
{
	if ($y > $ship->getPosY())
		$ship->setOrientation(1);
	else ($y < $ship->getPosY())
		$ship->setOrientation(3);
}
else if ($ship->getOrientation() == 1 || $ship->getOrientation() == 3)
{
	if ($x > $ship->getPosX())
		$ship->setOrientation(4);
	else ($x < $ship->getPosX())
		$ship->setOrientation(2);
}
$game->getMap()->addElem($ship);
$sql->setUnivers($id, $game);
$_SESSION['ship'] = serialize($ship);
echo $game->refreshFire();

?>
