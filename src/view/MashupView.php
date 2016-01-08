<?php

class MashupView{

	public function login(){

    	$html = "
      	<nav class='navbar navbar-default navbar-fixed-top' id='navbar'>
	      	<div class='container-fluid'>
	      	 	<p id='brand'> <img src='./css/tv.png' id='tvpic' alt='tv'>Never-miss</p>
	  		</div>
      	</nav>
      	<div class='container-fluid'>
	      	<div class='row'>
				<div class='col-md-6 col-md-offset-3' id='logindiv'>
					<h1>Welcome!</h1>
					<form class='form-horizontal'>

				    	<div class='form-group'>
				    		
				    		<div class='col-sm-10'>
				      			<input type='text' class='form-control' id='username' placeholder='Username' required autofocus>
				    		</div>
				  		</div>

				  		<div class='form-group'>
				    		
				    		<div class='col-sm-10'>
				      			<input type='password' class='form-control' id='password' placeholder='Password' required>
				   			</div>
				  		</div>

				  		<div class='form-group'>
				    		<div class='col-sm-10'>
				      			<div class='checkbox'>
					        		<label>
					          			<input type='checkbox'> Remember me
					        		</label>
				      			</div>
				    		</div>
				  		</div>

				  		<div class='form-group'>
				    		<div class='col-sm-10'>
				      			<button type='submit' class='btn btn-default' id='loginbutton'>Login</button>
				    		</div>
  						</div>
					</form>
				</div>
	  		</div>
	  	</div>";
    	return $html;
	}

	public function menu(){

	}

	public function lista(){

	}

	public function search(){

	}

}