"use strict";

var mashup = {
    toAdd : [],
    newList : [],


    init:function(e){
		$(".add").click(function(){
			var id = this.id; 
            $.ajax({ 
                type: 'GET', 
                url: './src/model/search.json', 
                dataType:'json',
                success: function (result) { 
                	for(var i=0; i < result.length; i++){
                		if(result[i].imdbID == id){
                			mashup.toAdd.push(result[i].imdbID);
                			mashup.toAdd.push(result[i].imdbRating);
                			mashup.toAdd.push(result[i].Title);
                			mashup.toAdd.push(result[i].Year);
                			mashup.toAdd.push(result[i].Poster);
                			mashup.toAdd.push(result[i].Plot);
                		}
                    }

                    $.ajax({ 
                		type: 'GET', 
                		url: './src/model/list.json', 
                		dataType:'json',
                		success: function (result) { 
                			if(result != null){
		                		for(var i=0; i < result.length; i++){
			                		mashup.newList.push(result[i]); 
		                		}
	                		}
                			mashup.newList.push(mashup.toAdd);

                			 $.ajax({ 
				                type: 'post',                    
				              	url:'src/model/addToList.php', 
				              	data:{"list" : mashup.newList},
				              	dataType:'text',     
				                success: function (result) {
				                	mashup.newList = []; 
				                	mashup.toAdd = [];
				                	$('#'+id).prop('disabled', true);
				                	$('#'+id).css('color', 'black');
				                	id = "";
				                }
				            });
                		}
            		});	
                }
            });
        });

		$(".remove").click(function(){ 
			var id = this.id; 
			var list = []; 
            $.ajax({ 
                type: 'GET', 
                url: './src/model/list.json', 
                dataType:'json',
                success: function (result) {  
                	for(var i=0; i < result.length; i++){
                		if(result[i][0] == id){
                		//	result[i].splice(0,6); 
                		}else{
                			list.push(result[i]); 
                		}
                    }
                    //list.push(result); 
                    $.ajax({ 
				        type: 'post',                    
				        url:'src/model/addToList.php', 
				        data:{"list" : list},
				        dataType:'text',     
				        success: function (result) {
				          location.reload(window.location.href);
				        }
				    });
                }
            });
        });
		
    },       
};
    
window.onload = mashup.init;