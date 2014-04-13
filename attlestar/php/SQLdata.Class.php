<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/config.php');
Class SQLdata
{
	public function creatUnivers($data)
	{
		$db = connect();
		$query = $db->prepare("INSERT INTO game (data) VALUES (?)");
		$query->execute(array(base64_encode(serialize($data))));
		return $db->lastInsertId();

	}

	public function getUnivers($id_game)
	{
		$db = connect();
		$query = $db->prepare("SELECT data FROM game WHERE ? = id");
		$query->execute(array($id_game));
		$data = $query->fetch();
		return unserialize(base64_decode($data['data']));

	}

	public function setUnivers($id_game, $data)
	{
		$db = connect();
		$query = $db->prepare("UPDATE game SET data=:data WHERE id =:id_game");
		$query->execute(array(
							'data' => base64_encode(serialize($data)),
							'id_game' => $id_game
							));
	}

	public function getPlayer($id_game)
	{
		$db = connect();
		$db->prepare("SELECT id, name FROM player game WHERE ? = game.id AND game.id = player.id_game");
		foreach ($db->exec($id_game) as $value)
			$data[] = $value;
		return $data;

	}

	public function destroyUnivers($id_game)
	{
		$db = connect();
		$query = $db->prepare("DROP TABLE chat?");
		$query->execute($id_game);
		$query = $db->prepare("DELETE FROM game WHERE ? = id");
		$query->execute($id_game);
	}

}
?>
