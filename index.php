<?php

	session_start();

    $error = "";

    if ( array_key_exists("logout", $_GET) ) {

    	unset($_SESSION);
    	setcookie("id", "", time() - 60*60);
    	$_COOKIE["id"] = "";

    } else if ( (array_key_exists("id", $_SESSION) AND $_SESSION['id'] ) OR ( array_key_exists("id", $_COOKIE) AND $_COOKIE['id'] ) ) {

    	header("Location: loggedinpage.php");
    	
    }

    if ( array_key_exists("submit", $_POST) ) {
        
        $link = mysqli_connect('localhost', 'root', 'root', 'secretdi');
        
        if (mysqli_connect_error()) {
            
            die("Database connection error");
            
        }
        
        if ( !$_POST['email'] ) {
            
            $error .= "An email address is required</br>";
            
        }
        
        if ( !$_POST['password'] ) {
            
            $error .= "A password is required</br>";
            
        }

        if ( $error != "") {
            
            $error = "<p>There were error(s) in your form</p>".$error;
        
        } else {

        	if ( $_POST['signUp'] == '1' ) {
            
	            $query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
	            
	            $result = mysqli_query($link, $query);
	            
	            if ( mysqli_num_rows($result) > 0 ) {
	                
	                $error = "That email address is taken.";
	                
	            } else {
	                
	                $query = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
	                
	                if (!mysqli_query($link, $query)) {
	                    
	                    $error = "<p>Could not sign you up - please try again later.</p>";
	                    
	                } else {
	                    
	                    $query = "UPDATE users SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
	                    
	                    mysqli_query($link, $query);

	                    $_SESSION['id'] = mysqli_insert_id($link);

	                    if ( $_POST['stayLoggedIn'] == '1' ) {

	                    	setcookie( "id", mysqli_insert_id($link), time()+60*60*24*365);
	                    	
	                    }
	                    
	                    header("Location: loggedinpage.php");
	                    
	                }
	            
	            }

        	} else {

        		$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

        		$result = mysqli_query( $link, $query );

        		$row = mysqli_fetch_array( $result );

        		if ( isset( $row ) ) {

        			$hashedPassword = md5(md5($row['id']).$_POST['password']);

        			if ( $hashedPassword == $row['password'] ) {

        				$_SESSION['id'] = $row['id'];

	                    if ( $_POST['stayLoggedIn'] == '1' ) {

	                    	setcookie( "id", mysqli_insert_id($link), time()+60*60*24*365);
	                    	
	                    }
	                    
	                    header("Location: loggedinpage.php");        				

        			} else {

        				$error = "That email/password combination could not be found.";
        			}

        		} else {

        			$error = "That email/password combination could not be found.";

        		}

        	}
            
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <style type="text/css">

	    .container {
	    	text-align: center;
	    	width: 400px;
	    	margin-top: 150px;
	    }

	    html {
	    	background: url(background.jpg) no-repeat center center fixed; 
	    	-webkit-background-size: cover;
	    	-moz-background-size: cover;
	    	-o-background-size: cover;
	    	background-size: cover;
	    }

	    body {
	    	background: none;
	    }

	    #logInForm {
	    	display: none;
	    }

    </style>
  </head>
  <body>

  	<div class="container">

    	<h1>Secret Diary</h1>

		<div id="error"><?php echo $error; ?></div>

		<form method="post" id="signUpForm">

			<div class="form-group">
		    	<input type="email" class="form-control" name="email" placeholder="Your Email">
		    </div>
		    <div class="form-group">
		    	<input type="password" class="form-control" name="password" placeholder="Password">
		    </div>
			<div class="form-check">
    			<label class="form-check-label">
    				<input type="checkbox" class="form-check-input" name="stayLoggedIn" value=1> Stay logged in
				</label>
		    </div>
		    <div class="form-group">
		    	<input type="hidden" name="signUp" value="1">
		    	<input type="submit" class="btn btn-success" name="submit" value="Sign Up!">
		    </div>
		    
		</form>

		<form method="post" id="logInForm">

		    <div class="form-group">
		    	<input type="email" class="form-control" name="email" placeholder="Your Email">
		    </div>
		    <div class="form-group">		    
		    	<input type="password" class="form-control" name="password" placeholder="Password">
		    </div>
			<div class="form-check">
    			<label class="form-check-label">		    
		    		<input type="checkbox" class="form-check-input" name="stayLoggedIn" value=1> Stay logged in
		    	</label>
		    	<input type="hidden" name="signUp" value="0">    
		    </div>
		    <div class="form-group">		    
		    	<input type="submit" class="btn btn-success" name="submit" value="Log In!">
		    </div>
		    
		</form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>

