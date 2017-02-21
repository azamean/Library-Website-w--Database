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
		<p class="Subhead">Search by: </p>
		<form method="post" Action="search.php">
		
		<table border="0" width="100%">
			<tr>
				<td class="Item" width="30%">Book Title:</td>
				<td width="70%"><input type="text" name="title" size="40"/></td> 
			</tr>
			<tr>
				<td class="Item" width="50%"><input type="submit" name="SearchTitle" value="Search Titles"/>
			</tr>
			<tr>
				<td class="Item" width="30%">Book Author:</td>
				<td width="70%"><input type="text" name="author" size="40"/></td> 
			</tr>
			<tr>
				<td class="Item" width="50%"><input type="submit" name="SearchAuthor" value="Search Authors"/>
			</tr>
			</form>
			<form method="post" Action="search.php">
			<tr>
				<td class="Item" width="30%">Category:</td>
				<td width="70%">
				
								<?php 
									$con = mysqli_connect('localhost','root','','assignment');
									
									//Use DISTINCT to only get a category once, as many books will share the same category
									
									$result = mysqli_query($con, "SELECT DISTINCT CategoryDescription, CategoryID FROM categories");
									
									echo '<select id="Category" name="Category" >';
									
									//Use html embedded in php to display a select statement and populate 
									//the values from the result of an SQL query.
									while($row = mysqli_fetch_array($result)){										
										echo '<option value="' . $row['CategoryID'] . '" selected>' . $row['CategoryDescription'] .'</option> ';										
									}
									echo '</select></td>'; 
									mysqli_close($con);
								?>
			</tr>
			<tr>
				<td class="Item" width="50%"><input type="submit" name="SearchCategories" value="Search Categories"/>
			</tr>
			</form>
		</fieldset>
	</div>
	
	<?php

		$con = mysqli_connect('localhost','root','','assignment');

		//Set the SESSION title, so it will be passed on after re-load
		if(isset($_POST['title']))
		{
			unset($_SESSION['title']);
			$_SESSION['title'] = $_POST['title'];
		}	
		

		
		//Method to search by book title
		if(isset($_SESSION['title']) && $_SESSION['title'] != NULL)
		{
			$t = $_SESSION['title'];
			
			//Get page number, if set, if not set to 1
		if(isset($_GET['page']))
			{	
				//Get the page number passed on
				$page = $_GET["page"];
			}
		else 
			{
				//Otherwise set page to one, if no page number has been passed
				$page = 1;
			}
		
			//Calculate offset value (will increment by 5 for each page)
			$offset = (($page * 5) - 5);
			
			//SQL query to search for book title, as well as partial or incomplete using wildcard
			$result = mysqli_query($con, "SELECT * FROM books JOIN categories ON books.CategoryID = categories.CategoryID WHERE BookTitle LIKE '%".$t."%' LIMIT 5 OFFSET " . $offset . "");
			//Same query without the limit/offset to get the total row count and store in $count 
			$result2 = mysqli_query($con, "SELECT * FROM books JOIN categories ON books.CategoryID = categories.CategoryID WHERE BookTitle LIKE '%".$t."%'");
			$count = mysqli_num_rows($result2);
			
			//While loop to get next result
			while($row = mysqli_fetch_array($result))
			{
				
				echo '<table border=1><tr>';
				echo "<td> ISBN: " . $row['ISBN'] . "</td><td> Title: " . $row['BookTitle'] . "</td><td> Author: " . $row['Author'];
				echo '</td></tr></br><tr>';
				echo "<td>Edition: " . $row['Edition'] . "</td><td> Year Published: " . $row['YearPublished'] . "</td><td> Category: " . $row['CategoryDescription'] . "</td><td>Reserved? ";
				
				if($row[6] == "N")
				{
					echo '<a href="reserve.php?id='.htmlentities($row[0]).'" />Available</a> ';
				}
				if($row[6] == "Y")
				{
					echo 'Not Available';
				}
				echo '</tr></table></br>';
			
			}
			//Only display a Prev button if on page 2/3 etc, ie. don't display Prev button while on page 1
			echo '<table border=0 width="800px"><tr>';
			
			if($page >= 2)
			{
				$prev_page = $page -1;
				echo '<td width="50%"><a href="search.php?page=' . $prev_page . '">Prev</a></td>';
			}
			//Only display Next button while more results exist
			if(($page * 5) < $count)
			{
				$next_page = $page + 1;
				echo '<td width="50%"><a href="search.php?page=' . $next_page . '">Next</a></td>';
			}
			
			echo '</tr></table></br>';			
		}
		
		
		if(isset($_POST['author']) && $_POST['author'] != NULL)
		{
			$aut = $_POST['author'];
			
			$result = mysqli_query($con, "SELECT * FROM books JOIN categories ON books.CategoryID = categories.CategoryID WHERE Author LIKE '%" . $aut . "%'");
			
			while($row = mysqli_fetch_array($result)){
				
				echo '<table border=1><tr>';
				echo "<td>ISBN: " . $row['ISBN'] . "</td><td> Title: " . $row['BookTitle'] . "</td><td> Author: " . $row['Author'];
				echo '</td></tr></br><tr>';
				echo "<td>Edition: " . $row['Edition'] . "</td><td> Year Published: " . $row['YearPublished'] . "</td><td> Category: " . $row['CategoryDescription'] . "</td><td>Reserved? ";
				
				if($row[6] == "N")
				{
					echo '<a href="reserve.php?id='.htmlentities($row[0]).'" />Available</a> ';
				}
				if($row[6] == "Y")
				{
					echo 'Not Available';
				}
				echo '</tr></table></br>';
			}		
			unset($_POST['author']);
		}
		
		if(isset($_POST['Category']) && $_POST['Category'] != NULL)
		{
			unset($_SESSION['title']);
			$cat = (int)$_POST['Category'];
			
			
			$result = mysqli_query($con, "SELECT * FROM books JOIN categories ON books.CategoryID = categories.CategoryID WHERE books.CategoryID = '$cat'");
			
			while($row = mysqli_fetch_array($result)){
				
				echo '<table border=1><tr>';
				echo "<td>ISBN: " . $row['ISBN'] . "</td><td> Title: " . $row['BookTitle'] . "</td><td> Author: " . $row['Author'];
				echo '</td></tr></br><tr>';
				echo "<td>Edition: " . $row['Edition'] . "</td><td> Year Published: " . $row['YearPublished'] . "</td><td> Category: " . $row['CategoryDescription'] . "</td><td>Reserved? ";
				
				if($row['Reserved'] == "N")
				{
					echo '<a href="reserve.php?id='.htmlentities($row[0]).'" />Available</a> ';
				}
				if($row['Reserved'] == "Y")
				{
					echo 'Not Available';
				}
				echo '</tr></table></br>';
			}		
			unset($_POST['category']);
			
		}

		mysqli_close($con);


?>
	
</div>

</body>
</html>