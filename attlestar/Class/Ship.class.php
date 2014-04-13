<?PHP

Class Ship implements IElem {

    private $_style = null;
    private $_type = null;
    private $_team = null;
	private $_posx = 0;
	private $_orientation = 0;
	private $_posy = 0;
	private $_sizex = 0;
	private $_sizey = 0;
	private $_name = 0;
	private $_ppmax = 0;
	private $_turnpp = 0;
	private $_played = 0;
	private $_move = 0;
	private $_movement = 0;
	private $_fight = 0;
	private $_hp = 0;
	private $_weapon = 0;
	private $_sprite = "img/ship1.jpg";
	static $verbose = FALSE;

	function __construct(array $arg) {
        $this->_type = "ship";
		if (array_key_exists('pp', $arg) &&
        array_key_exists('name', $arg) &&
        array_key_exists('posx', $arg) &&
        array_key_exists('posy', $arg) &&
        array_key_exists('movement', $arg) &&
        array_key_exists('orientation', $arg) &&
        array_key_exists('sizex', $arg) &&
        array_key_exists('sizey', $arg) &&
        array_key_exists('weapon', $arg) &&
        array_key_exists('hp', $arg)) {
            $this->_name = $arg['name'];
            $this->_ppmax = $arg['pp'];
            $this->_posx = $arg['posx'];
            $this->_posy = $arg['posy'];
            $this->_movement = $arg['movement'];
            $this->_orientation = $arg['orientation'];
            $this->_sizex = $arg['sizex'];
            $this->_sizey = $arg['sizey'];
            $this->_hp = $arg['hp'];
            $this->_weapon = $arg['weapon'];
        }
		else
			return (NULL);
		if (self::$verbose == TRUE)
			echo "Ship created - Name: ".$this->_name." PP: ".$this->_ppmax.PHP_EOL;
	}
	function __destruct() {
		if (self::$verbose == TRUE)
			echo "Ship destroyed - Name: ".$this->_name.PHP_EOL;
	}
	function doc() {
		print file_get_contents("Ship.doc.txt");
	}

	function __toString () {
		return (sprintf("Ship: P%d, PPmax: %d, name:%d, current pos: %d/%d",
        $this->_player, $this->_ppmax, $this->_name, $this->_posx, $this->_posy));
	}

    public function getTeam() { return ($this->_team); }
    public function setTeam(Fleet $team ) {
        $style = array ('opacity' => 0.95, 'border' => '1px inset #424242');
        if ($team->getPlayer() == 1){ $style['color'] = '#A61B1D'; $style['name'] = 'Team 1';}
        if ($team->getPlayer() == 2){ $style['color'] = '#313A99'; $style['name'] = 'Team 2';}
        if ($team->getPlayer() == 3){ $style['color'] = '#17912E'; $style['name'] = 'Team 3';}
        if ($team->getPlayer() == 4){ $style['color'] = '#E3CD24'; $style['name'] = 'Team 4';}
        $this->_style = new Style($style);
        $this->_team = $team;

    }

    public function getType() { return ($this->_type); }
    public function setType($val) { $this->_type = $val; }
    public function getStyle() { return ($this->_style); }
    public function getOrientation() { return ($this->_orientation); }
    public function setOrientation($val) { $this->_orientation = $val; }
    public function getMovement() { return ($this->_movement); }
    public function getPosX() { return ($this->_posx); }
    public function setPosX( $posx ) { $this->_posx = $posx; }
    public function getPosY() { return ($this->_posy); }
    public function setPosY( $posy ) { $this->_posy = $posy; }
    public function getSizeX() { return ($this->_sizex); }
    public function getSizeY() { return ($this->_sizey); }
	public function getName() { return ($this->_name); }
	public function getPP() { return ($this->_ppmax); }
	public function getTPP() { return ($this->_turnpp); }
	public function getPlayed() { return ($this->_played); }
	public function setPlayed() { return ($this->_played); }
	public function getFighted() { return ($this->_fight); }
	public function getMoved() { return ($this->_move); }
	public function getSprite() { return ($this->_sprite); }
	public function getWeapon() {
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
