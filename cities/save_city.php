<?php

$citynamearabic = htmlspecialchars($_REQUEST['citynamearabic']);
$citynameenglish = htmlspecialchars($_REQUEST['citynameenglish']);
$countryid = htmlspecialchars($_REQUEST['countryid']);


require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$insertResult= DB::insert('city', array(
  'cityid' => 0, // auto incrementing column
  'citynamearabic' => $citynamearabic,
  'citynameenglish' => $citynameenglish,
  'countryid' => $countryid
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