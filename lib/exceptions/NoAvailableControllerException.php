<?php
/*
 * @filename NoAvailableControllerException.php
 * @description 
 * @author davy
 *
 * @modify
 *     v0 2012.09.05 01:10 (GMT +8)
 *         initialize
 */

namespace Theogony\Exceptions;

class NoAvailableControllerException extends \Exception
{
	public $controller;
	public function __construct($controller, Exception $previous = null) {
		parent::__construct("", 0, $previous);
		$this->controller = $controller;
	}
	
	public function __toString() {
		return __CLASS__ . ": No available controller `" . $this->controller . "`\n";
	}
}

?>
