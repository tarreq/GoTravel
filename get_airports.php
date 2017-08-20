<?php

require_once('mekrodb.php');
$results = DB::query("SELECT * FROM airport  inner join city  on airport.cityid = city.cityid ;");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>