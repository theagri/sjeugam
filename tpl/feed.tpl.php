<?='<?xml version="1.0" encoding="utf-8"?>'?>
<rss version="2.0">
<channel>
<title><?=SJEUGAM_SITE_NAME?></title>
<link><?=SJEUGAM_BASE_URL?></link>
<description><?=SJEUGAM_SITE_DESCRIPTION?></description>
<!--<lastBuildDate><<?=date('D d M Y H:i:s e')?>/lastBuildDate>-->
<language>en-us</language>
<? foreach($d as $e):?>	
<item>
<title><?=$e->title?></title>
<link><?=$e->url;?></link>
<guid><?=$e->url;?></guid>
<pubDate><?=date('D d M Y H:i:s e',$e->timestamp)?></pubDate>
<description><![CDATA[ <?=$e->bodyWithoutTitle?> ]]></description>
</item>
<? endforeach;?>
</channel>
</rss>