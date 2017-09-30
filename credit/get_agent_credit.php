<?php
require_once('../helper.php');
require_once('../mekrodb.php');

session_start();

//get current userId 
$userId = getUserId($_SESSION['username']);

$results = DB::query("SELECT a.paymenttime ,a.paymentamount ,b.username as addedby, d.username as agentname,
c.currencyname, CONCAT(a.paymentusdamount,' USD') as paymentusdamount
FROM payment a
inner join members b on a.adminid = b.id
inner join members d on a.agentid = d.id
inner join currency c on a.paymentcurrencyid = c.currencyid
where a.agentid ='".$userId."' "
        . " order by a.paymenttime");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);

?>