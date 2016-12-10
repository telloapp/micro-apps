<?php 
require '../core/init.php';
$general->logged_out_protect();


$user_id  	= htmlentities($user['id']); // storing the user's username after clearning for any html tags.


$dispObj = $users->dispBiz($user_id);
$dispObj2 = $users->dispBiz2($user_id);

?>



<!DOCTYPE html>
<html>
<head>
	<title>User panel</title>
</head>
<body>
<label><p style="font-family:tahoma; font-size:30px; color:green;">Welcome to your panel</label></p>
<hr>
<a href="createProfile.php">Create business profile</a><br><br>
<hr>
<?php foreach ($dispObj2 as $key) {?>

<?php echo "Team name : ";?><?php echo $key['name'];?>
<?php echo "<br>";?>
<?php echo "Position : ";?><?php echo $key['position'];?>
<?php echo "<br>";?>
<?php echo "Experience : ";?><?php echo $key['experience'];?>
<?php echo "<br>";?>

<?php foreach ($dispObj as $key) {?>

<?php echo "Business name : ";?><?php echo $key['biz_name'];?>
<?php echo "<br>";?>
<?php echo "Marketing : ";?><?php echo $key['marketing'];?>
<?php echo "<br>";?>
<?php echo "Sales : ";?><?php echo $key['sales'];?>
<?php echo "<br>";?>
<?php echo "Product: ";?><?php echo $key['product'];?>
<?php echo "<br>";?>
<?php echo "Number of employees : ";?><?php echo $key['total_emp'];?>
<?php echo "<br>";?>
<?php echo "Problem : ";?><?php echo $key['problem'];?>
<?php echo "<br>";?>
<?php echo "Solution : ";?><?php echo $key['solution'];?>
<?php echo "<br>";?>
<?php echo "Unique selling proposition : ";?><?php echo $key['uniquesp'];?>
<?php echo "<br>";?>
<?php echo "Plan to make money : ";?><?php echo $key['monatization'];?>
<?php echo "<br>";?>
<a href="delete_profile.php?id=<?php echo $key['id']; ?>" onclick='return confirm("Remove profile?")'><i class="fa fa-trash"></i> Delete</a>
<a href="uploadImg.php?id=<?php echo $key['id']; ?>">Upload image</a><br>

<hr>

<?php }?>
<?php }?>


<br><a href="logout.php">Logout</a>


</body>
</html>