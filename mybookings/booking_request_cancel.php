<?php

$bookingid = htmlspecialchars($_REQUEST['bookingid']);
$bookingstateid = htmlspecialchars($_REQUEST['bookingstateid']);


require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$updateResult= DB::update('booking', array(
  'bookingstateid' => $bookingstateid,
  
        
), "bookingid=%s", $bookingid);
 
//$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($updateResult){
	echo json_encode(array(
		'id' => $updateResult
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>