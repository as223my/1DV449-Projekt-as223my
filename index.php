<?php

require_once("src/view/HTMLView.php");
require_once("src/controller/NavigationController.php");
session_start(); 

$view = new \HTMLView();
$navigation = new \NavigationController();

$content = $navigation->doControll();

$view->echoHTML($content); 