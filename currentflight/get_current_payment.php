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
    
    
    $memberid = (!empty($_GET['memberid']) ?   $_GET['memberid']: "");
    $pfrom = (!empty($_GET['pfrom']) ?   $_GET['pfrom']: "");
    $pto = (!empty($_GET['pfrom']) ?   $_GET['pto']: "");
    
    $arr = array();
    $queryString = "select a.bookingid, a.memberid, b.username, a.bookingtime, a.totalfare 
from booking a inner join members b
on a.memberid = b.id";
    
    
    if ($memberid<> ""){ array_push($arr,"memberid");}
    if ($pfrom<> ""){ array_push($arr,"pfrom");}
    if ($pto<> ""){ array_push($arr,"pto");}
    
    if (count($arr)> 0){
    for ($i = 0;$i < count($arr);$i++ ){
        if ($i == 0)
        {
            //first element to be put in where clause, so add " where "
            
            //if parameter is date 
            if ($arr[$i]=="pfrom")
            {
            $queryString .= " where DATE(a.bookingtime)>='".$_GET[$arr[$i]]."'";
            }
            
            else
            {
                if ($arr[$i]=="pto")
                { $queryString .= " and DATE(a.bookingtime)<='".$_GET[$arr[$i]]."'"; }
                
                else
                {       
                    
                //not date parameter
                $queryString .= " where a.".$arr[$i]."='".$_GET[$arr[$i]]."'";
                }
            }
        }
        else
        {
            //if parameter is date 
            if ($arr[$i]=="pfrom")
            {
            $queryString .= " and DATE(a.bookingtime)>='".$_GET[$arr[$i]]."'";
            }
            
            else
            {
                if ($arr[$i]=="pto")
                { $queryString .= " and DATE(a.bookingtime)<='".$_GET[$arr[$i]]."'"; }
                
                else
                {       
                    
                //not date parameter
                $queryString .= " and a.".$arr[$i]."='".$_GET[$arr[$i]]."'";
                }
            }
        }
        
    }
    }
    
    
    
    return $queryString;
}


?>