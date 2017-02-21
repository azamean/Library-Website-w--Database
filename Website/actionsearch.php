
<?php
		session_start();
		$con = mysqli_connect('localhost','root','','assignment');
		
		
		if(isset($_POST['title']))
		{
			$t = $_POST['title'];
			
			$result = mysqli_query($con, "SELECT * FROM books WHERE BookTitle = '$t'");
			
			while($row = mysqli_fetch_array($result)){
				echo $row['ISBN'] . " " . $row['BookTitle'] . " " . $row['Author'] . " " . $row['Edition'] . $row['Year'] . $row['CategoryID'] . $row['Reserved'];
				echo '</br>';
			}
			
			
		}
		mysqli_close($con);

?>