<!DOCTYPE HTML>
<html lang="zh_TW">
<head>
	<meta charset="UTF-8">
	<title><?= $config->site->title; ?></title>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/css/reveal.min.css">
	<link rel="stylesheet" href="/css/print.css" media="print">
	<link rel="stylesheet" href="/css/theme/default.css" id="theme">
	<!-- For syntax highlighting -->
	<link rel="stylesheet" href="/css/highlight/tomorrow-night-bright.css">
	<link rel="stylesheet" href="/css/timer.css">
<!--[if lt IE 9]>
	<script src="/js/html5shiv.js"></script>
<![endif]-->
	<script src="/js/head.min.js"></script>
</head>
<body>
	<div class="reveal">
		<div class="slides">
<?php if (count($_->slides) == 0): ?>
			<section data-markdown='\no-slides.md' data-separator="^\n\n\n" data-vertical="^\n\n"></section>
<?php else: ?>
<?php 	foreach ($_->slides as $slide): ?>
<?php 		if ($slide->markdown): ?>
			<section data-markdown>
				<script type="text/template">
<?= $slide->content; ?>
				</script>
			</section>
<?php 		else: ?>
			<section>
<?= $slide->content; ?>
			</section>
<?php 		endif; ?>
<?php 	endforeach; ?>
<?php endif; ?>
		</div>
	</div>
	<div class='timer'>	</div>
	<script src="/js/timer.js"></script>
	<script src="/js/reveal.min.js"></script>
	<script>
		Reveal.initialize({
			controls: true,
			progress: true,
			history: true,
			keyboard: true,
			overview: true,
			center: true,
			mouseWheel: true,

			transition: 'default', // default/cube/page/concave/zoom/linear/fade/none

			width: 1024,
			height: 768,

			// Optional libraries used to extend on reveal.js
			dependencies: [
				{ src: '/js/classList.js', condition: function() { return !document.body.classList; } },
				{ src: '/js/markdown/showdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
				{ src: '/js/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
				{ src: '/js/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
				{ src: '/js/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }
			]
		});
	</script>
</body>
</html>
