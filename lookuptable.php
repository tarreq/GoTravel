<?php

require_once('mekrodb.php');
$table = $_GET['table'];
$results = DB::query("SELECT * from ".$table.";");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>