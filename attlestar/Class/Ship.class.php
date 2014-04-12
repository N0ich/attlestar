<?PHP

Class Ship {

	private $_posx = 0;
	private $_posy = 0;
	private $_name = 0;
	private $_ppmax = 0;
	private $_turnpp = 0;
	private $_played = 0;
	private $_move = 0;
	private $_fight = 0;
	private $_sizex = 0;
	private $_sizey = 0;
	private $_hp = 0;
	private $_weapon = 0;
	private $_sprite = "img/ship1.jpg";
	static $verbose = FALSE;
	
	function __construct(array $arg) {
		if (array_key_exists('pp', $arg) &&
			array_key_exists('name', $arg) &&
			array_key_exists('posx', $arg) &&
			array_key_exists('posy', $arg) &&
			array_key_exists('sizex', $arg) &&
			array_key_exists('sizey', $arg) &&
			array_key_exists('weapon', $arg) &&
			array_key_exists('hp', $arg))
		{
			$this->_name = $arg['name'];
			$this->_ppmax = $arg['pp'];
			$this->_posx = $arg['posx'];
			$this->_posy = $arg['posy'];
			$this->_sizex = $arg['sizex'];
			$this->_sizey = $arg['sizey'];
			$this->_hp = $arg['hp'];
			$this->_weapon = $arg['weapon'];
		}
		else
			return (NULL);
		if (self::$verbose == TRUE)
			echo "Ship created -
Name: ".$this->_name." PP: ".$this->_ppmax."\n";
	}
	function __destruct() {
		if (self::$verbose == TRUE)
			echo "Ship destroyed - Name: ".$this->_name."\n";
	}
	function doc() {
		print file_get_contents("Ship.doc.txt");
	}

	function __toString () {
		return (sprintf("Ship: P%d, PPmax: %d, name:%d, current pos: %d/%d",
						$this->_player, $this->_ppmax, $this->_name, $this->_posx, $this->_posy));
	}

	function getName() { return ($this->_name); }

	function getPP() { return ($this->_ppmax); }

	function getPosX() { return ($this->_posx); }

	function getPosY() { return ($this->_posy); }

	function getSizeX() { return ($this->_sizex); }

	function getSizeY() { return ($this->_sizey); }

	function getTPP() { return ($this->_turnpp); }

	function getPlayed() { return ($this->_played); }

	function getFighted() { return ($this->_fight); }

	function getMoved() { return ($this->_move); }

	function getSprite() { return ($this->_sprite); }

	function getWeapon() {
		return (array(
					'name' => $this->_weapon->getName(),
					'lrange' => $this->_weapon->getLRange(),
					'mrange' => $this->_weapon->getMRange(),
					'srange' => $this->_weapon->getSRange(),
					'damage' => $this->_weapon->getDamage(),
					'sprite' => $this->_weapon->getSprite()
					));
	}

	function getHP() { return ($this->_hp); }

	function setPP($val) {
		if ($val >= 0)
			$this->_turnpp = $val;
	}
	
	function setHP($val) {
		if ($val >= 0)
			$this->_hp = $val;
	}
	
	function fight() {
		if ($this->_fight == 0) {
			$this->_fight = 1;
		}
	}
	
	function move () {
		if ($this->_move == 0) {
			$this->_move = 1;
		}
	}
	
	function startTurn() {
		$this->_turnpp = $this->_ppmax;
	}
	
	function endTurn() {
		$this->_turnpp = 0;
		$this->_move = 0;
		$this->_fight = 0;
		$this->_played = 1;
	}
}

?>