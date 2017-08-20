<?php

require_once('../mekrodb.php');

$results = DB::query("SELECT a.id ,CONCAT(a.airportcode,' - ',b.citynameenglish) as airport  FROM airport a 
inner join city b 
on a.cityid = b.cityid 
;");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>