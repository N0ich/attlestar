<?php
Class SQLdata
{

	public function creatUnivers($data)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$query = $db->prepare("INSERT INTO game (data) VALUES (?)");
		$query->execute(array(base64_encode(serialize($data))));
		return $db->lastInsertId();
		$db->close();
	}

	public function getUnivers($id_game)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$query = $db->prepare("SELECT data FROM game WHERE ? = id");
		$query->execute(array($id_game));
		$data = $query->fetch();
		return unserialize(base64_decode($data['data']));
		$db->close();
	}

	public function setUnivers($id_game, $data)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$query = $db->prepare("UPDATE game SET data=':data' WHERE :id_game = game.id");
		$query->execute(array(':data' => serialize($data),
							':id_game' => $id_game));
		$db->close();
	}

	public function getPlayer($id_game)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$db->prepare("SELECT id, name FROM player game WHERE ? = game.id AND game.id = player.id_game");
		foreach ($db->exec($id_game) as $value)
			$data[] = $value;
		return $data;
		$db->close();
	}
}
?>
