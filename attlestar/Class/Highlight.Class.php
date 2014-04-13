<?PHP

Class Highlight implements IElem {

	private $_posx;
	private $_posy;
	private $_sizex;
	private $_sizey;
	private $_mv;
	private $_style;

	public function __construct($ship, $status) {
		$this->_posx = $ship->getPosX();
		$this->_posy = $ship->getPosY();
		$this->_sizex = 1;
		if ($status == "move")
		{
			$this->_sizey = 20;
			$this->_type = 'highlight';
			$this->_style = new Style (array('opacity' => 0.95,
											 'border' => '1px inset #424242',
											 'color' => 'white',
											 'name' => 'highlight'
										   ));
		}
		else
		{
			$this->_type = 'fire';
			$this->_style = new Style (array('opacity' => 0.95,
											 'border' => '1px inset #424242',
											 'color' => 'pink',
											 'name' => 'fire'
										   ));
			$this->_sizey = 30;
		}
	}

	public function getType() { return ($this->_type); }
    public function getStyle() { return ($this->_style); }
    public function getPosX() { return ($this->_posx); }
    public function getPosY() { return ($this->_posy); }
	public function getSizeX() { return ($this->_sizex); }
    public function getSizeY() { return ($this->_sizey); }
}

?>