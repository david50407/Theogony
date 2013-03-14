<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$config->site->titleby?></title>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><a href='\'><?=$config->site->title?></a></h1>
<!-- Import navbar BEGIN -->
<? $this->import('navbar') ?>
<!-- Import navbar  END -->
		</div>
		<div id="body">
			<div id="main">
<? #if ($_->articles->count == 0): ?>
				<div class="tip">
					<span class="icon"></span>
					<span>No articles.</span>
				</div>
<? #endif; ?>
				<div class="article">
					<div class="title">
						<h3></h3>
						<div class="detail">
							<span class="timestamp"></span>
							<span class="author"></span>
						</div>
					</div>
					<div class="content">
						<span class="moreinfo"></span>
					</div>
				</div>
			</div>
			<div id="sidebar">
				<div class="sidebox">
					<div class="title"></div>
					<div class="content"></div>
				</div>
				<div class="sidebox">
					<div class="title"></div>
					<div class="content"></div>
				</div>
				<div class="sidebox">
					<div class="title"></div>
					<div class="content"></div>
				</div>
			</div>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>
