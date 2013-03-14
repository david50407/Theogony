<?php
namespace Theogony;
class ModelBase
{
	protected $instance = NULL;
	private $cache;
	private $__data;
	public function __construct($resource)
	{
		$this->cache = new \Theogony\Struct\DataStruct();
		if (isset($resource))
			$this->__data = $resource;
	}

	public static function limit($times)
	{
		$model = get_called_class();
		$db = \Theogony\ConfigCore::getInstance()->database;

		$result = $db->from($model)->limit($times)->do();

		$ret = array();
		foreach ($result as $res)
			$ret[] = new $model($res);
	}

	public __get($k)
	{
		if (!isset($this->__data))
			return null;
		return $this->__data[$k];
	}
}
?>
