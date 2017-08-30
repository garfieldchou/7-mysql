<?php

	$link = mysqli_connect("localhost", "root", "root", "users");
	// server name, user name for server, password for server, database name

	if ( mysqli_connect_error() ) {

		die ("There was an error connecting to the database");

	}

	$query = "SELECT * FROM users";

	if ( mysqli_query( $link, $query ) ) {

		echo "Query was successful";

	}

?>