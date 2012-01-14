		<footer>
			<a href="./#top">Home</a>
			<a href="./<?=SJEUGAM_USE_REWRITE ? '' :'?route=' ?>archives">Archives</a>
			<a href="./<?=SJEUGAM_USE_REWRITE ? '' :'?route=' ?>feed">RSS Feed</a>
		</footer>
		<? 
		if(defined('SJEUGAM_CLICKY_ID') && SJEUGAM_CLICKY_ID != ""): ?>
			<script src="//static.getclicky.com/js" type="text/javascript"></script>
			<script type="text/javascript">try{ clicky.init(<?=SJEUGAM_CLICKY_ID?>); }catch(e){}</script>
		<?endif;?>
	</body>
</html>