<?php 
require '../InvestorCore/init.php';
$general->logged_in_protect();

if (isset($_POST['submit'])) {

	if(empty($_POST['password']) || empty($_POST['email'])){

		$errors[] = 'You must fill in all of the fields.';

	}else
	{
	      	      
        if ($investors->investor_exists($_POST['email']) === true) 
        {
            $errors[] = 'That email already exists';
        }
        if (strlen($_POST['password']) <4)
        {
            $errors[] = 'Your password must be at least 6 characters long';
        } 
        else if (strlen($_POST['password']) >18){
            $errors[] = 'Your password cannot be more than 18 characters long';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }else if ($investors->email_exists($_POST['email']) === true) {
            $errors[] = 'That email already exists.';
        }
	}

	if(empty($errors) === true)
	{	
		$password 	= $_POST['password'];
		$email 		= htmlentities($_POST['email']);
		
		$investors->register($password, $email);
		$login = $investors->login($email, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that email or password is invalid';
		}else {
			$_SESSION['id'] =  $login;
			header('Location: investor_panel.php');
			exit();
		}
		exit();
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>investor registration page</title>
</head>
<body>

<form method="POST" action="">
	<label>Register as an investor</label><br><br>

	<label>Already have account? <a href="investorLogin.php">Login here</a></label><br><br>
<input type="text" name="email" placeholder = "e-mail"><br><br>
<input type="password" name="password" placeholder = "password"><br><br>
<input type="submit" name="submit" value="Submit">
<a href="index.php">Home</a>

</form>

</body>
</html>