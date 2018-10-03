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

	$fNameErr = $lNameErr = $emailErr = "";
	$fName = $lName = $email = $password1 = $password2 = $gender = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["fName"])) {
	    $nameErr = "Name is required";
	  } else {
	    $name = test_input($_POST["fName"]);
	    // check if name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
	      $nameErr = "Only letters and white space allowed"; 
	    }
	  }

	if (empty($_POST["lName"])) {
	$nameErr = "Name is required";
	} else {
	$name = test_input($_POST["lName"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
	  $nameErr = "Only letters and white space allowed"; 
		}
	}

	if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
  	if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
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
		<p><span class="error">* = required field</span></p>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
			<span class="error">
				<input type="text"  name="firstName" placeholder="First Name" value="<?php echo $fName;?>">
			* <?php echo $nameErr;?>
			</span>
			<input type="text" name="lastName" placeholder="Last Name">
			<input type="email" name="email" placeholder="Email">
			<input type="password" name="password1" placeholder="Password">
			<input type="password" name="password2" placeholder="Confirm Password">


			<input type="radio" id="male" name="gender"><label for="male">Male</label>
			<input type="radio" id="female" name="gender"><label for="female">Female</label>
			<input type="radio" id="other" name="gender"><label for="other">Other</label>


			<input type="submit" name="submit">
		</form>
	</div>

	<!-- LOGIN FORM -->
	<h1>Login</h1>
	<div class="container">
		<form action="loggedin.php" method="post">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">

			<input type="submit" value="Login" name="login">
		</form>
	</div>

</body>
</html>