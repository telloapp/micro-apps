<?php 
require '../InvestorCore/init.php';
$general->logged_out_protect();

$user_id  	= htmlentities($user['id']); // storing the user's username after clearning for any html tags

$investorObj = $investors->investorProfiles($user_id)

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<label><p style="font-family:tahoma; font-size:30px; color:green;">Your Saved profiles</label></p>
<hr>

<?php foreach ($investorObj as $key) {?>

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


<a href="investor_panel.php">Home</a>
<?php } ?>

</body>
</html>