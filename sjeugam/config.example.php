<?php
//This file must be called config.php for Sjeugam to work.
define('SJEUGAM_BASE_URL','http://yoursite.com/');
define('SJEUGAM_SITE_NAME','My simple web log');
define('SJEUGAM_SITE_DESCRIPTION','A longer description');
define('SJEUGAM_TIMEZONE','Europe/Stockholm');

/*
If you're using Clicky to track your visitor statistics, fill in the ID here
*/
define('SJEUGAM_CLICKY_ID','');

/*
For this to work you need to manually set up a rewrite rule in whatever you use to host this.
For instance, if you're using nginx, this is how it should look:
	if (!-e $request_filename) {
		rewrite ^/(.*)$ /index.php?route=$1 last;
	}
After this is changed, you need to rebuild your cache.
*/
define('SJEUGAM_USE_REWRITE',false);
?>