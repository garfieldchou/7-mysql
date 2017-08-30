<?php

	$link = mysqli_connect("localhost", "root", "root");

	if ( mysqli_connect_error() ) {

		die ("There was an error connecting to the database");

	}

	$query = "SELECT * FROM users";

?>