<?php

	$link = mysqli_connect("localhost", "root", "root", "users");
	// server name, user name for server, password for server, database name

	if ( mysqli_connect_error() ) {

		die ("There was an error connecting to the database");

	}

	$query = "SELECT * FROM users WHERE email LIKE '%p%'";

	if ( $result = mysqli_query( $link, $query ) ) {

		while ( $row = mysqli_fetch_array( $result ) ) {

			print_r( $row );

		}

	}

?>