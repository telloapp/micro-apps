<?php 
require '../InvestorCore/init.php';
$general->logged_out_protect();

$user_id  	= htmlentities($user['id']); // storing the user's username after clearning for any html tags
$profileID = $_GET['id'];

$viewproObj =$investors->viewBiz2($profileID);

if(isset($_POST['submit']))
{
	if ($investors->profile_exist($profileID, $user_id)=== true) {
			$errors[] = 'Sorry, you have already saved this profile. Try other business';
		}

	if (empty($errors) === true) {
	$investors->Addinvest($profileID, $user_id);
	header('Location:investings.php');
}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<label><p style="font-family:tahoma; font-size:30px; color:green;">Selected busines profile</label></p>
<hr>
<?php foreach ($viewproObj as $key) {?>
	<form action="" method="post">

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
<?php echo "<br>";?>


<input type="submit" name="submit" value="Save profile">

								<?php 
		if(empty($errors) === false){

			echo '<p>' . implode('</p><p>', $errors) . '</p>';
				


            }
            ?>

</form>
<?php }?>
<a href="viewProfiles.php">Back</a>
</body>
</html>