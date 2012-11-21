<?php
/*
 * @filename NotCallableFunctionException.php
 * @description routes all dymatic pages.
 * @author davy
 *
 * @modify
 *     v0 2012.08.23 18:25 (GMT +8)
 *         initialize
 */

namespace Theogony\Exceptions;

class NotCallableFunctionException extends \Exception
{
	public function __construct($func, Exception $previous = null) {
		parent::__construct("", 0, $previous);
		if (is_array($func))
			if (count($func) == 2)
			{
				if (is_object($func[0]))
					$this->message .= "object[" . get_class($func[0]) . "]->";
				else
					$this->message .= $func[0] . "::";
				$this->message .= $func[1] . "()";
			}
			else
				$this->message .= $func[0] . "()";
		elseif (is_string($func))
			$this->message .= $func . "()";
		else
			$this->message .= "Anonymous function";
	}
	
	public function __toString() {
		return __CLASS__ . ": {$this->message}\n";
	}
}

?>
