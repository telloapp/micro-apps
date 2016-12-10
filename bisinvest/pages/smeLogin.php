<?php
require '../core/init.php';
$general->logged_in_protect();

if (empty($_POST) === false) 
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (empty($username) === true || empty($password) === true) 
    {
		$errors[] = 'Sorry, but we need your username and password.';
	} 
    else
        if($users->user_exists($username) === false) 
        {
            $errors[] = 'Sorry that username doesn\'t exist, please sign up first';
        } 
             else 
            {
                if (strlen($password) > 18) 
                {
                    $errors[] = 'The password should be less than 18 characters, without spacing.';
                }

                $login = $users->login($username, $password);

                if ($login === false) 
                {
                    $errors[] = 'Sorry, that username or password is invalid';
                }
                else
                {
                    $_SESSION['id'] =  $login;
                    header('Location: sme_panel.php');
                    exit();
                }
            }
        } 


?>

<!DOCTYPE html>
<html>
<head>
	<title>sme login page</title>
</head>
<body>

<form method="POST" action="">
	<label>login as user</label><br><br>
	<label>Dont have account yet? <a href="smeReg.php">Sign up here</a></label><br><br>

<input type="text" name="username" placeholder = "username"><br><br>
<input type="password" name="password" placeholder = "password"><br><br>
<input type="submit" name="submit" value="Submit">
<a href="index.php">Home</a>

</form>

</body>
</html>