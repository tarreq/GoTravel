<?php

require_once('mekrodb.php');
$table = $_GET['table'];
$wh = $_GET['wh'];
$vl = $_GET['vl'];

$results = DB::query("SELECT * from ".$table." where ".$wh."='".$vl."'".";");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>