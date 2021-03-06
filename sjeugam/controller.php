<?php

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
			$this->render('home',array('d'=>$entries));
			$this->render('footer');
		}
		elseif($route == 'archives') {
			$entries = $this->model->getEntries();
			$this->render('header');
			$this->render('archives',array('d'=>$entries));
			$this->render('footer');
		}
		elseif($route == 'info') {
			$this->render('header');
			$this->render('info');
			$this->render('footer');
		}
		elseif($route == 'feed') {
			$entries = $this->model->getEntries(false,true);
			$this->render('feed',array('d'=>$entries));
		}
		elseif($route == 'update') {
			/*
			For this to work the web server must be run by the same user that has access to the repo.
			$output = shell_exec(sprintf('cd %s && git pull',SJEUGAM_POSTS_PATH));
			*/
			$this->model->getEntries(false,true);
			$this->render('header');
			$this->render('update');
			$this->render('footer');
		}
		else {
			$entry = $this->model->getEntry($route);
			$this->render('header',array('d'=>$entry));
			if($entry) {
				$this->render('entry',array('d'=>$entry));
			}
			else {
				$this->render('404');
			}
			$this->render('footer');
		}
	}
	
	private function render($template,$data=array()) {
		extract($data,EXTR_SKIP);
		include(sprintf('%s/%s.tpl.php',$this->tpl_dir,$template));	
	}
}
?>