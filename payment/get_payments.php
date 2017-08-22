<?php

require_once('../helper.php');
require_once('../mekrodb.php');
session_start();

        //get current userId 
        $userId = getUserId($_SESSION['username']);

$results = DB::query("SELECT a.paymentid, a.adminid,b.username as adminuser,c.username as agentuser, a.agentid, 
a.paymenttime,a.paymentamount,a.paymentcurrencyid, a.paymentusdamount, a.notes
FROM payment a 
left join members b on a.adminid = b.id
inner join members c on a.agentid = c.id
");
//where a.adminid ='".$userId."';");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);


?>