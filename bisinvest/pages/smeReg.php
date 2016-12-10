<?php 
require '../core/init.php';
$general->logged_in_protect();

if (isset($_POST['submit'])) {

	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])){

		$errors[] = 'You must fill in all of the fields.';

	}else
	{
	      	      
        if ($users->user_exists($_POST['username']) === true) 
        {
            $errors[] = 'That username already exists';
        }
        if (strlen($_POST['password']) <6)
        {
            $errors[] = 'Your password must be at least 6 characters long';
        } 
        else if (strlen($_POST['password']) >18){
            $errors[] = 'Your password cannot be more than 18 characters long';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }else if ($users->email_exists($_POST['email']) === true) {
            $errors[] = 'That email already exists.';
        }
	}

	if(empty($errors) === true)
	{
			
		$username 	= htmlentities($_POST['username']);
		$password 	= $_POST['password'];
		$email 		= htmlentities($_POST['email']);
		
		
		$users->register($username, $password, $email);
		$login = $users->login($username, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that username or password is invalid';
		}else {
			$_SESSION['id'] =  $login;
			header('Location: sme_panel.php');
			exit();
		}
		exit();
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>sme registration page</title>
</head>
<body>

<form method="POST" action="">
	<label>Register as a user</label><br><br>

	<label>Already have account? <a href="smeLogin.php">Login here</a></label><br><br>
<input type="text" name="email" placeholder = "e-mail" required = "required"><br><br>
<input type="text" name="username" placeholder = "username" required = "required"><br><br>
<input type="password" name="password" placeholder = "password" required = "required"><br><br>
<input type="submit" name="submit" value="Submit">
<a href="index.php">Home</a>



</form>
</body>
</html>