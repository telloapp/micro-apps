<?php
require '../InvestorCore/init.php';
$general->logged_in_protect();

if (empty($_POST) === false) 
{
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	if (empty($email) === true || empty($password) === true) 
    {
		$errors[] = 'Sorry, but we need your username and password.';
	} 
    else
        if($investors->investor_exists($email) === false) 
        {
            $errors[] = 'Sorry that email doesn\'t exist, please sign up first';
        } 
             else 
            {
                if (strlen($password) > 18) 
                {
                    $errors[] = 'The password should be less than 18 characters, without spacing.';
                }

                $login = $investors->login($email, $password);

                if ($login === false) 
                {
                    $errors[] = 'Sorry, that email or password is invalid';
                }
                else
                {
                    $_SESSION['id'] =  $login;
                    header('Location: investor_panel.php');
                    exit();
                }
            }
        } 


?>


<!DOCTYPE html>
<html>
<head>
	<title>investor login page</title>
</head>
<body>

<form method="POST" action="">
	<label>login as investor</label><br><br>
	<label>Dont have account yet? <a href="investorReg.php">Sign up here</a></label><br><br>

<input type="text" name="email" placeholder = "email"><br><br>
<input type="password" name="password" placeholder = "password"><br><br>
<input type="submit" name="submit" value="Submit">
<a href="index.php">Home</a>

</form>

</body>
</html>