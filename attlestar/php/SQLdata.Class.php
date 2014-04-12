<?php
Class SQLdata
{

	public function getMapStatus($posX, $posY)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=vrey_rush", "root", "123");
		$query->prepare($db, "SELECT status FROM maps WHERE :posX = posx AND :posY = posy");
		$query->exec(array(
			'posX' => $posX,
			'posY' => $posY));
		$data = $query->fetch();
		return $data['status'];
		$query->close();
	}

	public function getMap()
{
	$db = new PDO("mysql:host=127.0.0.1;dbname=rush1", "root", "qwertyus");
	$query->prepare($db, "SELECT status FROM maps WHERE :posX = posx AND :posY = posy");
	$query->exec(array(
		'posX' => $posX,
		'posY' => $posY));
	$data = $query->fetch();
	return $data['status'];
	$query->close();
}

	public function getShipStatus($shipID)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=vrey_rush", "root", "123");
		$query->prepare($db, "SELECT * FROM ship WHERE ? = id LIMIT 1");
		$query->exec($shipID);
		$data = $query->fetch();
		return $query->fetch();
		$query->close();
	}

	public function getShipPos($shipID)
	{
		$db = new PDO("mysql:host=127.0.0.1;dbname=vrey_rush", "root", "123");
		$query->prepare($db, "SELECT  FROM ship");
		$query->exec($shipID);
		$data = $query->fetch();
		return $query->fetch();
		$query->close();
	}

}
?>
