<?php

class HTMLView{

	public function echoHTML($content){
		
		if ($content === NULL){
			throw new \Exception("HTMLView::echoHTML does not allow body to be nu" );
		}
			
		echo "
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset ='utf-8' />
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<title>Never-miss</title>
				<link rel='icon' type='image/ico' href='favicon.ico'>
				<link rel='stylesheet' href='lib/bootstrap/css/bootstrap.min.css'>
				<link rel='stylesheet' type='text/css' href='css/style.css' media='screen and (min-width:951px)' />
    			<link rel='stylesheet' type='text/css' href='css/smallstyle.css' media='screen and (max-width:950px)' />

    			<link rel='stylesheet' href='css/offline-theme-dark.css'>
 				<link rel='stylesheet' href='css/offline-language-english.css'>
 				<script type='text/javascript' src='javascript/offline.min.js'></script>
			</head>
			<body>
				$content
			</body>
		</html>";
	}
}