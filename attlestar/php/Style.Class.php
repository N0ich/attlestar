<?php

class Style
{
	private $_color;
	private $_name;
	private $_opacity;
	private $_border;

	public function __construct(array $kwargs) {
		if (array_key_exists('color', $kwargs))
			$this->setColor($kwargs['color']);
		else
			$this->setColor('transparent');
		if (array_key_exists('name', $kwargs))
			$this->setName($kwargs['name']);
		else
			$this->setName('void');
		if (array_key_exists('opacity', $kwargs))
			$this->setOpacity($kwargs['opacity']);
		else
			$this->setOpacity(1);
		if (array_key_exists('border', $kwargs))
			$this->setBorder($kwargs['border']);
		else
			$this->setBorder('1 solid #000');
	}

	public function __destruct() {
		return ;
	}

	public function getBorder() { return ($this->_border); }
	public function setBorder( $border ) { $this->_border = $border; }
	public function getColor() { return ($this->_color); }
	public function setColor( $color ) { $this->_color = $color; }
	public function getName() { return ($this->_name); }
	public function setName( $name ) { $this->_name = $name; }
	public function getOpacity() { return ($this->_opacity); }
	public function setOpacity( $opacity ) { $this->_opacity = $opacity; }

	public function __toString() {
		return sprintf(' style ="background-color: %s; opacity: %s; border: %s;" title="%s"', $this->getColor(), $this->getOpacity(), $this->getBorder(), $this->getName());
	}
}

?>
