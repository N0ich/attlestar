<?PHP
session_start();
include('../includes/config.php');
require_once 'php/SQLdata.Class.php'; 
require_once 'php/Game.Class.php'; 
require_once 'php/IElem.Class.php'; 
require_once 'Class/Fleet.Class.php'; 
require_once 'php/Obstacle.Class.php';
$id = $_SESSION['id_game'];
$sql = New SQLdata;
$game = $sql->getUnivers($id);
$players = unserialize($_SESSION['players']);
$db = connect();
$query = $db->query('SELECT player FROM game WHERE id = '.$id);
$query = $query->fetch();
if ($players[$query['player']] == $_SESSION['id'])
{
	$game->refresh();
} else {
	$game->refreshInactive();
}
$db = NULL;
?>
