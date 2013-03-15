<?php
# named mysql but use mysqli as MySQL engine #
namespace Theogony\Database;

class Mysql
{
	private $config;
	private $connection;
	private $command = array();
	private $deplicated = false;
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

		$this->connection = new \mysqli($this->config->host, $this->config->username, $this->config->password, $this->config->database, 3306);
		$this->connection->query("SET NAMES `UTF8`");
	}

	public function __clone()
	{
		$this->deplicated = true;
		$this->command = array();
	}

	public function from($table)
	{
		if (!$this->deplicated)
			$rtn = clone $this;
		else
			$rtn = $this;
		$rtn->command['from'] = $this->connection->real_escape_string($table);

		return $rtn;
	}

	public function where($fetch)
	{
		if (!$this->deplicated)
			$rtn = clone $this;
		else
			$rtn = $this;

		$rtn->command['fetch'] = $this->connection->real_escape_string($fetch);

		return $rtn;
	}

	public function limit($limit)
	{
		if (!$this->deplicated)
			$rtn = clone $this;
		else
			$rtn = $this;

		$rtn->command['limit'] = intval($limit);

		return $rtn;
	}

	public function run()
	{
		if (!isset($this->command['from']))
			return array();
		$sql = 'select * from `' . $this->command['from'] . '`';

		if (isset($this->command['where']))
			$sql .= ' where ' . $this->command['where'];

		if (isset($this->command['limit']))
			$sql .= ' limit ' . $this->command['limit'];

		$result = $this->connection->query($sql);

		$rtn = array();
		while ($row = $result->fetch_assoc())
			$rtn[] = $row;

		return $rtn;
	}
}
?>
