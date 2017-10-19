<?php
// ----------------------------------------- 
//  The Web Help .com
// ----------------------------------------- 
// remember to replace your@email.com with your own email address lower in this code.

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(!empty($_POST["name"]) && !empty($_POST["subject"]) && !empty($_POST["message"]) && !empty($_POST["from"]) && !empty($_POST["verif_box"])) {

		// load the variables form address bar
		$name = $_POST["name"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];
		$from = $_POST["from"];
		$verif_box = $_POST["verif_box"];

		// remove the backslashes that normally appears when entering " or '
		$name = stripslashes($name); 
		$message = stripslashes($message); 
		$subject = stripslashes($subject); 


		if (filter_var($from, FILTER_VALIDATE_EMAIL) === false) {
		  echo "<p>your email doesn't look right, please try again</p>";
		  exit;
		}

		// check to see if verificaton code was correct
		if(md5($verif_box).'a4xn' == $_COOKIE['tntcon']){
			// if verification code was correct send the message and show this page
			mail("camfitzwilliam@gmail.com", 'My personal website '.$subject, $_SERVER['REMOTE_ADDR']."\n\n".$message, "From: $from");
			// delete the cookie so it cannot sent again by refreshing this page
			setcookie('tntcon','');
			echo "<p>Email sent :) I will get back to you shortly!</p>";
		} else if(isset($message) and $message!="") {
			echo "<div class='alert alert-danger' role='alert'><p>Wrong verification image, please try again</p></div>";
		} else {
		  echo "no variables received, this page cannot be accessed directly";
		  exit;
		}

	}
}

?>
