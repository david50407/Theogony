<?php
# named mysql but use mysqli as MySQL engine #
namespace Theogony\Database;

class Mysql
{
	private $config;
	public function __construct($callback)
	{
		$this->config = new \Theogony\Struct\DataCollection();

		if (is_callable($callback))
			if (is_object($callback))
				$callback($this->config);
			else
				call_user_func_array($callback, $this->config);
		else
			throw new Exception\NotCallableFunctionException($callback);
	}	
}
?>
