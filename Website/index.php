<html>
<head>
<link rel="stylesheet" href="LibraryStyle.css" type="text/css" />

<title>Library System </title>

</head>

<body>
<div class="Container">

	<div class="Menu">
			<fieldset class="Menu">
			
			<!-- Display login screen -->
			
			<p class="Subhead">Login to Library System</p>
			<table border="0" width="100%">
				<form method="post" Action="actionpage.php">
				<tr>
					<td width="20%"> <p class="SubSubHead">UserName: </td>
					<td width="80%"> <input type="text" name="username"></p> </td>
				</tr>
				<tr>
					<td width="20%"> <p class="SubSubHead">Password: </td>
					<td width="80%"> <input type="password" name="pWord"></p> </td>
				</tr>
				<tr>
					<td width="20%"> <input type="submit" value="Login"/> </td>
					
				</form>
				
				<!-- Redirect to register new account -->
				<form method="post" Action="registerNew.php">
				
					<td width="80%"> <input type="submit" value="Register New User"/> </td>
				
				</form>
				</table>
			</fieldset></br></br>
	</div>
	
</div>

<!-- include page footer -->
<?php require_once "footer.php"; ?>

</body>
</html>