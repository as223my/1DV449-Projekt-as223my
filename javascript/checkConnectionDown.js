"use strict";

var connection = {
      
    init:function(e){
	   setInterval(function(){ 
    		if(navigator.onLine === false){
    			location.reload(window.location.href);
    		}
		}, 5000);
    },
  
};
    
window.onload = connection.init;