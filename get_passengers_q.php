<?php

require_once('mekrodb.php');



$results = DB::query("SELECT * from bookingpassenger;");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);



?>