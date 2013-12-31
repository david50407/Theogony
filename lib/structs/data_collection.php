<?php
namespace Theogony\Struct;
class DataCollection
{
	protected $_ = array();
	public function __construct()
	{
		$this->_ = array();
	}

	public function _reset()
	{
		$this->_ = array();
	}

	public function __isset($k)
	{
		return isset($this->_[$k]);
	}

	public function __unset($k)
	{
		unset($this->_[$k]);
	}

	public function &__get($k)
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
