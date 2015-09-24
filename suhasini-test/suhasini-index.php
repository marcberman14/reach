<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Monash > Sign up</title>
	<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<!-- start header div -->	
	<div id="header">
		<h2>Monash> Sign up</h2>
	</div>
	<!-- end header div -->	
	
	<!-- start wrap div -->	
	<div id="wrap">
	    <!-- start PHP code -->
	    <?php
	    
	    	$dbh = new PDO("localhost", "reach", "Reach2015#") or die($connection); // Connect to database server(localhost) with username and password.
		    $dbh = new PDO("members") or die($connection); // Select registration database.
	    	
	    	($_POST['name']) && !empty($_POST['name']) AND ($_POST['email']) && !empty($_POST['email'])
        {
	    		$name = ($_POST['name']);
	    		$email = ($_POST['email']);


				if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
					// Return Error - Invalid Email
					$msg = 'The email you have entered is invalid, please try again.';
				}else{
					// Return Success - Valid Email
					$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
					
					$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
					$password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
 
					
					("INSERT INTO users (username, password, email, hash) VALUES(
				'". ($name) ."',
					'". (md5($password)) ."',
					'". ($email) ."',
					'". ($hash) ."') ") or die();
					
					$to      = $email; //Send email to our user
					$subject = 'Signup | Verification'; //// Give the email a subject 
					$message = '

					Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

					------------------------
					Username: '.$name.'
					Password: '.$password.'
					------------------------

					Please click this link to activate your account:
					http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'

					'; // Our message above including the link
					
					$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
					mail($to, $subject, $message, $headers); // Send the email

				}
				
	    	}
	    	
	    ?>
	    <!-- stop PHP Code -->
	
		<!-- title and description -->	
		<h2>Signup Form</h2>
		<p>Please enter your name and email addres to create your account</p>
		
		<?php 
			if(isset($msg)){ // Check if $msg is not empty
				echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and add a div around it with the class statusmsg
			} ?>
		
		<!-- start sign up form -->	
		<form action="" method="post">
			<label for="name">Name:</label>
			<input type="text" name="name" value="" />
			<label for="email">Email:</label>
			<input type="text" name="email" value="" />
			
			<input type="submit" class="submit_button" value="Sign up" />
		</form>
		<!-- end sign up form -->	
		
	</div>
	<!-- end wrap div -->	
</body>
</html>
