<?php
namespace Theogony;
class ControllerBase
{
	private $cache;
	protected $settings;
	protected $format = 'html';
	protected $data;
	public function __construct()
	{
		$this->cache = new \Theogony\Struct\DataCollection();
		$this->settings = new \Theogony\Struct\DataCollection();

		$this->cache->controller = strtolower(preg_replace('/Controller$/', '', get_called_class()));
		$this->cache->usedLayout = true;
	}

	public function _setData(&$collection)
	{
		$this->data = &$collection;
	}

	public function _view($action)
	{
		$_ = &$this->data; # sugar
		$config = \Theogony\ConfigCore::getInstance();
		$this->cache->action = $action;
		$layout_path = dirname(__FILE__) . '/../app/views/layouts/';
		if (isset($this->settings->layout))
		{
			if (!@file_exists($layout_path . $this->settings->layout . '.' . $this->format . '.php'))
				throw new \Theogony\Exceptions\NoAvailableLayoutException('layouts/' . $this->settings->layout . '.' . $this->format);
			include $layout_path . $this->settings->layout . '.' . $this->format . '.php';
		}
		else
		{
			if (@file_exists($layout_path . $this->cache->controller . '.' . $this->format . '.php'))
				include $layout_path . $this->cache->controller . '.' . $this->format . '.php';
			else if (@file_exists($layout_path . 'application.' . $this->format . '.php'))
				include $layout_path . 'application.' . $this->format . '.php';
			else
			{
				$path = dirname(__FILE__) . '/../app/views/' . $this->cache->controller . '/';
				$this->cache->usedLayout = false;
				if (!@file_exists($path . $action . '.' . $this->format . '.php'))
					throw new \Theogony\Exceptions\NoAvailableLayoutException($this->cache->controller . '/' . $action . '.' . $this->format);
				include $path . $action . '.' . $this->format . '.php';
			}
		}
	}
	public function import($file)
	{
		$_ = &$this->data; # sugar
		$config = \Theogony\ConfigCore::getInstance();
		$action = $this->cache->action;
		$path = dirname(__FILE__) . '/../app/views/' . $this->cache->controller . '/';
		$layout_path = dirname(__FILE__) . '/../app/views/layouts/';
		if (@file_exists($path . '_' . $file . '.' . $this->format . '.php'))
			include $path . '_' . $file . '.' . $this->format . '.php';
		else if (@file_exists($layout_path . '_' . $file . '.' . $this->format . '.php'))
			include $layout_path . '_' . $file . '.' . $this->format . '.php';
		else
			throw new \Theogony\Exceptions\NoAvailableLayoutException($this->cache->controller . '\_' . $file . '.' . $this->format);
	}
	public function mixin()
	{
		if (!$this->cache->usedLayout) return;

		$_ = &$this->data; # sugar
		$config = \Theogony\ConfigCore::getInstance();

		$path = dirname(__FILE__) . '/../app/views/' . $this->cache->controller . '/';
		$this->cache->usedLayout = false;
		if (!@file_exists($path . $action . '.' . $this->format . '.php'))
			throw new \Theogony\Exceptions\NoAvailableLayoutException($this->cache->controller . $action . '.' . $this->format);
		include $path . $action . '.' . $this->format . '.php';
	}
}

?>
