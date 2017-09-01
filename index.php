<?php

	//setcookie( 'customerID', '1234', time() + 60 * 60 * 24);

	setcookie( 'customerID', 'test', time() + 60 * 60 );

	echo $_COOKIE['customerID'];

?>