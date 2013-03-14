<?php
Theogony\ConfigCore::draw(function($config) {
	$config->database = new \Theogony\Database\Mysql(function(&$config) {
		$config->username = 'root';
		$config->password = 'toor';
		$config->database = 'hexameter';
	});

	$config->site = new ArrayObject();
	$config->site->title = 'Hexameter';
	$config->site->titleby = 'Hexameter -- A simple blog';
});
?>
