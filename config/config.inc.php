<?php
Theogony\ConfigCore::draw(function($config) {
	$config->database = new \Theogony\Database\Mysql(function(&$config) {
		$config->host = '127.0.0.1';
		$config->username = 'root';
		$config->password = 'toor';
		$config->database = 'hexameter';
	});

	$config->site = new ArrayObject();
	$config->site->title = '一人一種 PHP FRAMEWORK';
});
?>
