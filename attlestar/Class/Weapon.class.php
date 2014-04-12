<?PHP

Class Weapon {

	private $_srange = 0;
	private $_mrange = 0;
	private $_lrange = 0;
	private $_damage = 0;
	private $_name = 0;
	private $_sprite = 0;

	public function __construct (array $arg) {
		if (array_key_exists('srange', $arg) &&
			array_key_exists('mrange', $arg) &&
			array_key_exists('lrange', $arg) &&
			array_key_exists('name', $arg) &&
			array_key_exists('sprite', $arg) &&
			array_key_exists('damage', $arg))
		{
			$this->_lrange = $arg['lrange'];
			$this->_mrange = $arg['mrange'];
			$this->_srange = $arg['srange'];
			$this->_damage = $arg['damage'];
			$this->_name = $arg['name'];
			$this->_sprite = $arg['sprite'];
		}
	}
	public function getLRange() { return ($this->_lrange); }

	public function getMRange() { return ($this->_mrange); }

	public function getSRange() { return ($this->_srange); }

	public function getDamage() { return ($this->_damage); }

	public function getName() { return ($this->_name); }

	public function getSprite() { return ($this->_sprite); }

	public function __toString() {
		return (sprintf("Weapon name is %s, dealing %d damage with a long range of %d, medium range of %d and short range of %d",
						$this->_name, $this->_damage, $this->_lrange, $this->_mrange, $this->_srange));
	}

	public function doc() {
		print file_get_contents("Weapon.doc.txt");
	}
}

?>