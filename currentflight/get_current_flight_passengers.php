<?php

require_once('../mekrodb.php');
require_once('../helper.php');


$currentFlightId = getCurrentFlightId();
$results = DB::query("SELECT a.bookingid , a.fname, a.lname, a.phone, a.email, a.countryid, a.birthday, a.birthmonth, a.birthyear
from bookingpassenger a
inner join booking b on a.bookingid = b.bookingid
inner join flight c on b.flightid = c.flightid 
where c.flightid =" . $currentFlightId .";");

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);



?>