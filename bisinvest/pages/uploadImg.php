<?php 
require '../core/init.php';
$general->logged_out_protect();

$username 	= htmlentities($user['username']); // storing the user's username after clearning for any html tags.
$user_id  	= htmlentities($user['id']); // storing the user's username after clearning for any html tags.

$b_id = $_GET['id'];

if (isset($_POST['submit'])) {
$file_name=isset($_POST['files']);

$users->add_sme_image($user_id,$b_id,$file_name);


header('Location:sme_panel.php');
}



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data">

 <input type="file" name="files[]" id="file" multiple/>

 <input type="submit" name="submit" value="Upload" />
 </form>

</body>
</html>