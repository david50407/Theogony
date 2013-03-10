<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Theogony</title>
		<base href="//<?=$_SERVER["HTTP_HOST"]?>"><!--[if lte IE 6]></base><![endif]-->
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/main.css">
		<script src="js/jquery.js"></script>
<!--		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!--		<script src="js/jquery.history.js"></script>
		<script src="js/jquery.pjax.js"></script> -->
	</head>
	<body>
		<div id="container">
			<div id="header">
				<? #$this->_view('') ?>
			</div>
			<div id="main">
			</div>
			<div id="footer">
			</div>
		</div>
		<div id="debug">
<?= var_dump($_) ?>
			<br />
<? $__ = get_defined_functions() ?>
			<br />
<?= print_r($__['user']) ?>
		</div>
	</body>
</html>
