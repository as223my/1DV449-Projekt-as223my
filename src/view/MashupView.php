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

	public function searchView(){
		$html = "
    	<div class='container-fluid'>
          	<div class='row'>
				<div class='col-md-6 col-md-offset-3' id='searchdiv'>
					<h1>Search!</h1>
					<form class='form-horizontal'>
				    	<div class='form-group'>
				    		<div class='col-sm-10'>
				      			<input type='text' class='form-control' id='search' placeholder='for a movie or a tv show' required autofocus>
				    		</div>
				  		</div>
				  		<div class='form-group'>
				    		<div class='col-sm-10'>
				      			<button type='submit' class='btn btn-default' id='searchbutton'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>
				    		</div>
  						</div>
					</form>
				</div>
	  		</div>
        </div>";

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