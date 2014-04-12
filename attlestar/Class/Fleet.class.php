<?PHP

require_once ("Ship.class.php");
require_once ("Weapon.class.php");

Class Fleet {

	private $_player = 0;
	private $_fleet = array();
	private $_size = 0;
	private $_spawn = 0;
	private $_elems = array();
	static $verbose = FALSE;

	private function _creatSpawnY($p) {
		return (($this->_size * 5) + 10);
	}

	private function _creatSpawnX($p) {
		if ($p == 2)
			return (99);
		else
			return (5);
	}

	function __construct(array $arg) {
		if (array_key_exists('size', $arg) && array_key_exists('player', $arg))
            {
                $this->_player = $arg['player'];
                while ($this->_size < $arg['size'])
                    {
                        $this->addShip(
                            new Ship (array('name' => "Crusader",
                            'pp' => 10,
                            'weapon' => new Weapon (array(
                                'lrange' => 50,
                                'mrange' => 25,
                                'srange' => 10,
                                'damage' => 10)),
                            'hp' => 20,
                            'movement' => 10,
                            'posx' => self::_creatSpawnY($this->_size),
                            'posy' => self::_creatSpawnX($arg['player']),
                            'sizex' => 1,
                            'sizey' => 4
                            )));
                        $this->_size++;
                    }
            }
		else
			return (NULL);
		if (self::$verbose == TRUE)
			echo "Player ".$this->_player." now has a ".$this->_size." ships fleet\n";
	}

	function __destruct() {
		if (self::$verbose == TRUE)
			echo "Player defeated\n";
	}

	function __toString() {
		return (sprintf("Player %d has a %d sized fleet\n", $this->_player, $this->_size));
	}

    public function addShip($ship) {
        $ship->setTeam($this);
        array_push($this->_elems, $ship);
    }

    public function getPlayer() { return ($this->_player); }
    public function getElems() { return ($this->_elems); }
    public function setElems( $elems ) { $this->_elems = $elems; }

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