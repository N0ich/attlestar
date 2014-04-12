<?php
require_once 'Style.Class.php';
require_once 'IElem.Class.php';

class Obstacle implements IElem {

	private $_name;
	private $_size;
	private $_pos;
	private $_style;
	private $_type;

	public function __construct(array $kwargs) {
		if (array_key_exists('name', $kwargs) and array_key_exists('size', $kwargs)) {
			$this->setName($kwargs['name']);
			$this->setSize($kwargs['size']);
			$this->setPos($kwargs['pos']);
			$this->setType('obstacle');
		}
		if (!array_key_exists('style', $kwargs))
			$this->setStyle(new Style(array( 'color' => 'brown', 'opacity' => 0.7, 'name' => 'obstacle') ) );
		else
			$this->setStyle($kwargs['style']);
	}

	public function getType() { return ($this->_Type); }
	public function setType( $Type ) { $this->_Type = $Type; }
	public function getPos() { return ($this->_pos); }
	public function setPos( $pos ) { $this->_pos = $pos; }
	public function getName() { return ($this->_name); }
	public function setName( $name ) { $this->_name = $name; }
	public function getStyle() { return ($this->_style); }
	public function setStyle( $style ) { $this->_style = $style; }
	public function getSize() { return ($this->_size); }
	public function setSize( $size ) { $this->_size = $size; }

}

?>