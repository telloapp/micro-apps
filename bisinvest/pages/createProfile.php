<?php 
require '../core/init.php';
$general->logged_out_protect();

$username 	= htmlentities($user['username']); // storing the user's username after clearning for any html tags.
$user_id  	= htmlentities($user['id']); // storing the user's username after clearning for any html tags.

if (isset($_POST['submit'])) {

$biz_name 		= htmlentities($_POST['biz_name']);
$name 			= htmlentities($_POST['name']);
$position 		= htmlentities($_POST['position']);
$experience 	= htmlentities($_POST['experience']);
$marketing 		= htmlentities($_POST['marketing']);
$sales 			= htmlentities($_POST['sales']);
$product 		= htmlentities($_POST['product']);
$total_emp 		= htmlentities($_POST['total_emp']);
$problem 		= htmlentities($_POST['problem']);
$solution 		= htmlentities($_POST['solution']);
$uniquesp 		= htmlentities($_POST['uniquesp']);
$biz_summary 	= htmlentities($_POST['biz_summary']);
$monatization 	= htmlentities($_POST['monatization']);

$users->add_sme($user_id,$biz_name,$marketing,$sales,$product,$total_emp,$problem,$solution,$uniquesp,$biz_summary,$monatization);
$users->add_sme2($user_id, $name, $position, $experience);

$file_name=isset($_POST['files']);
add_sme_image($user_id,$id,$file_name);

header('Location:sme_panel.php');

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>reate business profile</title>
</head>
<body>
<p>Add your busines profile</p><br>

<form action="" method="POST" >
	
<input type="text" name="biz_name" placeholder = "Business name"><br><br>

<fieldset>
<legend>Team</legend>
<input type="text" name="name" placeholder = "Manager name"><br><br>
<input type="text" name="position" placeholder = "Position"><br><br>
Experience :<textarea name="experience" placeholder = "Experience"></textarea> <br>
</fieldset>
<br>
Marketing : <textarea type ="text" name="marketing" placeholder ="marketing"></textarea><br><br>
Sale : <textarea type = "text" name="sales" placeholder = "e.g How much of your product have you sold"></textarea><br><br>
Product : <input type ="text" name="product" placeholder= "Product being produced"><br><br>
Total employment : <input type="text" name="total_emp" placeholder = "Total number of people employed"><br><br>
Problem : <textarea type = "text" name="problem" placeholder = "The problem you are solving"></textarea><br><br>
Solution : <textarea type = "text" name="solution" placeholder = "best possible way of solving the problem"></textarea><br><br>
USP : <textarea type = "text" name="uniquesp" placeholder = "Why your product?"></textarea><br><br>
Summary <textarea type = "text" name="biz_summary" placeholder = "your business summary"></textarea><br><br>

Monatization : <textarea type = "text" name="monatization" placeholder = "how are you planning to make money of your product"></textarea><br><br>
<input type="submit" name="submit" value="submit">
                                     
</form>

</body>
</html>