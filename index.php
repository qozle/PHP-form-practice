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

$fNameErr = $lNameErr = $emailErr = $webSiteErr = "";
$fName = $lName = $email = $website = $comment = $gender = "";

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
		$website = "";
	} else {
		$website = test_input($_POST["website"]);
		// check if the URL syntax is valid (dashes are allowed in the URL)
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
			$webSiteErr = "Invalid URL";
		}
	}
	// COMMENT
	if (empty($_POST["comment"])) {
		$comment = "";
	} else {
		$comment = test_input($_POST["comment"]);
	}
	// GENDER
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
		Gender:
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Female") echo "checked";?> value="female">Female
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">Male
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Other") echo "checked";?> value="Other">Other
		<span class="error">* <?php echo $genderErr;?></span>
		<br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
</div>

	

<?php
echo "<h2>Your Input:</h2>";
echo $fName;
echo "<br>";
echo $lName;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>