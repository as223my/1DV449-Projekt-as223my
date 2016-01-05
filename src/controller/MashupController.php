<?php

require_once("./src/view/MashupView.php");
	
class MashupController{
	//check login before allowing acess
	private $mashupView; 
	
	public function __construct(){

		$this->mashupView = new \MashupView();
	}
	
	public function loginView(){
		
		return $this->mashupView->login(); 
	}
}
