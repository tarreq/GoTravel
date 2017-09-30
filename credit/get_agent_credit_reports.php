<?php

require_once('../helper.php');
require_once('../mekrodb.php');

session_start();

//get current userId 

//$memberType = DB::queryOneField('membertype', "SELECT * FROM members WHERE id=%s", $userId);

$results = DB::query(buildPaymentReportQuery(). ";");


header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


function buildPaymentReportQuery(){
    
    $userId = getUserId($_SESSION['username']);
    
    $pfrom = (!empty($_GET['pfrom']) ?   $_GET['pfrom']: "");
    $pto = (!empty($_GET['pfrom']) ?   $_GET['pto']: "");
    
    $arr = array();
    $queryString = "SELECT a.paymentid, a.adminid,c.username as agentuser,
a.agentid, a.paymenttime,a.paymentamount,
a.paymentcurrencyid, a.paymentusdamount
FROM payment a 
inner join members c on a.agentid = c.id
 where a.agentid='". $userId ."' ";
    
    
    if ($pfrom<> ""){ array_push($arr,"pfrom");}
    if ($pto<> ""){ array_push($arr,"pto");}
    
    if (count($arr)> 0){
    for ($i = 0;$i < count($arr);$i++ ){
       
            //first element to be put in where clause, so add " where "
            
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
    
    
    
    return $queryString;
}


?>