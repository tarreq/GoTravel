<?php
require_once('../helper.php');
require_once('../mekrodb.php');
session_start();

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 30;
	$offset = ($page-1)*$rows;
	$result = array();
        
        //get current userId 
        $userId = getUserId($_SESSION['username']);

	include 'conn.php';
	
	$rs = mysql_query("select count(*) from booking where memberid='"+$userId+"'");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
        
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET CHARACTER SET utf8");
        mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
        
	$rs = mysql_query("SELECT a.bookingid, a.memberid, a.bookingtime
,b.flightcode as outflight, IFNULL(c.flightcode,0) as inflight
,d.tickettypename , a.totalfare 
, IFNULL(a.firstclassseats,0) as firstclassseats , IFNULL(a.secondclassseats,0) as secondclassseats
FROM booking a
inner join flight b on a.flightid = b.flightid 
left join flight c on a.returnflightid = c.flightid
inner join tickettype d on a.tickettypeid = d.tickettypeid
where memberid ="+$userId +" limit $offset,$rows");

$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
        
        
        header('Content-Type: application/json; charset=utf-8');
	echo json_encode($result,JSON_UNESCAPED_UNICODE);

?>