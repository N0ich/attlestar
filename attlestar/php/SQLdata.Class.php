<?php
Class SQLdata
{

	public function getUnivers($id_game)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "qwertyus");
		$query->prepare($db, "SELECT data FROM game WHERE ? = game.id");
		$query->exec($player_id);
		$data = $query->fetch();
		return unserialize($data['data']);
		$query->close();
	}

	public function setUnivers($id_game, $data)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush1", "root", "qwertyus");
		$query->prepare($db, "UPDATE game SET data=':data' WHERE :id_game = game.id");
		$query->exec(array(
			'data' => serialize($data),
			'id_game' => $id_game));
		$data = $query->fetch();
		return $data['status'];
		$query->close();
	}

	public function getPlayer($id_game)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=rush2", "root", "qwertyus");
		$query->prepare($db, "SELECT id, name FROM player game WHERE ? = game.id AND game.id = player.id_game");
		$query->exec($shipID);
		$data = $query->fetch();
		foreach ($query->fetch() as $value)
			$data[] = $value;
		return $data;
		$query->close();
	}
}
?>
