<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>NETTUTS > Sign up</title>
	<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<!-- start header div -->	
	<div id="header">
		<h2>NETTUTS > Sign up</h2>
	</div>
	<!-- end header div -->	
	
	<!-- start wrap div -->	
	<div id="wrap">
	    <!-- start PHP code -->
	    <?php
	    
	    	mysql_connect("localhost", "username", "password") or die(mysql_error()); // Connect to database server(localhost) with username and password.
			mysql_select_db("registrations") or die(mysql_error()); // Select registration database.
			
			if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['password']) && !empty($_POST['password'])){
				$username = mysql_escape_string($_POST['name']);
				$password = mysql_escape_string(md5($_POST['password']));
				
				$search = mysql_query("SELECT username, password, active FROM users WHERE username='".$username."' AND password='".$password."' AND active='1'") or die(mysql_error()); 
				$match  = mysql_num_rows($search);
				
				if($match > 0){
					$msg = 'Login Complete! Thanks';
				}else{
					$msg = 'Login Failed!<br /> Please make sure that you enter the correct details and that you have activated your account.';
				}
			}
				
	    	
	    ?>
	    <!-- stop PHP Code -->
	
		<!-- title and description -->	
		<h2>Login Form</h2>
		<p>Please enter your name and password to login</p>
		
		<?php 
			if(isset($msg)){ // Check if $msg is not empty
				echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and add a div around it with the class statusmsg
			} ?>
		
		<!-- start sign up form -->	
		<form action="" method="post">
			<label for="name">Name:</label>
			<input type="text" name="name" value="" />
			<label for="password">Password:</label>
			<input type="password" name="password" value="" />
			
			<input type="submit" class="submit_button" value="Sign up" />
		</form>
		<!-- end sign up form -->	
		
	</div>
	<!-- end wrap div -->	
</body>
</html>
