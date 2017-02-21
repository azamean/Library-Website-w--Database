<?php

		$con = mysqli_connect('localhost','root','','assignment');
	
			
		//Check to ensure a username and password have been entered
		
		if(isset($_POST['username'], $_POST['pWord']) && $_POST['username'] != NULL && $_POST['pWord'] != NULL)
		{
			$u = $_POST['username'];
			$p = $_POST['pWord'];
			
			//Check the entered username and password against the database to ensure it is a valid user
			$sql = "SELECT Username, Pword FROM users WHERE Username = '$u' AND Pword='$p'";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$active = $row['active'];
			
			$count = mysqli_num_rows($result);
			
			if($count == 1)
			{
				//Only if a user is found, start the session and save the username and password as session
				//variables which are used in other pages to ensure valid login
				session_start();
				$_SESSION["username"] = $u;
				$_SESSION["pWord"] = $p;
				header("Location: mainmenu.php?param=$u");
				
			}
			else
			{	
				//Imvalid user
				header("Location: index.php");
				echo 'Username or Password are incorrect';
			}
			
		}
		mysqli_close($con);
		

	?>