<?php
session_start();
//Check to ensure a valid login
if (!isset($_SESSION['username']))
{
    die("You aren't allowed to access this page");
}

?>
<html>
<head>
<link rel="stylesheet" href="LibraryStyle.css" type="text/css" />

<title>Library System </title>

</head>

<body>
<div class="Container">

	<div class="Menu">
		<h1 class="Header">Welcome to DIT Library</h1>	
	</div></br></br>
	
	<!--Main menu -->
	
	<div class="Menu">
		<fieldset class ="Menu">
			<table class="NavBar" border="0" width="100%">
				<tr>
					<td width="25%"><a href="search.php">Search</a></td>
					<td width="25"><a href="reservations.php">Reservations</a></td>
					<td width="25%"><a href="details.php">User Details</a></td>
					<td width="25%"><a href="logout.php">Logout</a></td>
				</tr>
			</table>
		</fieldset></br></br>
	
	</div>
	
	
</div>

<!-- include page footer -->
<?php require_once "footer.php"; ?>
</body>
</html>