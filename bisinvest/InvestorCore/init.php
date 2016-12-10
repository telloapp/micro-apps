<?php 
session_start();
require 'connect/database.php';
require 'classes/investors.php';
require 'classes/general.php';
require 'classes/bcrypt.php';


// error_reporting(0);

$investors 	= new investors($db);
$general 	= new General();
$bcrypt 	= new Bcrypt(12);


$errors = array();

if ($general->logged_in() === true)  {
	$user_id 	= $_SESSION['id'];
	$user 		= $investors->userdata($user_id);
}

ob_start(); // Added to avoid a common error of 'header already sent'