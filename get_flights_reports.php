<?php

require_once('helper.php');
require_once('mekrodb.php');
session_start();

//get current userId 
$originairportid = (!empty($_GET['originairportid']) ?   $_GET['originairportid']: "");


$destinationairportid = (!empty($_GET['pto']) ?   $_GET['destinationairportid']: "");
//$agentUserId = getUserId($_POST['agentid']);


/*
 SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
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
 */


$results = DB::query(buildPaymentReportQuery(). ";");


header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


function buildPaymentReportQuery(){
    
    $originairportid = (!empty($_GET['originairportid']) ?   $_GET['originairportid']: "");
    $destinationairportid = (!empty($_GET['destinationairportid']) ?   $_GET['destinationairportid']: "");
    $ddate = (!empty($_GET['ddate']) ?   $_GET['ddate']: "");
    $rdate = (!empty($_GET['rdate']) ?   $_GET['rdate']: "");
    
    
    $arr = array();
    $queryString = "SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
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
";
    
    
    if ($originairportid<> ""){ array_push($arr,"originairportid");}
    if ($destinationairportid<> ""){ array_push($arr,"destinationairportid");}
    if ($ddate<> ""){ array_push($arr,"ddate");}
    if ($rdate<> ""){ array_push($arr,"rdate");}
    
    if (count($arr)> 0){
    for ($i = 0;$i < count($arr);$i++ ){
        if ($i == 0)
        {
            //first element to be put in where clause, so add " where "
            
            //if parameter is date 
            if ($arr[$i]=="ddate")
            {
            $queryString .= " where DATE(a.flightdate)>='".$_GET[$arr[$i]]."'";
            }
            
            else
            {
                if ($arr[$i]=="rdate")
                { $queryString .= " and DATE(a.flightdate)<='".$_GET[$arr[$i]]."'"; }
                
                else
                {       
                    
                //not date parameter
                $queryString .= " where b.".$arr[$i]."='".$_GET[$arr[$i]]."'";
                }
            }
        }
        else
        {
            
            if ($arr[$i]=="ddate")
            {
            $queryString .= " and DATE(a.flightdate)>='".$_GET[$arr[$i]]."'";
            }
            
            else
            {
                if ($arr[$i]=="rdate")
                { $queryString .= " and DATE(a.flightdate)<='".$_GET[$arr[$i]]."'"; }
                
                else
                {       
                    
                //not date parameter
                $queryString .= " and b.".$arr[$i]."='".$_GET[$arr[$i]]."'";
                }
            }
        }
        
    }
    }
    
    
    
    return $queryString." group by a.flightid";
}


?>