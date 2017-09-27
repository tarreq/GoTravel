<?php

$flightid = htmlspecialchars($_REQUEST['flightid']);
$flightcode = htmlspecialchars($_REQUEST['flightcode']);
$routeid = htmlspecialchars($_REQUEST['id']);
$flightdate = htmlspecialchars($_REQUEST['flightdate']);
$flighttime = htmlspecialchars($_REQUEST['flighttime']);
$firstclassprice = htmlspecialchars($_REQUEST['firstclassprice']);
$secondclassprice = htmlspecialchars($_REQUEST['secondclassprice']);
$jetid = htmlspecialchars($_REQUEST['jetid']);
$flightstatusid = htmlspecialchars($_REQUEST['flightstatusid']);

require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$updateResult= DB::update('flight', array(
  'flightcode' => $flightcode,
  'routeid' => $routeid,
  'flightdate' => $flightdate,
  'flighttime' => $flighttime,
  'firstclassprice' => $firstclassprice,
  'secondclassprice' => $secondclassprice,
  'jetid' => $jetid,
  'flightstatusid' => $flightstatusid
        
), "flightid=%s", $flightid);
 
//$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($updateResult){
	echo json_encode(array(
		'flightid' => $updateResult
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>