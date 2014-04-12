<?PHP

require_once ("Ship.class.php");
require_once ("Weapon.class.php");

Class Fleet {

	private $_player = 0;
	private $_fleet = array();
	private $_size = 0;
	private $_spawn = 0;
	static $verbose = FALSE;

	private function _creatSpawnX($p) {
		return (($this->_size * 5) + 10);
	}

	private function _creatSpawnY($p) {
		if ($p == 2)
			return (120);
		else
			return (20);
	}

	function __construct(array $arg) {
		if (array_key_exists('size', $arg) && array_key_exists('player', $arg))
		{
			while ($this->_size < $arg['size'])
			{
				$this->_fleet[] =
					new Ship (array('name' => "Crusader",
									'pp' => 10,
									'weapon' => new Weapon (array(
																'lrange' => 50, 
																'mrange' => 25,
																'srange' => 10, 
																'damage' => 10)),
									'hp' => 20,
									'posx' => self::_creatSpawnX($this->_size),
									'posy' => self::_creatSpawnY($arg['player']),
									'sizex' => 4,
									'sizey' => 1
								  ));
				$this->_size++;
			}
		}
		else
			return (NULL);
		if (self::$verbose == TRUE)
			echo "Player now has a ".$this->_size." ships fleet\n";
	}

	function __destruct() {
		if (self::$verbose == TRUE)
			echo "Player defeated\n";
	}

	function __toString() {
		return (sprintf("Player %d has a %d sized fleet\n", $this->_player, $this->_size));
	}

	function getSize() { return ($this->_size); }

	function getShip() {
		$ret = array();
		foreach ($this->_fleet as $ship) {
			$ret[] = array('name' => $ship->getName(),
						   'PP' => $ship->getPP(),
						   'HP' => intval($ship->getHP()),
						   'sprite' => $ship->getSprite(),
						   'posx' => $ship->getPosX(),
						   'posy' => $ship->getPosY(),
						   'sizex' => $ship->getSizeX(),
						   'sizey' => $ship->getSizeY(),
						   'weapon' => $ship->getWeapon()
				);
		}
		return ($ret);
		
	}

	function setSize($val) {
		$this->_size = $val;
	}

	function doc() {
		print file_get_contents("Fleet.class.php");
	}
}

?>