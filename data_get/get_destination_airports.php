<?php

require_once('../mekrodb.php');

$origin = $_GET['origin'];
$results = DB::query("SELECT distinct a.id ,CONCAT(a.airportcode,' - ',b.citynameenglish) as airport  FROM airport a 
inner join city b on a.cityid = b.cityid 
inner join route c on a.id = c.destinationairportid 
inner join flight d on c.id = d.routeid
where c.originairportid=%i",$origin);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>