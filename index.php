<?php

	$link = mysqli_connect("localhost", "root", "root", "users");
	// server name, user name for server, password for server, database name

	if ( mysqli_connect_error() ) {

		die ("There was an error connecting to the database");

	}

	$query = "SELECT * FROM users";

	if ( $result = mysqli_query( $link, $query ) ) {

		$row = mysqli_fetch_array( $result );

		echo "Your email is ".$row['email']." and your password is ".$row['password'];

	}

?>