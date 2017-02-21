<?php
session_start();
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
	
	
	<div class ="MainMenu">
		<fieldset class="MainMenu">
		<?php
				$con = mysqli_connect('localhost','root','','assignment');
						
				$result = mysqli_query($con, "SELECT * FROM reservations WHERE Username = '" . $_SESSION['username'] . "'");
				
				//Check if the user has any current reservations
				
				echo 'Current Reservations: ';
				
				//If user has current reservations, display them and include a link to Unreserve a book,
				//Doing so will update the appropriate tables
				
				while($row = mysqli_fetch_array($result)){
					echo '<table border=1><tr>';
					echo '<td>' . $row['ISBN'] . "</td><td>" . $row['Username'] . '</td><td>' . $row['reservedDate'] . '</td><td>' ;
					echo '<a href="unreserve.php?id='.htmlentities($row[0]).'" />Unreserve</a> </td> </tr> </table>';
				}
		
				mysqli_close($con);
		?>
		
		
		</fieldset>
	</div>
	
	
</div>

<!-- include page footer -->
<?php require_once "footer.php"; ?>

</body>
</html>