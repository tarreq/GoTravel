<?php

$flightcode = htmlspecialchars($_REQUEST['flightcode']);
$id = htmlspecialchars($_REQUEST['id']);
$flightdate = htmlspecialchars($_REQUEST['flightdate']);
$flighttime = htmlspecialchars($_REQUEST['flighttime']);
$firstclassprice = htmlspecialchars($_REQUEST['firstclassprice']);
$secondclassprice = htmlspecialchars($_REQUEST['secondclassprice']);
$jetid = htmlspecialchars($_REQUEST['jetid']);
$flightstatusid = htmlspecialchars($_REQUEST['flightstatusid']);



require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$insertResult= DB::insert('flight', array(
  'flightid' => 0, // auto incrementing column
  'flightcode' => $flightcode,
  'routeid' => $id,
  'flightdate' => $flightdate,
  'flighttime' => $flighttime, // auto incrementing column
  'firstclassprice' => $firstclassprice,
  'secondclassprice' => $secondclassprice,
  'jetid' => $jetid,
  'flightstatusid' => $flightstatusid
    
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