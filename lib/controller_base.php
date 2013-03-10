<?php
namespace Theogony\ActionController;
class Base
{
	protected $settings = array();
	protected $format = 'html';
	public function _view($action, $_)
	{
		if (isset($this->settings['layout']))
		{
			if (!@file_exists(dirname(__FILE__) . '/../app/views/layouts/' . $this->settings['layout'] . '.' . $this->format . '.php'))
				throw new \Theogony\Exceptions\NoAvailableLayoutException($this->settings['layout'] . '.' . $this->format);
			include dirname(__FILE__) . '/../app/views/layouts/' . $this->settings['layout'] . '.' . $this->format . '.php';
		}
		else
		{
			$layout = strtolower(preg_replace('/Controller$/', '', __CLASS__));
			if (@file_exists(dirname(__FILE__) . '/../app/views/layouts/' . $layout . '.' . $this->format . '.php'))
				include dirname(__FILE__) . '/../app/views/layouts/' . $layout . '.' . $this->format . '.php';
			else
				include dirname(__FILE__) . '/../app/views/layouts/application.' . $this->format . '.php';
		}
	}
	public function child()
	{
		
	}
}

?>
