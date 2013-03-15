<!DOCTYPE HTML>
<html lang="zh_TW">
<head>
	<meta charset="UTF-8">
	<title><?=$config->site->title?></title>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/css/reveal.min.css">
	<link rel="stylesheet" href="/css/print.css" media="print">
	<link rel="stylesheet" href="/css/theme/default.css" id="theme">
	<!-- For syntax highlighting -->
	<link rel="stylesheet" href="/css/highlight/zenburn.css">
<!--[if lt IE 9]>
	<script src="/js/html5shiv.js"></script>
<![endif]-->
	<script src="/js/head.min.js"></script>
</head>
<body>
	<div class="reveal">
		<div class="slides">
<? if (count($_->slides) == 0): ?>
			<section data-markdown='\no-slides.md' data-separator="^\n\n\n" data-vertical="^\n\n"></section>
<? else: ?>
<? 	foreach ($_->slides as $slide): ?>
<? 		if ($slide->markdown): ?>
			<section data-markdown>
				<script type="text/template">
<?=$slide->content?>
				</script>
			</section>
<? 		else: ?>
			<section>
<?=$slide->content?>
			</section>
<? 		endif; ?>
<? 	endforeach; ?>
			<section>
				<section>
					<h1>Router</h1>
					<hr />
					<p>regex rocks !</p>
				</section>
				<section>
					<pre><code>
:controller(/:action(/:id))(.:format)
					</code></pre>
				</section>
			</section>
<? endif; ?>
		</div>
	</div>
<!-- Import navbar BEGIN -->
<? $this->import('navbar') ?>
<!-- Import navbar  END -->
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
