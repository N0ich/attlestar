<?php
require_once 'php/Style.Class.php';
require_once 'php/IElem.Class.php';

class Obstacle implements IElem {

	private $_posx = 0;
	private $_posy = 0;
	private $_sizex = 0;
	private $_sizey = 0;
	private $_name;
	private $_size;
	private $_pos;
	private $_style;
	private $_type;

	public function __construct(array $kwargs) {
		if (array_key_exists('name', $kwargs) and
			array_key_exists('posx', $kwargs) and
			array_key_exists('posy', $kwargs) and
			array_key_exists('sizex', $kwargs) and
			array_key_exists('sizey', $kwargs))
			{
				$this->setName($kwargs['name']);
				$this->_posx = $kwargs['posx'];
				$this->_posy = $kwargs['posy'];
				$this->_sizex = $kwargs['sizex'];
				$this->_sizey = $kwargs['sizey'];
				$this->setType('obstacle');
			}
		if (!array_key_exists('style', $kwargs))
			$this->setStyle(new Style(array( 'color' => '#2B2626', 'opacity' => 0.7, 'name' => 'obstacle') ) );
		else
			$this->setStyle($kwargs['style']);
	}

	public function getPosX() { return ($this->_posx); }
	public function getPosY() { return ($this->_posy); }
	public function getSizeX() { return ($this->_sizex); }
	public function getSizeY() { return ($this->_sizey); }
	public function getType() { return ($this->_Type); }
	public function setType( $Type ) { $this->_Type = $Type; }
	public function getName() { return ($this->_name); }
	public function setName( $name ) { $this->_name = $name; }
	public function getStyle() { return ($this->_style); }
	public function setStyle( $style ) { $this->_style = $style; }

}

?>
