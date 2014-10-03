<?PHP

Class Highlight implements IElem {

	private $_posx;
	private $_posy;
	private $_sizex;
	private $_sizey;
	private $_mv;
	private $_style;

	public function __construct($ship, $status, $orientation) {
		$this->_posx = $ship->getPosX();
		$this->_posy = $ship->getPosY();
		if ($status == "move")
		{
			if ($orientation == 1 || $orientation == 3)
			{
				$this->_sizex = 20;
				$this->_sizey = 1;
			}
			if ($orientation == 3)
			{			
				$this->_posx -= 20;
				if ($this->_posx < 0)
					$this->_posx = 0;
			}
			if ($orientation == 2 || $orientation == 4)
			{
				$this->_sizey = 20;
				$this->_sizex = 1;
			}
			if ($orientation == 2)
			{
				$this->_posy -= 20;
				if ($this->_posy < 0)
					$this->_posy = 0;
			}
			$this->_type = 'highlight';
			$this->_style = new Style (array('opacity' => 0.95,
											'border' => '1px inset #424242',
											'color' => '#D9D0D0',
											'name' => 'highlight'));
		}
		else if ($status == "fire")
		{
			$this->_type = 'fire';
			$this->_style = new Style (array('opacity' => 0.95,
											 'border' => '1px inset #424242',
											 'color' => '#D17C21',
											 'name' => 'fire'
										));
			if ($orientation == 1 || $orientation == 3)
			{
				$this->_sizex = 30;
				$this->_sizey = 1;
			}
			if ($orientation == 3)
			{
				$this->_posx -= 30;
				if ($this->_posx < 0)
					$this->_posx = 0;
			}
			if ($orientation == 2 || $orientation == 4)
			{
				$this->_sizey = 30;
				$this->_sizex = 1;
			}
			if ($orientation == 2)
			{
				$this->_posy -= 30;
				if ($this->_posy < 0)
					$this->_posy = 0;
			}
		}
		else if ($status == "rotate")
		{
			$this->_type = 'rotate';
			$this->_style = new Style (array('opacity' => 0.95,
											 'border' => '1px inset #424242',
											 'color' => '#000000',
											 'name' => 'rotate'
										   ));
			if ($orientation == 1 || $orientation == 3)
			{
				$this->_sizey = 3;
				$this->_posy -= 1;
				$this->_sizex = 1;
				if ($this->_posy < 0)
					$this->posy = 0;
			}
			if ($orientation == 2 || $orientation == 4)
			{
				$this->_sizex = 5;
				$this->_sizey = 1;
				$this->_posx -= 2;
				if ($this->_posx < 0)
					$this->posx = 0;
			}
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
