<?php

require_once('mekrodb.php');

//$dfrom = isset($_POST['dfrom']) ? mysql_real_escape_string($_POST['dfrom']) : '';
//$dto   = isset($_POST['dto']) ? mysql_real_escape_string($_POST['dto']) : '';

//$dfrom = isset($_GET['dfrom']) ? mysql_real_escape_string($_GET['dfrom']) : '';
//$dto   = isset($_GET['dto']) ? mysql_real_escape_string($_GET['dto']) : '';




$tripx = $_GET['tripx'];

//start convert date provided by input to Mysql format - from 2017/04/01 to 2017-04-01
$parts1 = explode('/',$dfrom);
$newdfrom = $parts1[2] . '-' . $parts1[0] . '-' . $parts1[1];
        
$parts2 = explode('/',$dto);
$newdto = $parts2[2] . '-' . $parts2[0] . '-' . $parts2[1];



//$newdfrom = date("Y-m-d", strtotime($dfrom));
//$newdto = date("Y-m-d", strtotime($dto));

if ($tripx == 1){
    $dfrom = $_GET['dfrom'];
$dto = $_GET['dto'];
$airo = $_GET['airo'];
$aird = $_GET['aird'];
$results = DB::query("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
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
on a.flightid = j.flightid or a.flightid = j.returnflightid"
." where a.flightdate between '".$newdfrom."' and '".$newdto."'" 
." and b.originairportid=".$airo." and b.destinationairportid=".$aird
." group by a.flightid
;");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
}
else
{   
  
   $dfrom = $_GET['dfrom'];
$dto = $_GET['dto'];
$airo = $_GET['airo'];
$aird = $_GET['aird'];  
 $rfrom = $_GET['rfrom'];
$rto = $_GET['rto'];
    
 $parts3 = explode('/',$rfrom);
$newrfrom = $parts3[2] . '-' . $parts3[0] . '-' . $parts3[1];
        
$parts4 = explode('/',$rto);
$newrto = $parts4[2] . '-' . $parts4[0] . '-' . $parts4[1];

    $results = DB::query("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
IFNULL(h.firstclassseats,0) - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,IFNULL(h.secondclassseats,0) -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid"
." where a.flightdate between '".$newdfrom."' and '".$newdto."'" 
." and b.originairportid=".$airo." and b.destinationairportid=".$aird
." group by a.flightid
union 
SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
IFNULL(h.firstclassseats,0) - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,IFNULL(h.secondclassseats,0) -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid"
." where a.flightdate between '".$newrfrom."' and '".$newrto."'" 
." and b.originairportid=".$aird." and b.destinationairportid=".$airo
." group by a.flightid
;");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);

}

?>