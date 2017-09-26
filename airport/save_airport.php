<?php

$airportcode = htmlspecialchars($_REQUEST['airportcode']);
$airportarabicname = htmlspecialchars($_REQUEST['airportarabicname']);
$airportenglishname = htmlspecialchars($_REQUEST['airportenglishname']);
$cityid = htmlspecialchars($_REQUEST['cityid']);

require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$insertResult= DB::insert('airport', array(
  'id' => 0, // auto incrementing column
  'airportcode' => $airportcode,
  'airportarabicname' => $airportarabicname,
  'airportenglishname' => $airportenglishname,
  'cityid'=> $cityid
));
 
$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($result){
	echo json_encode(array(
		'id' => $result
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>