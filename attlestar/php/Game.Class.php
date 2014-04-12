<?php
require_once 'Map.Class.php';
Class Game {

	public static $verbose = FALSE;
	private $_map;

	const SIZE_X = 100;
	const SIZE_Y = 150;

	public function doc(){echo file_get_contents('Game.doc.txt'); }

	public function __construct ()
	{
		$_map = $this->setMap(new Map( array ('width' => Game::SIZE_X, 'height' => Game::SIZE_Y) ));
		if (Map::$verbose)
			echo $this . ' constructed' . PHP_EOL;
		return  ;
	}

	public function refresh() {
		echo '<div id="plate">';
		$this->getMap()->printMap();
		echo '</div>';
	}

	public function getMap() { return ($this->_map); }
	public function setMap( $map ) { $this->_map = $map; }

	public function __get ( $att )
	{
		print('Attempt to access \''. $att . '\' atribute to \'' . $value . '\', this script should die' . PHP_EOL);
		return ;
	}

	public function __set ( $att, $value )
	{
		print('Attempt to set \''. $att . '\' atribute to \'' . $value . '\', this script should die' . PHP_EOL);
		return ;
	}

	public function __destruct ()
	{
		return ;
	}
	public function __toString()
	{
		return sprintf('Game');
	}
}
?>