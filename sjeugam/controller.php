<?php
date_default_timezone_set('Europe/Stockholm');
/*
Sjeugam – Fast, Lightweight Blog
Uses Markdown

error_reporting(E_ALL);
ini_set('display_errors',1);
*/


class SjeugamController {

	private $tpl_dir = './tpl';

	public function __construct($route=null) {
		$this->model = new SjeugamModel();
		
		$this->parseRoute($route);
		$this->model->getEntries();
	}
	
	private function parseRoute($route=null) {
	
		if(empty($route) || is_null($route)) {
			$entries = $this->model->getEntries(5);
			$this->render('header');
			$this->render('home',$entries);
			$this->render('footer');
		}
		elseif($route == 'archives') {
			$entries = $this->model->getEntries();
			$this->render('header');
			$this->render('archives',$entries);
			$this->render('footer');
		}
		elseif($route == 'info') {
			$this->render('header');
			$this->render('info');
			$this->render('footer');
		}
		elseif($route == 'feed') {
			$entries = $this->model->getEntries(false,true);
			$this->render('feed',$entries);
		}
		elseif($route == 'update') {
			$entries = $this->model->getEntries(false,true);
			$this->render('header');
			$this->render('update',$entries);
			$this->render('footer');
		}
		else {
			$entry = $this->model->getEntry($route);
			$this->render('header',$entry);
			if($entry) {
				$this->render('entry',$entry);
			}
			else {
				$this->render('404');
			}
			$this->render('footer');
		}
	}
	
	private function render($template,$data=null) {
		if(!is_null($data)) {
			$d = $data;
		}	
		include(sprintf('%s/%s.tpl.php',$this->tpl_dir,$template));	
	}
}
?>