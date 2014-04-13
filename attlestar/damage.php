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
$x = $_GET['x'];
$y = $_GET['y'];
$ret = $game->getMap()->getPlate()[$x][$y];
$game->getMap()->unsetCoord($ret);
$sql->setUnivers($id, $game);
echo $game->refresh();

?>
