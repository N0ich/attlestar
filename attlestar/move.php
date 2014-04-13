<?PHP

session_start();
require_once 'php/SQLdata.Class.php';
require_once 'php/Game.Class.php';
require_once 'php/IElem.Class.php';
require_once 'Class/Fleet.Class.php';
require_once 'Class/Highlight.Class.php';
require_once 'php/Obstacle.Class.php';

$id = $_SESSION['id'];
$ship = unserialize($_SESSION['ship']);
$sql = New SQLdata;
$game = $sql->getUnivers($id);
$x = $_GET['x'];
$y = $_GET['y'];
$game->getMap()->unsetCoord($ship);
$ship->setPosX($x);
$ship->setPosY($y);
$game->getMap()->addElem($ship);
$sql->setUnivers($id, $game);
$_SESSION['ship'] = serialize($ship);
echo $game->refresh();

?>