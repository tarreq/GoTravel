<?php

require_once('mekrodb.php');

$table1 = $_GET['table1'];
$table2 = $_GET['table2'];
$fk = $_GET['fk'];
$pk = $_GET['pk'];

$results = DB::query("SELECT * FROM ".$table1." inner join ".$table2." on ".$table1.".".$fk." = ".$table2.".".$pk);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>