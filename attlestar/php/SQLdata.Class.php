<?php
Class SQLdata
{
	private $db_name = "mysql:host=127.0.0.1;dbname=rush2";
	private $db_login = "root";
	private $db_pass = "abc123";

	public function creatUnivers($data)
	{
		$db = new PDO($db_name, $db_login, $db_pass);
		$query = $db->prepare("INSERT INTO game (data) VALUES (?)");
		$query->execute(array(base64_encode(serialize($data))));
		return $db->lastInsertId();
		$db->close();
	}

	public function getUnivers($id_game)
	{
		$db = new PDO($db_name, $db_login, $db_pass);
		$query = $db->prepare("SELECT data FROM game WHERE ? = id");
		$query->execute(array($id_game));
		$data = $query->fetch();
		return unserialize(base64_decode($data['data']));
		$db->close();
	}

	public function setUnivers($id_game, $data)
	{
		$db = new PDO($db_name, $db_login, $db_pass);
		$query = $db->prepare("UPDATE game SET data=':data' WHERE :id_game = game.id");
		$query->execute(array(':data' => serialize($data),
							':id_game' => $id_game));
		$db->close();
	}

	public function getPlayer($id_game)
	{
		$db = new PDO($db_name, $db_login, $db_pass);
		$db->prepare("SELECT id, name FROM player game WHERE ? = game.id AND game.id = player.id_game");
		foreach ($db->exec($id_game) as $value)
			$data[] = $value;
		return $data;
		$db->close();
	}

	public function cleanUnivers()
	{
		$db = new PDO($db_name, $db_login, $db_pass);
		$query = $db->prepare("SELECT id, date_crea FROM game");
		$query->execute();
		foreach ($query->fetch() as $value) {
			if ($value['date_crea'] + 3600 < time())
			{
				$query = $db->prepare("DELETE FROM game WHERE ? = game.id");
				$query->execute(array($idata['id']));
			}
		}
		$db->close();
	}
}
?>
