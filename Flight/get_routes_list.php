<?php

require_once('../mekrodb.php');



$results = DB::query("SELECT a.id as id, CONCAT(b.airportcode, ' --> ',c.airportcode ) as routedesc
FROM route a 
inner join airport b on a.originairportid = b.id
inner join airport c on a.destinationairportid = c.id
");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);



?>