<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>

		<p>Hey sweet thanks <?php echo $_POST["firstName"] . " " . $_POST["lastName"]; ?> for submitting all that info.  Hmm, let's see here, that's right...I see here your
		email is <?php echo $_POST["email"]; ?>, is that correct? 

		<?php 

		if ($_POST["password1"] == $_POST["password2"]){
			echo "I also see here your password is" . $_POST['password1'];

		} else {
			echo "What's this?  Your passwords don't match, oh my!  Better try again.";
		}
		?></p>

	</body>
</html>