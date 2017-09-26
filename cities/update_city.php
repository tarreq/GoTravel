<?php

$cityid = htmlspecialchars($_REQUEST['cityid']);
$citynamearabic = htmlspecialchars($_REQUEST['citynamearabic']);
$citynameenglish = htmlspecialchars($_REQUEST['citynameenglish']);
$countryid = htmlspecialchars($_REQUEST['countryid']);

require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$updateResult= DB::update('city', array(
  'citynamearabic' => $citynamearabic,
  'citynameenglish' => $citynameenglish,
  'countryid' => $countryid
), "cityid=%s", $cityid);
 
//$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($updateResult){
	echo json_encode(array(
		'cityid' => $updateResult
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>