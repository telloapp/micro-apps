<?php 
require '../InvestorCore/init.php';
$general->logged_out_protect();

$viewBiz = $investors->viewBiz();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<label><p style="font-family:tahoma; font-size:30px; color:green;">Available busines profiles</label></p>
<hr>
<?php foreach ($viewBiz as $key) {?>
	

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
<a href="profileDetails.php?id=<?php echo $key['id']; ?>">Details</a>
<?php }?>

<a href="investor_panel.php">Back</a>

</body>
</html>