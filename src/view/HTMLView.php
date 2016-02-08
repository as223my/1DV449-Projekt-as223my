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
				
				<script>
    				var checkConnection = function(){
                        Offline.check()
                        if(Offline.state === 'down'){
                            if(window.location.href !== 'https://www.anniesahlberg.se/1DV449-Project/?action=list'){
                                document.getElementById('search').disabled = true;
                            }
                            var buttons = document.getElementsByTagName('button');
                            for(var i = 0; i < buttons.length; i++){
                                buttons[i].disabled = true;
                            }
                        }else{
                            if(window.location.href !== 'https://www.anniesahlberg.se/1DV449-Project/?action=list'){
                                document.getElementById('search').disabled = false;
                            }
                            var buttons = document.getElementsByTagName('button');
                            for(var i = 0; i < buttons.length; i++){
                                buttons[i].disabled = false;
                            }
                        }
                    };
                    setInterval(checkConnection, 3000);
		        </script>
		        
		        <link rel='icon' type='image/ico' href='favicon.ico'>
				<link rel='stylesheet' href='css/offline-theme-dark.css'>
 				<link rel='stylesheet' href='css/offline-language-english.css'>
 				<script type='text/javascript' src='javascript/offline.min.js'></script>
			
				<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' 
				integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
				<link rel='stylesheet' type='text/css' href='css/style.css' media='screen and (min-width:951px)' />
    			<link rel='stylesheet' type='text/css' href='css/smallstyle.css' media='screen and (max-width:950px)' />
			</head>
			<body>
				$content
			</body>
		</html>";
	}
}