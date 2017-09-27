<?php
$userId = htmlspecialchars($_REQUEST['id']);
$memberfirmname = htmlspecialchars($_REQUEST['memberfirmname']);
$memberfirmaddress = htmlspecialchars($_REQUEST['memberfirmaddress']);
$email = htmlspecialchars($_REQUEST['email']);
$membercontactname = htmlspecialchars($_REQUEST['membercontactname']);
$memberphone = htmlspecialchars($_REQUEST['memberphone']);

require_once('../helper.php');
require_once('../mekrodb.php');

//session_start();
//
////get current userId 
//$userId = getUserId($_SESSION['username']);

// insert a new payment
$updateResult= DB::update('members', array(
  'memberfirmname' => $memberfirmname,
  'memberfirmaddress' => $memberfirmaddress,
  'email' => $email,
  'membercontactname' => $membercontactname,
  'memberphone' => $memberphone
 
        
), "id=%s", $userId);
 
//$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($updateResult){
	echo json_encode(array(
		'id' => $updateResult
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>