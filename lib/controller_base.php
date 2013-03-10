<?php
namespace Theogony\ActionController;
class Base
{
	private $cache;
	protected $settings;
	protected $format = 'html';
	public function __construct($controller)
	{
		$this->cache = new \Theogony\Struct\DataCollection();
		$this->settings = new \Theogony\Struct\DataCollection();

		$this->cache->controller = strtolower(preg_replace('/Controller$/', '', $controller));
	}

	public function _view($action, $_)
	{
		$layout_path = dirname(__FILE__) . '/../app/views/layouts/';
		if (isset($this->settings->layout))
		{
			if (!@file_exists($layout_path . $this->settings->layout . '.' . $this->format . '.php'))
				throw new \Theogony\Exceptions\NoAvailableLayoutException($this->settings->layout . '.' . $this->format);
			include $layout_path . $this->settings->layout . '.' . $this->format . '.php';
		}
		else
		{
			if (@file_exists($layout_path . $this->cache->controller . '.' . $this->format . '.php'))
				include $layout_path . $this->cache->controller . '.' . $this->format . '.php';
			else if (@file_exists($layout_path . 'application.' . $this->format . '.php'))
				include $layout_path . 'application.' . $this->format . '.php';
			else
				throw new \Theogony\Exceptions\NoAvailableLayoutException($this->cache->controller . '.' . $this->format);
		}
	}
	public function yield()
	{
		
	}
}

?>
