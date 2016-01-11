<?php

class MashupView{

	public function loginNavbar(){
		$html ="
			<nav class='navbar navbar-inverse navbar-fixed-top'>
      		<div class='container'>
        		<div class='navbar-header'>
          			<p id='brand'> <img src='css/tv.png' id='tvpic' alt='tv'>Never-miss</p>
        		</div>
      		</div>
    	</nav>";

    	return $html;
	}

	public function Navbar(){
		$html = "
      	<nav class='navbar navbar-inverse navbar-fixed-top'>
      		<div class='container'>
        		<div class='navbar-header'>
          			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar'>
            			<span class='icon-bar'></span>
           				<span class='icon-bar'></span>
             			<span class='icon-bar'></span>
          			</button>
          			<p id='brand'> <img src='css/tv.png' id='tvpic' alt='tv'>Never-miss</p>
        		</div>
        		<div id='navbar' class='collapse navbar-collapse'>
          			<ul class='nav navbar-nav'>
            			<li><a href='#search' id='navlink1'>Search</a></li>
            			<li><a href='#list' id='navlink2'>Your list</a></li>
            			<li><a href='#lougout' id='navlink3'>Logout</a></li>
          			</ul>
        		</div>
      		</div>
    	</nav>"; 

    	return $html;
	}

	public function loginForm(){

    	$html = "
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
        </div>

        <script src='lib/jquery.min.js'></script>
		<script src='lib/bootstrap/js/bootstrap.min.js'></script>
		<script src='javascript/checkConnectionDown.js'></script>
        <script src='upup.min.js'></script>
		  	<script>
			    UpUp.start({
			      'content-url': 'offline/login.html',
			      'assets': ['css/favicon.ico',
					'lib/bootstrap/css/bootstrap.min.css',
					'css/style.css',
					'css/tv.png',
					'lib/jquery.min.js',
					'javascript/checkConnectionUp.js']
			    });
		 	</script>";

    	return $html;
	}
}