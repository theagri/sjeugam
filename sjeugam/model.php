<?php

function cmpTimestamp($a,$b) {
	if($a->timestamp == $b->timestamp) {return 0;}
	return $a->timestamp > $b->timestamp ? 1 : -1;
}

class SjeugamModel {

	private $path = './posts_src/';
	
	public function getEntries($limit=false,$override_cache=false) {
		$entry_files = $this->getFileList();
		$entries = array();
		foreach($entry_files as $entry_file) {
			$tmp_entry = new SjeugamEntry(sprintf('%s%s',$this->path,$entry_file),$override_cache);
			$entries[] = $tmp_entry;
		}
		usort($entries,'cmpTimestamp');
		if($limit) {
			$entries = array_slice($entries,0,$limit);
		}
		return $entries;
	}

	public function getEntry($alias) {
		foreach($this->getEntries() as $entry) {
			if($entry->alias == $alias) {
				return $entry;
			}
		}
		return false;		
	}

	public function getFileList() {
		$dir = scandir($this->path);
		foreach($dir as $k=>$file) {
			if(substr($file,-3) != '.md' || $file[0] == '_') {
				unset($dir[$k]);
			}
		}
		return $dir;
	}
	
}

class SjeugamEntry {

	public $path;
	public $date;
	public $timestamp;
	public $body;
	public $bodyWithoutTitle;
	public $url;
	public $title;
	public $alias;
	
	public function __construct($path,$override_cache=false) {
		$this->path = $path;
		$this->timestamp = filemtime($path);
		$this->date = date('Y-m-d H:i',$this->timestamp);

		$body = file_get_contents($path);

		$this->title = reset(explode("\n",$body));
		if($this->title[0] == '#') {
			$this->title = substr($this->title,1);
		}
		$alias = strtolower($this->title); // Makes everything lowercase (just looks tidier).  
		$alias = str_replace(array('å','ä','ö'),array('a','a','o'),$alias);
		$alias = preg_replace('/[^a-z0-9]+/','-',$alias); // Replaces all non-alphanumeric characters with a hyphen.  
		$alias = preg_replace('/[-]{2,}/','-',$alias); // Replaces one or more occurrences of a hyphen, with a single one.  
		$alias = trim($alias,'-'); // This ensures that our string doesn't start or end with a hyphen.  
		$this->alias = $alias;
		if(defined(SJEUGAM_USE_REWRITE) && SJEUGAM_USE_REWRITE) {
			$this->url = sprintf('%s%s',SJEUGAM_BASE_URL,$this->alias);
		}
		else {
			$this->url = sprintf('%s?route=%s',SJEUGAM_BASE_URL,$this->alias);
		}
		
		if(!file_exists($this->get_cache_path()) || $override_cache) {
			require_once('markdown.php');
			$this->body = Markdown($body);
			$this->body = preg_replace('#<h1>(.*)</h1>#i','<h1><a href="'.$this->url.'">$1</a></h1>',$this->body);
			$this->bodyWithoutTitle = preg_replace('#<h1>(.*)</h1>#i','',$this->body);
			file_put_contents($this->get_cache_path(),$this->body);
		}
		else {
			$this->body = file_get_contents($this->get_cache_path());
		}
	}
	
	private function get_cache_path() {
		return str_replace(array('posts_src','.md'),array('cache','.html'),$this->path);
	}
}
?>