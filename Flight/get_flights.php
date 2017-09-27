<?php

require_once('../mekrodb.php');


$flightcode = (!empty($_GET['flightcode']) ?   $_GET['flightcode']: "");

if (!empty($_GET['flightcode']))
{
$results = DB::query("SELECT a.flightid,a.flightcode,b.id,h.jetid,e.flightstatusid,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
h.firstclassseats - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,h.secondclassseats -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid
where a.flightcode='".$flightcode.
"' group by a.flightid
");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
}

else
    
{
    $results = DB::query("SELECT a.flightid,a.flightcode,b.id,h.jetid,e.flightstatusid,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
h.firstclassseats - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,h.secondclassseats -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid
 group by a.flightid
");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
    
}


?>