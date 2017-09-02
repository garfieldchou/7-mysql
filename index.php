<?php

    if ( array_key_exists("submit", $_POST) ) {
        
        print_r($_POST);
        
    }
    
?>

<form method="post">

    <input type="email" name="email" placeholder="Your Email">
    
    <input type="password" name="password" placeholder="Password">
    
    <input type="checkbox" name="stayLoggedIn" value=1>
    
    <input type="submit" name="submit" value="Sign Up!">
    
</form>