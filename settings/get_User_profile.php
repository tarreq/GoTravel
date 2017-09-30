<?php

require_once('../mekrodb.php');
require_once('../helper.php');

session_start();

//get current userId 
$userId = getUserId($_SESSION['username']);
$memberType = DB::queryOneField('membertype', "SELECT * FROM members WHERE id=%s", $userId);

if ($memberType == 2)
    {
        //user, get only his bookings
    $results = DB::query("SELECT * from members
where id ='".$userId.
"'");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }
    else
    {
       //admin , get all booknigs 
        $results = DB::query("SELECT * from members");
      

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
    }


?>

