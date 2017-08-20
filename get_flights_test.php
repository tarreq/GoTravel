<?php

require_once('mekrodb.php');


$results = DB::query("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(a.firstclassprice,'$') as firstclassprice
, CONCAT(a.secondclassprice,'$') as secondclassprice ,
h.firstclassseats - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,h.secondclassseats -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode
FROM godb.flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid inner join jet h
on a.jetid = h.jetid inner join booking j
on a.flightid = j.flightid group by a.flightid;");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>