<html>
<head>
<link rel="stylesheet" href="LibraryStyle.css" type="text/css" />

<title>Library System </title>

</head>

<body>
<div class="Container">
	<div class="MainMenu">
		<fieldset class="MainMenu">
			<form method="post" Action="registerNew.php">
			
				<p class="Subhead">Enter New User Details</p>
				<table border="0" width="100%">
					<tr>
						<td class="Item" width="30%">Enter a Username: *Required</td>
						<td width="70%"><input type="text" name="newusername" size="25"/></td>
					</tr>
					<tr>
						<td class="Item" width="30%">Enter a Password: *Required</td>
						<td width="70%"><input type="password" name="newpWord" size="25"/></td>
					</tr>
					<tr>
						<td class="Item" width="30%">Enter your First Name:</td>
						<td width="70%"><input type="text" name="newfirstname" size="30"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Enter your Surname:</td>
						<td width="70%"><input type="text" name="newsurname" size="30"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Enter you Address Line 1:</td>
						<td width="70%"><input type="text" name="newaddressline1" size="50"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Enter your Address Line 2:</td>
						<td width="70%"><input type="text" name="newaddressline2" size="50"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Enter your City:</td>
						<td width="70%"><input type="text" name="newcity" size="50"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Enter your Home phone:</td>
						<td width="70%"><input type="text" name="newhomephone" size="20"/></td> 
					</tr>
					<tr>
						<td class="Item" width="30%">Enter your Mobile phone:</td>
						<td width="70%"><input type="text" name="newmobilephone" size="20"/></td> 
					</tr>
					
					<tr>
						<td class="Item" width="50%"><input type="submit" name="newuser" value="Create New User"/>
					</tr>
			</table>
			</form>
			
		</fieldset>
	</div>

<?php

		$con = mysqli_connect('localhost','root','','assignment');
		
		//Check if username and password are set, and if they are not null, 
		//Only a username and password are reqired to register a new account.
		
		if(isset($_POST['newusername'],$_POST['newpWord']) && $_POST['newusername'] != NULL && $_POST['newpWord'] != NULL)
		{
			//Check if phone numbers are 10 characters, and of numeric type only
			
			if((strlen($_POST['newhomephone'])> 9 && is_numeric($_POST['newhomephone'])) && strlen($_POST['newmobilephone'])> 9 && is_numeric($_POST['newmobilephone']) )
			{
				//Insert user data into users table
				
				mysqli_query($con, "INSERT INTO users(Username, Pword, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
					VALUES('" . $_POST['newusername'] . "', '" . $_POST['newpWord'] . "', '" . $_POST['newfirstname'] . "', 
					'" . $_POST['newsurname'] . "', '" . $_POST['newaddressline1'] . "', '" . $_POST['newaddressline2'] . "', 
					'" . $_POST['newcity'] . "', '" . $_POST['newhomephone'] . "', '" . $_POST['newmobilephone'] . "') ");
				
				//Redirect to the login page, where the ser can now login useing their new details
				header("Location: index.php");
			}
			else
			{	
				//Display message to tell user why registration has failed
				die("Phone numbers must be at least 10 digits and only numeric");
			}
				
		}
		
		
		
		mysqli_close($con);		
	
?>


</div>

<!-- include page footer -->
<?php require_once "footer.php"; ?>

</body>
</html>