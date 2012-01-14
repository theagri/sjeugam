<!DOCTYPE HTML>
<html>
	<head>
		<title>
			<? if(isset($d->title)):?><?=$d->title;?> &mdash; <? endif;?><?=SJEUGAM_SITE_NAME?>
		</title>
		<base href="<?=SJEUGAM_BASE_URL?>"></base>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="assets/style.css">
		<link rel="alternate" type="application/rss+xml" href="./<?=SJEUGAM_USE_REWRITE ? '' :'?route=' ?>feed">
	</head>
	<body>
	<header>
		<a name="top"></a>
	</header>