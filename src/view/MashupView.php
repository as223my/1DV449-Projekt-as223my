<?php

class MashupView{

	public function didUserPressSearch(){
		if(isset($_POST["searchForm"])){
			return array($_POST['token'], $_POST['searchinput']);
		}else{
			return null;
		}	
	}

	public function navbar(){
		$html = "
      	<nav class='navbar navbar-inverse navbar-fixed-top'>
      		<div class='container'>
        		<div class='navbar-header'>
          			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar'>
            			<span class='icon-bar'></span>
           				<span class='icon-bar'></span>
          			</button>
          			<p id='brand'> <img src='css/tv.png' id='tvpic' alt='tv'>Never-miss</p>
        		</div>
        		<div id='navbar' class='collapse navbar-collapse'>
          			<ul class='nav navbar-nav'>
            			<li><a href='?action=".NavigationView::$actionSearch."' id='navlink1' active>Search</a></li>
            			<li><a href='?action=".NavigationView::$actionList."' id='navlink2'>List</a></li>
          			</ul>
        		</div>
      		</div>
    	</nav>"; 

    	return $html;
	}

	public function searchView($token, $message){
		$html = "
	    	<div class='container-fluid'>
	          	<div class='row'>
					<div class='col-md-6 col-md-offset-3' id='searchdiv'>
						<h1>Search!</h1>
						<form method='post' action='?action=" .NavigationView::$actionSearch. "' class='form-horizontal'>
					    	<div class='form-group'>
					    		<div class='col-sm-10'>
					      			<input type='text' class='form-control' id='search' name='searchinput' placeholder='for a movie or a tv show' required autofocus>
					      			<input type='hidden' name='token' value=$token>
					    		</div>
					  		</div>
					  		<div class='form-group'>
					    		<div class='col-sm-10'>
					      			<button type='submit' name='searchForm' class='btn btn-default' id='searchbutton'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>
					      			<p class='search-message'>$message</p>
					    		</div>
	  						</div>
						</form>
					</div>
		  		</div>
	        </div>";

    	return $html;
	}

	// Display list of movies/tv-shows. 
	public function listView($list, $epguides){

		$html = "
			<div class='list-group' id='showList'>";

			for($i=0; $i < count($list); $i++){
				
				$html .= $this->displayRating($list, $i); 

  				$html .="
				<button type='button' class='btn btn-default btn-lg remove'  id=".$list[$i]["imdbID"].">
  				<span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>";

  				$html .= $this->displayInformation($list, $epguides, $i);
			}

		$html .= "</div>";

		return $html; 
	}

	// Display search result of movies/tv-shows. 
	public function searchResult($completeResults, $epguides){
		$html = "
			<div class='list-group' id='resultList'>";

			for($i=0; $i < count($completeResults); $i++){

				$html .= $this->displayRating($completeResults, $i); 
				
  				$html .="
				<button type='button' class='btn btn-default btn-lg add'  id=".$completeResults[$i]["imdbID"].">
  				<span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>";

  				$html .= $this->displayInformation($completeResults, $epguides, $i);
			}

		$html .= "</div>";
		return $html; 
	}

	// Return results of rating. 
	public function displayRating($result, $i){
		$html = "<div class='list-group-item'>
				<button type='button' class='rate'>
  				<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>";

  		if($result[$i]["imdbRating"] !==  "N/A"){
			$html .= $result[$i]["imdbRating"]."</button>"; 
		}else{
			$html .= "</button>"; 
		} 
		return $html;
	}

	// Return information about title, year, plot, link to trailer and possibly information about next episode. 
	public function displayInformation($result, $epguides, $i){
		$html ="<h4>".$result[$i]["Title"]." (".$result[$i]["Year"]." )</h4>
			<img src=".$result[$i]["Poster"]. " class='pictures'>"; 

		if($result[$i]["Plot"] !==  "N/A"){
			$html .= "<p class='plot'>".$result[$i]["Plot"]."</p>"; 
		} 

		if(!empty($epguides)){
			for($j=0; $j < count($epguides); $j++){
				if($epguides[$j][0] == $result[$i]["Title"]){
					$html .= "<p class='nextEpisode'><b>Next Episode:</b> ".$epguides[$j][1].", ".$epguides[$j][2]."</p>";
				}
			}
		}

		$html .= "<p><a href='http://www.youtube.com/results?search_query=".$result[$i]["Title"]."+trailer' target='_blank'>Search for trailer on youtube</a></p>";
		$html .= "</div>";
		return $html; 
	}

	public function scripts(){
		$html = "
			<script src='lib/jquery.min.js'></script>
			<script src='lib/bootstrap/js/bootstrap.min.js'></script>
			<script src='javascript/mashup.js'></script>";
		return $html;
	}
}