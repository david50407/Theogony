<?php
namespace Theogony;

class ConfigCore
{
	private static $__instance = null;
	private $_ = array();
	
	public static function getInstance()
	{
		if (self::$__instance == null)
			self::$__instance = new self();
		return self::$__instance;
	}

	private function __construct() {}

	public static function draw($callback)
	{
		if (is_callable($callback))
			if (is_object($callback))
				$callback(self::getInstance());
			else
				call_user_func_array($callback, self::getInstance());
		else
			throw new Exception\NotCallableFunctionException($callback);
	}

	public function __isset($k)
	{
		return isset($this->_[$k]);
	}

	public function __unset($k)
	{
		unset($this->_[$k]);
	}

	public function __get($k)
	{
		if (isset($this->_[$k]))
			return $this->_[$k];
	}

	public function __set($k, $v)
	{
		return $this->_[$k] = $v;
	}
}
?>
