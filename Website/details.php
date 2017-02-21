<?php
//While not a requirement in the spec, I thought it would be useful
//to add a way for the users to update their details

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
	
	<div class="MainMenu">
		<fieldset class="MainMenu">
			<?php
				$con = mysqli_connect('localhost','root','','assignment');
				
				$u = $_SESSION['username'];
				$p = $_SESSION['pWord'];		
		
				$result = mysqli_query($con, "SELECT * FROM users WHERE Username = '$u' AND Pword='$p'");
		
				while($row = mysqli_fetch_array($result)){
					echo "<b>Username: </b>" . $row['Username'] . " <b>Password: </b>" . $row['Pword'];
					echo '</br>';
					echo "<b>First Name: </b>" . $row['FirstName'] . " <b>Surname: </b>" . $row['Surname'];
					echo '</br>';
					echo "<b>Address Line 1: </b>" . $row['AddressLine1'];
					echo '</br>';
					echo "<b>Address Line 2: </b>" . $row['AddressLine2'];
					echo '</br>';
					echo "<b>City: </b>" . $row['City'];
					echo '</br>';
					echo "<b>Phone Number</b>"; 
					echo '</br>';
					echo "<b>Home: </b>" . $row['Telephone'] . " <b>Mobile: </b>" . $row['Mobile'];
					echo '</br>';
				}
				
				mysqli_close($con);
			?>
			
			<form method="post" Action="details.php">
				<p class="Subhead">Enter New Details</p>
				<table border="0" width="100%">
					<tr>
						<td class="Item" width="30%">Username:</td>
						<td width="70%"><input type="text" name="username" size="25"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Password:</td>
						<td width="70%"><input type="password" name="pWord" size="25"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">First Name:</td>
						<td width="70%"><input type="text" name="firstname" size="30"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Surname:</td>
						<td width="70%"><input type="text" name="surname" size="30"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Address Line 1:</td>
						<td width="70%"><input type="text" name="addressline1" size="50"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Address Line 2:</td>
						<td width="70%"><input type="text" name="addressline2" size="50"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">City:</td>
						<td width="70%"><input type="text" name="city" size="50"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Home phone:</td>
						<td width="70%"><input type="text" name="homephone" size="20"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Mobile phone:</td>
						<td width="70%"><input type="text" name="mobilephone" size="20"/></td> 
					</tr>
					
					<tr>
						<td class="Item" width="50%"><input type="submit" name="newdetails" value="Enter New Details"/>
					</tr>
			</table>
			</form>
			
		</fieldset>
	</div>
	
</div>
<?php
			if(isset($_POST['newdetails']))
			{
				
				$con = mysqli_connect('localhost','root','','assignment');
				$user = $_POST['username'];
				$pass = $_POST['pWord'];
				$first = $_POST['FirstName'];
				$sur = $_POST['surname'];
				$add1 = $_POST['addressline1'];
				$add2 = $_POST['addressline2'];
				$cit = $_POST['city'];
				$tel = $_POST['homephone'];
				$mob = $_POST['mobilephone'];
				
				
				mysqli_query($con, "UPDATE users SET Username='" . $user . "', Pword='" . $pass . "', FirstName='" . $first . "', Surname='" . $sur . "', AddressLine1='" . $add1 . "', 
						AddressLine2='" . $add2 . "', City='" . $cit . "', Telephone='" . $tel . "', Mobile='" . $mob . "' WHERE Username='" . $_SESSION["username"] . "'");
				
				
				
				mysqli_close($con);
			}
?>

<!-- include page footer -->
<?php require_once "footer.php"; ?>
</body>
</html>