<?php
namespace Theogony;

class RoutesCore
{
	private static $defaultMatches = array(
		array(
			'str' => ':controller(/:action(/:id))(.:format)',
			'regex' => '/(?P<controller>.+)(\/(?P<action>.+)(?P<id>.+)?)?(\.(?P<format>.+))?/'
		)
	);
	private static $__instance = null;
	private $__matches = array();
	public $root = 'welcome#index';
	public $predir = '';

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
		self::$__instance->parse();
	}

	public function match($var)
	{
		if (is_string($var))
			$var = array($var);

		$obj = array();
		$obj['params'] = array();
		$controller_override = null;
		foreach ($var as $k => $i)
		{
			if (substr($k, 0, 1) == ':') # param
				$obj['params'][substr($k, 1)] = $i;
			elseif (!is_numeric($k))
			{
				$obj['str'] = $k;
				$controller_override = $i;
			}
		}
		if (!isset($obj['str']))
			$obj['str'] = $var[0];

		if ($controller_override != null)
		{
			$controller_override = explode('#', $controller_override);
			if (count($controller_override) == 2) # controller#action
			{
				if ($controller_override[0] != '' && !isset($obj['params']['controller'])) # has pointed a controller
					$obj['params']['controller'] = $controller_override[0];
				if (!isset($obj['params']['action']))
					$obj['params']['action'] = $controller_override[1];
			}
			else if (!isset($obj['params']['controller']))
				$obj['params']['controller'] = $controller_override;
		}

		// make str to regexp
		$str = preg_replace('/\)/', ')?', $obj['str']);
		$str = preg_replace('/\./', '\.', $str);
		$str = preg_replace('/:(\w+)/', '(?P<${1}>\w+)', $str);
		$obj['regex'] = '#^' . $str . '$#';

		$this->__matches[] = $obj;
	}

	public function parse()
	{
		$request = $_SERVER['REQUEST_URI'];
		if (isset($_SERVER['QUERY_STRING']))
		{
			$pos = strrpos($_SERVER['REQUEST_URI'], "?" . $_SERVER['QUERY_STRING']);
			if ($pos !== false)
				$request = substr($request, 0, $pos);
		}
		$request_arr = array_values(array_diff(explode('/', $request), array(null, '')));
		if ($this->predir != '')
		{
			$predir = array_values(array_diff(explode('/', $this->predir), array(null, '')));
			if (count($predir) <= count($request_arr))
			{
				$flag = true;
				foreach ($predir as $i => $k)
					if ($request_arr[$i] != $predir[$i])
					{
						$flag = false;
						break;
					}
				if ($flag == true)
					for ($i = 0; $i < count($predir); $i++)
						array_shift($request_arr);
			}
		}
		$request = implode('/', $request_arr);
		if ($request == '')
		{
			$option = array();
			$target = explode('#', $this->root);
			$option['controller'] = $target[0];
			if (count($target) == 2)
				$option['action'] = $target[1];
			else
				$option['action'] = 'index';
		}
		else
			foreach ($this->__matches as $rule)
			{
				$match = array();
				if (preg_match($rule['regex'], $request, $match))
				{
					foreach ($match as $k => $i)
						if (is_numeric($k))
							unset($match[$k]);
	
					$option = $match + $rule['params'];
	
					if (!isset($option['controller']) || $option['controller'] == '')
						throw new \Theogony\Exceptions\NoAvailableControllerException(isset($option['controller']) ? $option['controller'] : '');
	
					break;
				}
			}
		if (!isset($option) || $option == NULL)
		{
			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
			header("Status: 404 Not Found");
			
			$option['status'] = 404;
			# TODO: load 404 page
			#header('Location: /');
			return;
		}
		else
		{
			if (!isset($option['format']))
				$option['format'] = 'html';

			if (!@file_exists(dirname(__FILE__) . '/../app/controllers/' . $option['controller'] . '_controller.php'))
				throw new \Theogony\Exceptions\NoAvailableControllerException($option['controller']);
			include_once dirname(__FILE__) . '/../app/controllers/' . $option['controller'] . '_controller.php';
			$controller = ucfirst(strtolower($option['controller'])) . 'Controller';
			$controller = new $controller();
			$temp = new \Theogony\Struct\DataCollection();
			$temp->option = $option;
			$controller->_setData($temp);
			$controller->_setFormat($option['format']);
			$controller->$option['action']($temp);
			$controller->_view($option['action']);
		}
	}
}

?>
