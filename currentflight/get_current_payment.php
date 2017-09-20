<?php

require_once('../helper.php');
require_once('../mekrodb.php');
session_start();


$memberid = (!empty($_GET['memberid']) ?   $_GET['memberid']: "");
//$agentUserId = getUserId($_POST['agentid']);


$results = DB::query(buildPaymentReportQuery(). ";");



header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


function buildPaymentReportQuery(){
    
    $currentFlightId = getCurrentFlightId();
    $memberid = (!empty($_GET['memberid']) ?   $_GET['memberid']: "");
    
    $arr = array();
    $queryString = "select a.bookingid, a.memberid, b.username, a.bookingtime, a.totalfare 
                    from booking a inner join members b
                    on a.memberid = b.id where a.flightid=".$currentFlightId;
    
    
    if ($memberid<> ""){ array_push($arr,"memberid");}
    
    
    if (count($arr)> 0){
    for ($i = 0;$i < count($arr);$i++ ){
       $queryString .= " and a.".$arr[$i]."='".$_GET[$arr[$i]]."'";
    }
    }
    
    
    
    return $queryString;
}


?>