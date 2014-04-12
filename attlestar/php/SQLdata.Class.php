<?php
Class SQLdata
{

	public function creatUnivers($data)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$query->prepare($db, "INSERT INTO game (data) VALUES '?' WHERE 0 = game.id");
		$query->exec($data);
		$query->prepare($db, "SELECT id FROM game WHERE 0 = game.id");
		$query->exec();
		return $query->fetch()['id'];
		$query->close();
	}

	public function getUnivers($id_game)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$query->prepare($db, "SELECT data FROM game WHERE ? = game.id");
		$query->exec($id_game);
		$data = $query->fetch();
		return unserialize($data['data']);
		$query->close();
	}

	public function setUnivers($id_game, $data)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$query->prepare($db, "UPDATE game SET data=':data' WHERE :id_game = game.id");
		$query->exec(array('data' => serialize($data),
							'id_game' => $id_game));
		$data = $query->fetch();
		return $data['status'];
		$query->close();
	}

	public function getPlayer($id_game)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "abc123");
		$query->prepare($db, "SELECT id, name FROM player game WHERE ? = game.id AND game.id = player.id_game");
		$query->exec($id_game);
		$data = $query->fetch();
		foreach ($query->fetch() as $value)
			$data[] = $value;
		return $data;
		$query->close();
	}
}
?>
