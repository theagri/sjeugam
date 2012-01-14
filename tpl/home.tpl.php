<section id="home_entries">

<? foreach($d as $e):?>	
	<article id="e<?=$e->timestamp;?>">
	<?=$e->body;?>
	<time><?=$e->date;?></time>
	</article>
<? endforeach;?>

</section>
