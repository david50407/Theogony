<?php
namespace Theogony;
class ModelBase
{
	protected static $columns = array();
	protected $instance = NULL;
	private $cache;
	private $__data = array();
	public function __construct($resource)
	{
		$this->cache = new \Theogony\Struct\DataCollection();
		if (isset($resource))
		{
			$model = get_called_class();
			foreach ($model::$columns as $k => $v)
			{
				if (!isset($resource[$k])) continue;
				switch ($v)
				{
					case 'd':
					case 'n':
					case 'number':
						$this->__data[$k] = intval($k);
						break;
					case 'b':
					case 'bool':
						if (strtolower($resource[$k]) == 'n' || strtolower($resource[$k]) == 'no' || \
							strtolower($resource[$k]) == 'f' || strtolower($resource[$k]) == 'false' || \
							strtolower($resource[$k]) == '0' || strtolower($resource[$k]) == '')
							$this->__data[$k] = false;
						else
							$this->__data[$k] = true;
						break;
					case 's':
					case 'string':
					default:
						$this->__data[$k] = $resource[$k];
						break;
				}
			}
		}
	}

	# dangerous
	public static function all()
	{
		$model = get_called_class();
		$table = strtolower(\Theogony\Helper\Inflector::pluralize($model));
		$db = \Theogony\ConfigCore::getInstance()->database;

		$result = $db->from($table)->where('1')->run();

		$ret = array();
		foreach ($result as $res)
			$ret[] = new $model($res);

		return $ret;
	}

	public static function limit($times)
	{
		$model = get_called_class();
		$table = strtolower(\Theogony\Helper\Inflector::pluralize($model));
		$db = \Theogony\ConfigCore::getInstance()->database;

		$result = $db->from($table)->limit($times)->run();

		$ret = array();
		foreach ($result as $res)
			$ret[] = new $model($res);

		return $ret;
	}

	public function __get($k)
	{
		if (!isset($this->__data))
			return null;
		return $this->__data[$k];
	}
}
?>
