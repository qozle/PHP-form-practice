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
// Ok so now this works as a comment because its inside the php tag.  gotcha.

// gonna define some variables here aright

$fNameErr = $lNameErr = $emailErr = $webSiteErr = $commentErr = $genderErr = $pWord1Err = $pWord2Err = "";
$fName = $lName = $email = $website = $comment = $gender = $pWord1 = $pWord3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// FIRST NAME
	if (empty($_POST["fName"])) {
		$fNameErr = "First name is required";
	} else {
		$fName = test_input($_POST["fName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
			$fNameErr = "Only letters and white space allowed";
		}
	}
	// LAST NAME
	if (empty($_POST["lName"])) {
		$lNameErr = "Last name is required";
	} else {
		$lName = test_input($_POST["lName"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
			$lNameErr = "Only letters and white space allowed";
		}
	}
	// EMAIL
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		// check if email address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
	}
	// WEBSITE
	if (empty($_POST["website"])) {
		$webSiteErr = "";
	} else {
		$website = test_input($_POST["website"]);
		// check if the URL syntax is valid (dashes are allowed in the URL)
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
			$webSiteErr = "Invalid URL";
		}
	}
	// COMMENT
	if (empty($_POST["comment"])) {
		$commentErr = "";
	} else {
		$comment = test_input($_POST["comment"]);
	}
	// GENDER
	if (empty($_POST["gender"])) {
		$genderErr = "Gender is required";
	} else {
		$gender = test_input($_POST["gender"]);
	}
	// PASSWORD 1
	if (empty($_POST["pWord1"])) {
		$pWord1Err = "Password is required";
	} else {
		$pWord1 = test_input($_POST["pWord1"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$pWord1)) {
			$pWord1Err = "Only letters and white space allowed";
		}
	}
	// PASSWORD 2
	if (empty($_POST["pWord2"])) {
		$pWord2Err = "Confirm Password is required";
	} else {
		$pWord2 = test_input($_POST["pWord2"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$pWord2)) {
			$pWord2Err = "Only letters and white space allowed";
		}
	}
	// CHECK THAT PASSWORDS MATCH
	if ($pWord1 != $pWord2) {
		$pWordErr = "Passwords do not match";
	}

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


	$sql = "INSERT INTO SignUp (firstname, lastname, email, website, comment, gender, password1, password2) VALUES ('$fName', '$lName', '$email', '$website', '$comment', '$gender', '$pWord1', '$pWord2');";

	if ($conn->query($sql) === TRUE) {
		$situ = "New record created successfully";
	} else {
		$situ = "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}


// Gets rid of spaces, slashes, and protects from script injection by reformating special characters	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!-- SIGN UP FORM -->
<h1>Simple Signup Form</h1>
<div class="container">
	<p style="text-align: center;color: red;"><span class="error">* = required field</span></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		<!-- FIRST NAME -->			
		First Name:	<input type="text" name="fName" placeholder="First Name" value="<?php echo $fName;?>"><span class="error">* <?php echo $fNameErr;?></span>
		<br><br>
		<!-- LAST NAME -->
		Last Name: <input type="text" name="lName" placeholder="Last Name" value="<?php echo $lName;?>"><span class="error">* <?php echo $lNameErr;?></span>
		<br><br>
		<!-- EMAIL -->
		Email: <input type="email" name="email" placeholder="Email" value="<?php echo $email;?>"><span class="error">* <?php echo $emailErr;?></span>
		<br><br>
		<!-- WEBSITE -->
		Website: <input type="text" name="website" placeholder="Website" value="<?php echo $website;?>"><span class="error"> * <?php echo $webSiteErr;?></span>
		<br><br>
		<!-- COMMENT -->
		Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
		<br><br>
		<!-- GENDER -->
		Gender:
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Female") echo "checked";?> value="female">Female
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">Male
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Other") echo "checked";?> value="Other">Other
		<span class="error">* <?php echo $genderErr;?></span>
		<br><br>
		<!-- PASSWORDS 1 & 2 -->
		<input type="text" name="pWord1" placeholder="Create password" value="<?php echo $pWord1;?>"><span class="error">* <?php echo $pWord1Err;?></span><br><span class="error">*<?php echo $pWordErr;?></span>
		<br><br>
		<input type="text" name="pWord2" placeholder="Confirm password" value="<?php echo $pWord2;?>"><span class="error">* <?php echo $pWord1Err;?></span><br></span><span class="error">*<?php echo $pWordErr;?></span>
		<br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
</div>

<!-- LOGIN SECTION -->
<div class="container">
	<h1>Login</h1>
	<form method="post" action="login.php">
		Email: <input type="text" name="loginEmail" placeholder="Email">
		<br><br>
		Password: <input type="text" name="loginPassword" placeholder="Last name">
		<br><br>
		<input type="submit" name="login" value="Login">
	</form>
</div>

<?php
echo $situ;
echo "<h2>Your Input:</h2>";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM SignUp;";
$conn->query($sql);

$conn->close();


?>

</body>
</html>