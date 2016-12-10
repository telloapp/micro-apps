<?php 
error_reporting(E_ALL);

require '../core/init.php';
$general->logged_out_protect();

$username   = htmlentities($user['username']); // storing the user's username after clearning for any html tags.
$user_id  	= htmlentities($user['id']); // storing the user's username after clearning for any html tags.

$profileId = $_GET['id'];

$deletePro = "";
$deletePro = $users->deleteProfile($profileId);

$users->deleteProfile2($profileId);
header('Location:sme_panel.php');

?>