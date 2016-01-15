<?php

require_once("./src/controller/MashupController.php");
require_once("./src/view/NavigationView.php");

class NavigationController{
	
	public function doControll(){
		
		switch (\NavigationView::getAction()){
			case \NavigationView::$actionList:
				$controller = new MashupController();
				return $controller->getList();
				break;
					
			default:
			$controller = new MashupController();
			return $controller->getSearchContent();
			break;
		}
	}
}