<?php

require_once('../mekrodb.php');


$results = DB::query("SELECT a.id,a.originairportid ,a.destinationairportid,
CONCAT(b.airportcode,' - ',d.citynameenglish) as origincode,
CONCAT(c.airportcode,' - ',e.citynameenglish) as destinationcode , a.routeperiod
FROM route a 
inner join airport b on a.originairportid=b.id
inner join city d on b.cityid = d.cityid
inner join airport c on a.destinationairportid = c.id
inner join city e on c.cityid = e.cityid
;");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>