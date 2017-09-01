<?php

	$link = mysqli_connect("localhost", "root", "root", "users");
	// server name, user name for server, password for server, database name

	if ( mysqli_connect_error() ) {

		die ("There was an error connecting to the database");

	}

	$name = "Rob O'Grady";

	$query = "SELECT email FROM users WHERE name = '".mysqli_real_escape_string( $link, $name)."'";

	if ( $result = mysqli_query( $link, $query ) ) {

		while ( $row = mysqli_fetch_array( $result ) ) {

			print_r( $row );

		}

	}

?>