"use strict";

var mashup = {
    toAdd : [],
    newList : [],

    init:function(e){

        // Add a movie or a tv-show to list file.
		$(".add").click(function(){
			var id = this.id; // ButtonId (imdbID). 
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
                            // Don't add doublets to list
                            for(var j=0; j < mashup.newList.length; j++){
                                if(jQuery.inArray(mashup.toAdd[0], mashup.newList[j]) !== -1){
                                    mashup.toAdd = [];
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

        // Remove a movie or tv-show from list. 
		$(".remove").click(function(){ 
			var id = this.id; // ButtonId (imdbID).
			var list = []; 
            $.ajax({ 
                type: 'GET', 
                url: './src/model/list.json', 
                dataType:'json',
                success: function (result) {  
                	for(var i=0; i < result.length; i++){
                		if(result[i][0] == id){
                		}else{
                			list.push(result[i]); 
                		}
                    }
        
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