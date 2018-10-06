<!DOCTYPE html>
<html lang="en">
<head>
<title>Simple Signup Form</title>
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
$servername = "localhost";
$username = "qozle";
$password = "193267abc";
$dbname = "testFormDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO SignUp (firstname, lastname, email, website, comment) VALUES ("




// $sql = "CREATE TABLE SignUp (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// website VARCHAR(50),
// comment VARCHAR(256),
// gender SET('Male', 'Female', 'Other'),
// reg_date TIMESTAMP
// )";

// Check that it works
if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$conn->close();
?>

</body>
</html>