
<?php
//Script to reserve a book, this script gets the ID passed to it from
//search page, then updates the book record to make it 'reserved', and inserts 
//the reservation into the reservations table, using the ISBN and the users username

	session_start();
	$con = mysqli_connect('localhost','root','','assignment');
	
	$id = $_GET['id'];
	
	mysqli_query($con, "UPDATE books SET Reserved='Y' WHERE ISBN='$id'");
	mysqli_query($con, "INSERT INTO reservations(ISBN, Username, reservedDate) VALUES('$id', '" . $_SESSION['username'] . "', CURDATE())");
	
	header("Location: search.php");

	mysqli_close($con);
	
?>
