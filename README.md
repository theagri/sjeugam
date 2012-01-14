#SJEUGAM  - Static Journal Engine Using Git And Markdown
Because everything is an abbrevation nowadays... :)

_(Disclaimer: very experimental, might eat your breakfast, you're on your own etc)_

##Features:
* Write entries in Markdown
* Post using git repo
* Autopublish via cron jobs

##Bugs
* If you import all your posts in one go, the sorting will be screwed up since SJEUGAM uses the filesystem timestamp to sort entries. Note that this also affects the post date of entries. (Until this is fixed, I guess you can use touch to manually sort entries.)

##Clean urls
For this to work you need to manually set up a rewrite rule in whatever you use to host this.
For instance, if you're using nginx, this is how it could look:

	if (!-e $request_filename) {
		rewrite ^/(.*)$ /index.php?route=$1 last;
	}


You also need to change your sjeugam/config.php accordingly:

	define('SJEUGAM_USE_REWRITE',true);

After this is changed, you need to rebuild your cache for entry links to work.

##Automatic publishing
* Make sure you have a folder called posts_src in your SJEUGAM directory
* Set up a git repo so that when you pull, your .md files appear in the post_src directory. 
* You can either set up a cron job that cd's to your posts_src folder and runs a git pull (see example below) or just point your browser to http://yoursite/update to make the server do the same thing for you.

###Cron job example
Add the following line to your crontab (using sudo crontab -e):


	* * * * * sh /home/YOU/bin/update_blog.sh


Make sure to change YOU to your username.

Then, create ~/bin/update_blog.sh with the following (edited) contents:

	cd /home/YOURUSER/public_html/posts_src
	sudo -u YOURUSER git pull

This will make bash cd to your posts_src folder every minute and run git pull. This means you can't have a pubkey password for your user. If every minute is too often for you, just tweak your crontab accordingly.

##Credits

* [PHP-Markdown](https://github.com/michelf/php-markdown) by [Michel Fortin](https://github.com/michelf)
