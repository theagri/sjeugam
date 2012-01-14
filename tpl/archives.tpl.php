<section id="archives">
	<ul>
	<? foreach($d as $e):?>	
		<li id="e<?=$e->timestamp;?>">
		<a href="<?=$e->alias;?>">	
			<time><?=$e->date;?></time>
			<span><?=$e->title;?></span>
		</a>
		</li>
	<? endforeach;?>
	</ul>
</section>