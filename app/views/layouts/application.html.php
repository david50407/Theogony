<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Theogony</title>
		<base href="http://<?=$_SERVER["HTTP_HOST"]?>"><!--[if lte IE 6]></base><![endif]-->
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/container.css" />
		<link rel="stylesheet" href="css/mainlist.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script src="js/jquery.history.js"></script>
		<script src="js/jquery.pjax.js"></script>
	</head>
	<body>
		<div id="masthead-container">
<?php // include(dirname(__FILE__) . '/template/masthead.php'); ?>
		</div>
		<div id="content-container">
			<div id="content">
				<div id="navigation-container">
<?php // include(dirname(__FILE__) . '/template/navigation.php'); ?>
				</div>
				<div id="navigation-background"></div>
				<div id="main">
					<div id="main-announcement" class="main-page">
						<div class="main-container">
<? $__ = get_defined_functions() ?>
<?= print_r($__['user']) ?>
						</div>
					</div>
					<div id="main-loading-template" class="hid">
						<div class="main-message">
							<p class="loading-spinner">
								<img src="static/images/loading.gif" />
								Loading...
							</p>
						</div>
					</div>
				</div>
				<div id="main-background"></div>
			</div>
		</div>
	</body>
</html>
