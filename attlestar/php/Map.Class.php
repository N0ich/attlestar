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
				print('<td id="' . $x . "x" . $y . '"  class="tile" ');
				if ($tile == null)
					print(' title="space" ' );
				else {
					print($tile->getStyle());
					if ($tile->getStyle() == " style =\"background-color: white; opacity: 0.95; border: 1px inset #424242;\" title=\"highlight\"")
						echo "onclick='move(\"".$x."\",\"".$y."\")'";
					else if ($tile->getStyle() == " style =\"background-color: pink; opacity: 0.95; border: 1px inset #424242;\" title=\"fire\"")
						echo "onclick='damage(\"".$x."\",\"".$y."\")'";
					else if ($tile->getStyle() != " style =\"background-color: #424242; opacity: 0.95; border: 1px inset #424242; border-radius: 20%;\" title=\"asteroide\"")
						echo "onclick='highlight(\"".$x."\",\"".$y."\")'";
			}
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
		else  {
			foreach ($elem->getElems() as $ship)
				$this->addElem($ship);
		}
	}
	public function unsetCoord($elem) {
        if (is_subclass_of($elem, 'IElem')) {
            for ($x = 0; $x <= $elem->getSizeX(); ++$x) {
                for ($y = 0; $y <= $elem->getSizeY(); ++$y) {
                    if ($elem->getPosX() >= 0 and $elem->getPosX() < $this->_size_x and $elem->getPosY() >= 0 and $elem->getPosY() < $this->_size_x) {
                        $this->_plate[$elem->getPosX() + $x][$elem->getPosY() + $y] = null;
                    }
                }
            }
        }

    }
	public function setCoord($elem) {
		if (is_subclass_of($elem, 'IElem')) {
			for ($x = 0; $x <= $elem->getSizeX(); ++$x) {
				for ($y = 0; $y <= $elem->getSizeY(); ++$y) {
					if ($elem->getPosX() >= 0 and $elem->getPosX() < $this->_size_x and $elem->getPosY() >= 0 and $elem->getPosY() < $this->_size_x) {
						$this->_plate[$elem->getPosX() + $x][$elem->getPosY() + $y] = $elem;
					}
				}
			}
		}
	}
	public function getElem() { return ($this->_elems); }
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
