<?PHP
session_start();
require_once 'php/SQLdata.Class.php'; 
require_once 'php/Game.Class.php'; 
require_once 'php/IElem.Class.php'; 
require_once 'Class/Fleet.Class.php'; 
require_once 'php/Obstacle.Class.php';
$id = $_SESSION['id'];
$sql = New SQLdata;
$game = $sql->getUnivers($id);
$game->refresh();
?>