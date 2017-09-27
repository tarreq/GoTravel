<?php

require_once('../mekrodb.php');
require_once('../helper.php');


session_start();

//get current userId 
$userId = getUserId($_SESSION['username']);



$results = DB::query("SELECT * from members where id='".$userId."'");

header('Content-Type: application/json; charset=utf-8');
//echo json_encode($results,JSON_UNESCAPED_UNICODE);

echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($results,JSON_UNESCAPED_UNICODE), ENT_NOQUOTES));



?>