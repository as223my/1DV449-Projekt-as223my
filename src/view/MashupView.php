<?php

class MashupView{

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

	public function listView(){
		return "<p>lista</p>"; 
	}

	public function didUserPressSearch(){
		if(isset($_POST["searchForm"])){
			return array($_POST['token'], $_POST['searchinput']);
		}else{
			return null;
		}	
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

	public function displaySearchResult($completeResults, $epguides){
		$html = "
			<div class='list-group' id='resultList'>";

			for($i=0; $i < count($completeResults); $i++){
				$html .= "<div class='list-group-item'>
				<button type='button' class='rate'>
  				<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>";

  				if($completeResults[$i]["imdbRating"] !==  "N/A"){
					$html .= $completeResults[$i]["imdbRating"]."</button>"; 
				} 

  				$html .="
				<button type='button' class='btn btn-default btn-lg' id=".$completeResults[$i]["imdbID"].">
  				<span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add to list</button>
				<h4>".$completeResults[$i]["Title"]." (".$completeResults[$i]["Year"]." )</h4>
				<img src=".$completeResults[$i]["Poster"]. " class='pictures'>"; 

				if($completeResults[$i]["Plot"] !==  "N/A"){
				$html .= "<p class='plot'>".$completeResults[$i]["Plot"]."</p>"; 
				} 

				if(!empty($epguides)){
					if($epguides[0] == $i){
						$html .= "<p class='nextEpisode'><b>Next Episode:</b> ".$epguides[1].", ".$epguides[2]."</p>";
					}
				}
				$html .= "</div>";
			}

		$html .= "</div>";

		return $html; 
	}

	public function scripts(){
		$html = "
			<script src='lib/jquery.min.js'></script>
			<script src='lib/bootstrap/js/bootstrap.min.js'></script>
			<script src='javascript/checkConnectionDown.js'></script>";
		return $html;
	}
}