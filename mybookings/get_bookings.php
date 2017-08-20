<?php
require_once('../helper.php');
require_once('../mekrodb.php');

session_start();

$bookingid = isset($_POST['bookingid']) ? mysql_real_escape_string($_POST['bookingid']) : '';
//$flightcode = isset($_POST['flightcode']) ? mysql_real_escape_string($_POST['flightcode']) : '';



//get current userId 
$userId = getUserId($_SESSION['username']);
$memberType = DB::queryOneField('membertype', "SELECT * FROM members WHERE id=%s", $userId);

if (isset($_POST['bookingid']) && $bookingid <>''){
    if ($memberType == 2){
        //user, get only his bookings
$results = DB::query("SELECT a.bookingid, a.memberid, a.bookingtime
,b.flightcode as outflight, IFNULL(c.flightcode,0) as inflight
,d.tickettypename , a.totalfare 
, IFNULL(a.firstclassseats,0) as firstclassseats , IFNULL(a.secondclassseats,0) as secondclassseats
FROM booking a
inner join flight b on a.flightid = b.flightid 
left join flight c on a.returnflightid = c.flightid
inner join tickettype d on a.tickettypeid = d.tickettypeid
where memberid ='".$userId."' and bookingid=".$bookingid);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }
    else
    {
       //admin , get all booknigs 
       $results = DB::query("SELECT a.bookingid, a.memberid, a.bookingtime
,b.flightcode as outflight, IFNULL(c.flightcode,0) as inflight
,d.tickettypename , a.totalfare 
, IFNULL(a.firstclassseats,0) as firstclassseats , IFNULL(a.secondclassseats,0) as secondclassseats
FROM booking a
inner join flight b on a.flightid = b.flightid 
left join flight c on a.returnflightid = c.flightid
inner join tickettype d on a.tickettypeid = d.tickettypeid
where bookingid=".$bookingid);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }
}

else
{
    //user, get only his bookings
    if ($memberType == 2)
    {
$results = DB::query("SELECT a.bookingid, a.memberid, a.bookingtime
,b.flightcode as outflight, IFNULL(c.flightcode,0) as inflight
,d.tickettypename , a.totalfare 
, IFNULL(a.firstclassseats,0) as firstclassseats , IFNULL(a.secondclassseats,0) as secondclassseats
FROM booking a
inner join flight b on a.flightid = b.flightid 
left join flight c on a.returnflightid = c.flightid
inner join tickettype d on a.tickettypeid = d.tickettypeid
where memberid ='".$userId."'");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }
    else 
        //admin , get all booknigs 
        {
        $results = DB::query("SELECT a.bookingid, a.memberid, a.bookingtime
,b.flightcode as outflight, IFNULL(c.flightcode,0) as inflight
,d.tickettypename , a.totalfare 
, IFNULL(a.firstclassseats,0) as firstclassseats , IFNULL(a.secondclassseats,0) as secondclassseats
FROM booking a
inner join flight b on a.flightid = b.flightid 
left join flight c on a.returnflightid = c.flightid
inner join tickettype d on a.tickettypeid = d.tickettypeid
");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
        }
}
?>