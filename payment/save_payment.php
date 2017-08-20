<?php

$agentid = htmlspecialchars($_REQUEST['agentid']);
$paymentamount = htmlspecialchars($_REQUEST['paymentamount']);
$paymentcurrencyid = htmlspecialchars($_REQUEST['paymentcurrencyid']);
$paymentusdamount = htmlspecialchars($_REQUEST['paymentusdamount']);

require_once('../helper.php');
require_once('../mekrodb.php');
session_start();

        //get current userId 
        $userId = getUserId($_SESSION['username']);

// insert a new payment
$insertResult= DB::insert('payment', array(
  'paymentid' => 0, // auto incrementing column
  'adminid' => $userId,
  'agentid' => $agentid,
  'paymenttime' => new DateTime("now"),
  'paymentamount'=> $paymentamount,
  'paymentcurrencyid' => $paymentcurrencyid,
  'paymentusdamount' => $paymentusdamount
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