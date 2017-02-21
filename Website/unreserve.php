
<?php
//Script to unreserve a book, this script gets the ID passed to it from
//reservations page, then updates the book record to make it no longer reserved, and deletes 
//the reservation from the reservations table

	session_start();
	$con = mysqli_connect('localhost','root','','assignment');
	
	$id = $_GET['id'];
	
		
	mysqli_query($con, "UPDATE books SET Reserved='N' WHERE ISBN='$id'");
	mysqli_query($con, "DELETE FROM reservations WHERE ISBN = '$id'");
	
	header("Location: reservations.php");

	mysqli_close($con);
?>
