<?php
Theogony\ConfigCore::draw(function($config) {
	$config->database = new \Theogony\Database\Mysql(function(&$config) {
		$config->host = '127.0.0.1';
		$config->username = 'root';
		$config->password = 'toor';
		$config->database = 'Theogony';
	});

	$config->site = new ArrayObject();
	$config->site->title = 'Theogony';
  $config->site->baseurl = 'http://' . $_SERVER["SERVER_NAME"] . '/';
});
?>
