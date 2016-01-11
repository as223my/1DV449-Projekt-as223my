<?php

require_once("./src/view/MashupView.php");
	
class MashupController{

	private $mashupView; 
	
	public function __construct(){

		$this->mashupView = new \MashupView();
	}
	
	public function loginView(){
		$html = $this->mashupView->loginNavbar();
		$html .= $this->mashupView->loginForm();
		return $html;
	}
}