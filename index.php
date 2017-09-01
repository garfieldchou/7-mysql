<?php

	//setcookie( 'customerID', '1234', time() + 60 * 60 * 24);

	setcookie( 'customerID', '', time() - 60 * 60 );

	echo $_COOKIE['customerID'];

?>