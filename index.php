<?php

	$link = mysqli_connect("localhost", "root", "root", "users");
	// server name, user name for server, password for server, database name

	if ( mysqli_connect_error() ) {

		die ("There was an error connecting to the database");

	}

	$query = "INSERT INTO users (email, password) VALUES('kirsten@kirstenpercival.co.uk', 'isefju&7feU123')";

	if ( mysqli_query( $link, $query ) ) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $query . "<br>" . mysqli_error($link);
	}

	$query = "SELECT * FROM users";

	if ( $result = mysqli_query( $link, $query ) ) {

		$row = mysqli_fetch_array( $result );

		echo "Your email is ".$row['email']." and your password is ".$row['password'];

	}

?>