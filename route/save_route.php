<?php

$originairportid = htmlspecialchars($_REQUEST['originairportid']);
$destinationairportid = htmlspecialchars($_REQUEST['destinationairportid']);
$routeperiod = htmlspecialchars($_REQUEST['routeperiod']);


require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$insertResult= DB::insert('route', array(
  'id' => 0, // auto incrementing column
  'originairportid' => $originairportid,
  'destinationairportid' => $destinationairportid,
  'routeperiod' => $routeperiod
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