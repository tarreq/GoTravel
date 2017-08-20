<?php

require_once('../helper.php');
require_once('../mekrodb.php');
session_start();

//get current userId 
$adminid = (!empty($_GET['adminid']) ?   $_GET['adminid']: "");


$agentid = (!empty($_GET['agentid']) ?   $_GET['agentid']: "");
//$agentUserId = getUserId($_POST['agentid']);




//$results = DB::query("SELECT a.paymentid, a.adminid,b.username as adminuser,c.username as agentuser,
//a.agentid, a.paymenttime,a.paymentamount,
//a.paymentcurrencyid, a.paymentusdamount
//FROM payment a 
//inner join members b on a.adminid = b.id
//inner join members c on a.agentid = c.id
//where a.adminid ='".$adminUserId."' and a.agentid='".$agentUserId. "';");



$results = DB::query(buildPaymentReportQuery(). ";");


header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


function buildPaymentReportQuery(){
    
    $adminid = (!empty($_GET['adminid']) ?   $_GET['adminid']: "");
    $agentid = (!empty($_GET['agentid']) ?   $_GET['agentid']: "");
    $pfrom = (!empty($_GET['pfrom']) ?   $_GET['pfrom']: "");
    $pto = (!empty($_GET['pfrom']) ?   $_GET['pto']: "");
    
    $arr = array();
    $queryString = "SELECT a.paymentid, a.adminid,b.username as adminuser,c.username as agentuser,
a.agentid, a.paymenttime,a.paymentamount,
a.paymentcurrencyid, a.paymentusdamount
FROM payment a 
inner join members b on a.adminid = b.id
inner join members c on a.agentid = c.id
";
    
    if ($adminid<> ""){ array_push($arr,"adminid");}
    if ($agentid<> ""){ array_push($arr,"agentid");}
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
            $queryString .= " where DATE(a.paymenttime)>='".$_GET[$arr[$i]]."'";
            }
            
            else
            {
                if ($arr[$i]=="pto")
                { $queryString .= " and DATE(a.paymenttime)<='".$_GET[$arr[$i]]."'"; }
                
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
            $queryString .= " and DATE(a.paymenttime)>='".$_GET[$arr[$i]]."'";
            }
            
            else
            {
                if ($arr[$i]=="pto")
                { $queryString .= " and DATE(a.paymenttime)<='".$_GET[$arr[$i]]."'"; }
                
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