<?php
class Slide extends \Theogony\ModelBase
{
	public static $columns = array(
		'sid' => 'number',
		'markdown' => 'bool',
		'content' => 'string'
	);
}
?>
