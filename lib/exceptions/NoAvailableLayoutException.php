<?php
/*
 * @filename NoAvailableLayoutException.php
 * @description 
 * @author davy
 *
 * @modify
 *     v0 2012.09.05 01:10 (GMT +8)
 *         initialize
 */

namespace Theogony\Exceptions;

class NoAvailableLayoutException extends \Exception
{
	public $layout;
	public function __construct($layout, Exception $previous = null) {
		parent::__construct("", 0, $previous);
		$this->layout = $layout;
	}
	
	public function __toString() {
		return __CLASS__ . ": No available layout `" . $this->layout . "`\n";
	}
}

?>
