<?php
namespace AmitKhare;

class EasyTemplate{
	private $errors=[];
	private $basePath;
	private $templatePath;
	private $viewsPath;
	private $classVars=[];
	private $viewVars=[];
	public function __construct($basePath,$vars=[]){
		if(!$basePath){
			die("$basePath not set");
		}
		$this->basePath = $basePath;
		$this->templatePath = $basePath."/templates/";
		$this->viewsPath = $basePath."/views/";
		
		foreach ($vars as $key => $value) {
			$this->classVars[$key] = $value;
		}
	}

	public function view($file,$vars=[]){
		foreach ($this->classVars as $key => $value) {
			$$key = $value;
		}
		foreach ($vars as $key => $value) {
			$$key = $value;
		}
		ob_start();
		require($this->basePath.$file.'.php');
		return ob_get_clean();
	}

	public function parseFile($file){
		
	}
}