<?PHP

session_start();
require_once 'php/SQLdata.Class.php';
require_once 'php/Game.Class.php';
require_once 'php/IElem.Class.php';
require_once 'Class/Fleet.Class.php';
require_once 'Class/Highlight.Class.php';
require_once 'php/Obstacle.Class.php';

$id = $_SESSION['id_game'];
$sql = New SQLdata;
$game = $sql->getUnivers($id);
$ship = unserialize($_SESSION['ship']);
$hl = new Highlight($ship, "fire", $ship->getOrientation());
$game->getMap()->addElem($hl);
$game->getMap()->addElem($ship);
echo $game->refreshFire();

?>
