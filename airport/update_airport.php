<?php

$id = htmlspecialchars($_REQUEST['id']);
$airportcode = htmlspecialchars($_REQUEST['airportcode']);
$airportarabicname = htmlspecialchars($_REQUEST['airportarabicname']);
$airportenglishname = htmlspecialchars($_REQUEST['airportenglishname']);
$cityid = htmlspecialchars($_REQUEST['cityid']);

require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$updateResult= DB::update('airport', array(
  'airportcode' => $airportcode,
  'airportarabicname' => $airportarabicname,
  'airportenglishname' => $airportenglishname,
  'cityid'=> $cityid
), "id=%s", $id);
 
//$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($updateResult){
	echo json_encode(array(
		'id' => $updateResult
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>