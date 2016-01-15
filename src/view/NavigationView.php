<?php

class NavigationView{
	
	public static $action = "action";
	public static $actionSearch = "search";
	public static $actionList = "list";
		
	public static function getAction(){
		
		if(isset($_GET[self::$action])){
			return $_GET[self::$action];
		}else{
			return self::$actionSearch;
			return $_GET[self::$action];
		}
	}
}