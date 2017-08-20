<?php
require_once('../helper.php');
require_once('../mekrodb.php');

session_start();

//get current userId 
$bookingid = $_REQUEST['bookingid'];

$results = DB::query("SELECT * FROM bookingpassenger where bookingid ='".$bookingid."'");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);

?>