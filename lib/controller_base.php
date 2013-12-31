<?php
namespace Theogony;
class ControllerBase
{
	private $cache;
	protected $settings;
	protected $format = 'html';
	protected $data;
	protected $mixinGlobalLayout = false;
	protected $forceLayout = false;
	public function __construct()
	{
		$this->cache = new \Theogony\Struct\DataCollection();
		$this->settings = new \Theogony\Struct\DataCollection();

		$this->cache->controller = strtolower(preg_replace('/Controller$/', '', get_called_class()));
		$this->cache->layouts = [];
	}

	public function _setData(&$collection)
	{
		$this->data = &$collection;
		return $this;
	}

	public function _setFormat($format)
	{
		$this->format = $format;
		return $this;
	}

	public function _mixinGlobalLayout($i = true)
	{
		$this->mixinGlobalLayout = $i;
		return $this;
	}
	public function _forceLayout($i = true)
	{
		$this->forceLayout = $i;
		return $this;
	}

	private function __layout_global()
	{
		return dirname(__FILE__) . '/../app/views/layouts/application.' . $this->format . '.php';
	}
	private function __layout_controller()
	{
		if ($this->settings->layout)
			$layout = $this->settings->layout;
		else
			$layout = $this->cache->controller;
		return dirname(__FILE__) . '/../app/views/layouts/' . $layout . '.' . $this->format . '.php';
	}
	private function __layout($action)
	{
		return dirname(__FILE__) . '/../app/views/' . $this->cache->controller . '/' . $action . '.' . $this->format . '.php';
	}

	public function _view($action)
	{
		$_ = &$this->data; # sugar
		$config = \Theogony\ConfigCore::getInstance();
		$this->cache->action = $action;
		$layout_path = dirname(__FILE__) . '/../app/views/layouts/';
		$pjax = isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] === 'true';
		if (isset($this->settings->layout) and !$pjax)
		{
			if (!@file_exists($this->__layout_controller()))
				throw new \Theogony\Exceptions\NoAvailableLayoutException('layouts/' . $this->settings->layout . '.' . $this->format);
			$this->cache->layouts[] = $this->__layout_controller();
		}
		else
		{
			if ($this->forceLayout || !$pjax) {
				if (@file_exists($this->__layout_global()))
					$this->cache->layouts[] = $this->__layout_global();
				if (@file_exists($this->__layout_controller()))
					$this->cache->layouts[] = $this->__layout_controller();
				if (count($this->cache->layouts) == 2 && !$this->mixinGlobalLayout)
					array_shift($this->cache->layouts);
			}
		}

		if (!@file_exists($this->__layout($action)) && count($this->cache->layouts) == 0)
			throw new \Theogony\Exceptions\NoAvailableLayoutException($this->cache->controller . '/' . $action . '.' . $this->format);
			$this->cache->layouts[] = $this->__layout($action);
		include array_shift($this->cache->layouts);
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
			throw new \Theogony\Exceptions\NoAvailableLayoutException($this->cache->controller . '/_' . $file . '.' . $this->format);
	}
	public function mixin()
	{
		if (count($this->cache->layouts) == 0) return;

		$_ = &$this->data; # sugar
		$config = \Theogony\ConfigCore::getInstance();

		include array_shift($this->cache->layouts);
	}
}

?>
