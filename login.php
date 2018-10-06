<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Latest compiled and minified Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<!-- Our CSS -->
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>

	<body>
		<?php
		// Declare some variables
		$fName = $lName = $email = $website = $comment = $gender = $loginEmail = $loginPassword = "";

		$servername = "localhost";
		$username = "qozle";
		$password = "193267abc";
		$dbname = "testFormDB";
		$tablename = "SignUp";


		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$loginEmail = $_POST["loginEmail"];
			$loginPassword = $_POST["loginPassword"];

		}



		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT password1 FROM SignUp WHERE email = '$loginEmail';";
		$result = $conn->query($sql);

		
		// Output data (Kiiind of still don't get this...)
		while($row = $result->fetch_assoc()) {
			if ($loginPassword == $row["password1"]) {
				$sql = "SELECT firstname, lastname, email, website, comment, gender FROM SignUp WHERE email = '$loginEmail';";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
					echo "Firstname: " . $row['firstname']. "<br><br>";
					echo "Lastname: " . $row['lastname']. "<br><br>";
					echo "Email: " . $row['email']. "<br><br>";
					echo "Website: " . $row['website']. "<br><br>";
					echo "Comment: " . $row['comment']. "<br><br>";
					echo "Gender: " . $row['gender']. "<br><br>";
				}	
			} 
		}
		
		

		$conn->close();
		?>



	</body>
</html>