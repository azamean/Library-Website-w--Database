	<?php
		//Logout, destroy session and unset session variables, redirect to login page
		
		session_unset();
		session_destroy();
		header("Location: index.php");
	?>
