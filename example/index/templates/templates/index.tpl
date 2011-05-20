<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset={$charset}"/> 
	<link rel="stylesheet" type="text/css" href="/style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/sell_style.css" media="screen" />
	<!--<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->
	<script src="/tabs.js"></script>
	<title>{$title}</title>
</head>
<body onLoad="tabs.setCallback(tabs);">
	<div id="tab-box">
		<div class="tab-menu">
			<ul class="tab-navigation inline">
				<li><a href="#" id="tab_prodam">Prodam</a></li>
				<li><a href="#" id="tab_koupim">Koupim</a></li>
			</ul>
			<ul class="tab-navigation right">
				<li><a href="#" id="tab_me_prispevky">Me prispevky</a></li>
				<li><a href="#" id="tab_podminky">Podminky</a></li>
			</ul>
		</div>
		<div id="tab-box-content">
			<div id="content_prodam" class="tab-content">{$content}</div>
			<div id="content_koupim" class="tab-content"><i>{$content}</i></div>
			<div id="content_me_prispevky" class="tab-content"><b>{$content}</b></div>
			<div id="content_podminky" class="tab-content">{$terms}</div>
		</div>
	</div>
</body>
</html>
