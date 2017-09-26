<?php

$id = htmlspecialchars($_REQUEST['id']);
$originairportid = htmlspecialchars($_REQUEST['originairportid']);
$destinationairportid = htmlspecialchars($_REQUEST['destinationairportid']);
$routeperiod = htmlspecialchars($_REQUEST['routeperiod']);

require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$updateResult= DB::update('route', array(
  'originairportid' => $originairportid,
  'destinationairportid' => $destinationairportid,
  'routeperiod' => $routeperiod
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