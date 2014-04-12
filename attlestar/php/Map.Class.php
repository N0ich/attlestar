<?php
Class Map {

	public static $verbose = FALSE;
	private $_plate;
	private $_elems;
	private $_size_x;
	private $_size_y;

	public function doc(){echo file_get_contents('Map.doc.txt'); }

	public function __construct (array $kwargs)
	{
		if (array_key_exists('width', $kwargs) and array_key_exists('height', $kwargs)) {
			$this->_size_x = $kwargs['width'];
			$this->_size_y = $kwargs['height'];
			$this->_plate = array();
			$this->_elems = array();
			for ($x = 0 ; $x < $this->getSize_x() ; ++$x){
				$this->_plate[$x] = array();
				for ($y = 0; $y < $this->getSize_y() ; ++$y){
					$this->_plate[$x][$y] = null;
				}
			}
			if (Map::$verbose)
				echo $this . ' constructed' . PHP_EOL;
		}
		else
			throw Exception("Invalid Plate Size");
	}

	public function printMap() {
		print('<table summary = "map">' . PHP_EOL);
		print('<tbody>' . PHP_EOL );
		$x = 0;
		foreach ($this->getPlate() as $line) {
			$y = 0;
			print("<tr>" . PHP_EOL );
			foreach ($line as $tile) {
				print('<td id="' . $x . "x" . $y . '"  class="tile" onmouseover="affpos(\''.$x.'x'.$y.'\')" ');
				if ($tile == null)
					print(' title="space" ' );
				else
					print($tile->getStyle());
				print('></td>' . PHP_EOL);
				++$y;
			}
			++$x;
			print( "</tr>" . PHP_EOL);
		}
		print( '</tbody>' . PHP_EOL );
		print( "</table>" . PHP_EOL );
	}

	public function addElem($elem) {
		if (is_subclass_of($elem, 'IElem')) {
			array_push($this->_elems, $elem);
			$this->setCoord($elem);
		}
	}

	public function setCoord($elem) {
		$pos = $elem->getPos();
		$size = $elem->getSize();
		if (Map::$verbose)
			{
				print_r($size);
				print_r($pos);
			}
		if (is_subclass_of($elem, 'IElem')) {
			for ($x = 0; $x <= $size['x']; ++$x) {
				for ($y = 0; $y <= $size['y']; ++$y) {
					if ($pos['x'] >= 0 and $pos['x'] < $this->_size_x and $pos['y'] >= 0 and $pos['y'] < $this->_size_x) {
						$this->_plate[$pos['x'] + $x][$pos['y'] + $y] = $elem;
					}
				}
			}
		}
	}
	public function getSize_x() { return ($this->_size_x); }
	private function setSize_x( $size_x ) { $this->_size_x = $size_x; }
	public function getSize_y() { return ($this->_size_y); }
	private function setSize_y( $size_y ) { $this->_size_y = $size_y; }
	public function getPlate() { return ($this->_plate); }

	/* public function __get ( $att ) */
	/* { */
	/* 	print('Attempt to access \''. $att . '\' atribute to \'' . $value . '\', this script should die' . PHP_EOL); */
	/* 	return ; */
	/* } */

	/* public function __set ( $att, $value ) */
	/* { */
	/* 	print('Attempt to set \''. $att . '\' atribute to \'' . $value . '\', this script should die' . PHP_EOL); */
	/* 	return ; */
	/* } */

	public function __destruct ()
	{
		if (Map::$verbose)
			echo $this . ' destructed' . PHP_EOL;
		return ;
	}

	public function __toString()
	{
		return sprintf('(Map: width :%4s height: %4s)', $this->getSize_x(), $this->getSize_y());
	}
}

?>
