<?php

	setcookie( 'customerID', '1234', time() + 60 * 60 * 24);

	echo $_COOKIE['customerID'];

?>