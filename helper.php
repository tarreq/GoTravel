<?php

/* 
 * Author : Tareq mamdouh
 * Date : 20 / 06 / 2017
 * Version : 1.0
 * Description : Helper functions file - Charter booking system
 */
require_once('mekrodb.php');
require 'php-export-data.class.php';





//Export XLS file
function exportExcel(){
    // 'browser' tells the library to stream the data directly to the browser.
// other options are 'file' or 'string'
// 'test.xls' is the filename that the browser will use when attempting to 
// save the download
$exporter = new ExportDataExcel('browser', 'test.xls');

$exporter->initialize(); // starts streaming data to web browser

// pass addRow() an array and it converts it to Excel XML format and sends 
// it to the browser
$exporter->addRow(array("This", "is", "a", "test")); 
$exporter->addRow(array(1, 2, 3, "123-456-7890"));

// doesn't care how many columns you give it
$exporter->addRow(array("foo")); 

$exporter->finalize(); // writes the footer, flushes remaining data to browser.

exit(); // all done

}



//currency converter API
function convertCurrency($amount, $from, $to){
    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    //$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    return round($converted, 3);
}


//lookup function , table name as parameter
function lookUpTable($tablename){
     $result = DB::query("SELECT * FROM ". $tablename);
    return $result;
}

function lookUpTableWhere($tablename, $wh,$op, $vl,$limit){
     $result = DB::query("SELECT * FROM ". $tablename." where ".$wh.$op. "'".$vl."' limit ".$limit);
    return $result;
}

//get last flight available seats count
function getLastPayment(){
    $lastPayment = DB::queryFirstRow("select a.paymentusdamount,b.username from payment a
inner join members b on a.agentid = b.id
order by paymentid desc limit 1");
    return $lastPayment;
    
}

//get last flight total payment
function getCurrentFlightTotalPayment(){
    
    $currentFlightTotalPayment = DB::queryOneField('totalpayment',"SELECT SUM(totalfare) as totalpayment FROM godb4.booking where flightid=". getCurrentFlightId());
    return $currentFlightTotalPayment;
    
}

//get last flight available seats count
function getPassengerCountByAge($flightid,$age_min, $age_max){
    $mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
    $rs = $mysqli->query( 'CALL get_passenger_count_by_age('.$flightid.', '.$age_min.','.$age_max.',@total )' );
    $rs = $mysqli->query( 'SELECT @total' );
    $row = mysqli_fetch_array($rs);
    return $row[0]; 

//    while($row = $rs->fetch_object())
//        {
//            debug($row);
//        }
    
}


//get last flight available seats count
function getCurrentFlightId(){
    $flightId = DB::queryOneField('flightid',"SELECT * FROM flight
where flightdate >= CURDATE() 
order by flightdate limit 1");
    return $flightId;
    
}

function getCurrentFlightCode(){
    $flightCode = DB::queryOneField('flightcode',"SELECT * FROM flight
where flightdate >= CURDATE() 
order by flightdate limit 1");
    return $flightCode;
    
}

//get last flight available seats count
function getLastFlightSeats(){
    $seatCount = DB::queryFirstRow("select a.secondclassseats - IFNULL(SUM(c.secondclassseats),0) as remainingsecond, a.secondclassseats,
a.firstclassseats - IFNULL(SUM(c.firstclassseats),0) as remainingfirst, a.firstclassseats, b.flightcode
from jet a 
inner join flight b on b.jetid = a.jetid 
inner join booking c on c.flightid = b.flightid

where a.jetid =
(SELECT jetid FROM flight
where flightdate >= CURDATE() 
order by flightdate limit 1 )
and b.flightid = 
(SELECT flightid FROM flight
where flightdate >= CURDATE() 
order by flightdate limit 1 )");
    return $seatCount;
    
}

//get total credit of all users
function getTotalCredit(){
    $totalCredit = DB::queryOneField('totalcredit', "select SUM(membercredit) as totalcredit from members");
    return $totalCredit;
    
}

//get user language
function getUserLanguage(){
    $lang = DB::queryOneField('langid', "select * from user_setting where userid=%s", getUserId($_SESSION['username']));
    return $lang;
    
}


//This function takes username and return userid from members table to use it in booking
function getUserId($username){
    $userId = DB::queryOneField('id', "SELECT * FROM members WHERE username=%s", $username);
    return $userId;
    
}

//This function takes userid and return username from members table 
function getUserName($userid){
    $username = DB::queryOneField('username', "SELECT * FROM members WHERE id=%s", $userid);
    return $username;
    
}

//Retreive Credit Amount of current logged user
function getCredit($userid){
     $userCredit = DB::queryOneField('membercredit', "SELECT * FROM members WHERE id=%s", $userid);
    return $userCredit;
   
}

function updateUserCredit ($username, $value){
    DB::query("UPDATE members SET membercredit= membercredit - %i WHERE id=%s",$value , $username);
    $counter = DB::affectedRows();
    
    return $counter;
}


////Make booking Function
function doBooknig($flightsids, $class, $pax, $memberid,$firstclassprice,$secondclassprice,
        $fname, $lname, $phone, $email,$birthday, $birthmonth, $birthyear, $nationality){
    
//Total fare to be paid
$totalfare = ($class == 1 ? $pax * $secondclassprice : $pax * $firstclassprice );
FB::log($totalfare,'total fare: ');
//Ticket class
$selectedclass = ($class == 1 ? 'secondclassseats' : 'firstclassseats' );
$flightsids_insert=[];

if (strpos($flightsids,',')){
    $flightsids_insert = explode(',',$flightsids);
}
else {
    $flightsids_insert = $flightsids;
}
    

FB::log($selectedclass,'class: ');


DB::startTransaction();
//check if user credit is enough
//$membercredit = DB::queryOneField('credit',"select credit from box where memberid=%s", $memberid);
$membercredit = getCredit($memberid);
FB::log($membercredit,'credit : ');

//if member credit >= Total fare, start insert , else error msg
if ($membercredit >= $totalfare){
    
//check if there is a return flight or just one fligh ($flightsids_insert array > 1)
if (count($flightsids_insert)>1){
    //insert two flights
    
    DB::insert('booking', array(
  'bookingid' => 0, // auto incrementing column
  'flightid' => $flightsids_insert[0],
  'returnflightid' => $flightsids_insert[1],
  'memberid'=> $memberid,
  'bookingtime'=> date('Y-m-d H:i:s'),
  'tickettypeid' => $class,
  'passengercount'=> $pax,
  'totalfare'=> $totalfare,
  $selectedclass => $pax
    
));
    
}
else{
// insert only one flight
DB::insert('booking', array(
  'bookingid' => 0, // auto incrementing column
  'flightid' => $flightsids_insert,
  'memberid'=> $memberid,
  'bookingtime'=> date('Y-m-d H:i:s'),
  'tickettypeid' => $class,
  'passengercount'=> $pax,
  'totalfare'=> $totalfare,
  $selectedclass => $pax
    
));
}
$booking_id = DB::insertId(); // which id did it choose?!? tell me!!

//if successfully inserted booknig
if ($booking_id > 0 ){
    //DB::commit();
    //Start inserting passengers into bookingpassenergs table
   for ($i = 0 ; $i < count($fname);$i++)
   {
   DB::insert('bookingpassenger', array(
  'bookingpassengerid' => 0, // auto incrementing column
  'bookingid' => $booking_id,
  'fname' => $fname[$i],
  'lname' => $lname[$i],
  'phone' => $phone[$i],
  'email' => $email[$i],
  'birthday' => $birthday[$i],
  'birthmonth' => $birthmonth[$i],
  'birthyear' => $birthyear[$i],
  'countryid' => $nationality[$i]
   
    
));
   } 
   
   $bookingpassenger_id = DB::insertId(); //get last inserted passenger id
   FB::log($bookingpassenger_id,'last passenger id: ');
   if ($bookingpassenger_id > 0) { 
       
       $updateCreditResult = updateUserCredit($memberid, $totalfare);
               if ($updateCreditResult > 0 )
               { DB::commit(); 
               
               // print messege and make print link
               
            echo "<span> Successfuly Saved booking No.:".$booking_id."</span></br></br>"
            ."<a href=\"bookprintx.php?bid=".$booking_id."\">Print Ticket here</a>"
            ;
               }
               else { DB::rollback(); }
               
       
   } 
   
       
}

else {
    DB::rollback();
    
}
    
}

//if credit is not enough, print msg 
else{
    
    echo "your Credit is not Enough  !";
}
}


//Booking cancellation
function cancelBooking($bookingId)
{
    
}

function getFlights($dfrom, $dto, $rfrom, $rto, $airo, $aird, $tripx){
//$dfrom = $_GET['dfrom'];
//$dto = $_GET['dto'];
//$airo = $_GET['airo'];
//$aird = $_GET['aird'];
//
//$rfrom = $_GET['rfrom'];
//$rto = $_GET['rto'];
//$tripx = $_GET['tripx'];

//start convert date provided by input to Mysql format - from 2017/04/01 to 2017-04-01




//$newdfrom = date("Y-m-d", strtotime($dfrom));
//$newdto = date("Y-m-d", strtotime($dto));

if ($tripx == 1){
    
$parts1 = explode('/',$dfrom);
$newdfrom = $parts1[2] . '-' . $parts1[0] . '-' . $parts1[1];
        
$parts2 = explode('/',$dto);
$newdto = $parts2[2] . '-' . $parts2[0] . '-' . $parts2[1];

$results = DB::query("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
h.firstclassseats - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,h.secondclassseats -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode, 1 as tripx
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid"
." where a.flightdate between '".$newdfrom."' and '".$newdto."'" 
." and b.originairportid=".$airo." and b.destinationairportid=".$aird
." group by a.flightid
;");
//header('Content-Type: application/json; charset=utf-8');
//echo json_encode($results,JSON_UNESCAPED_UNICODE);
return $results;
}
if ($tripx == 2)
{   

$parts1 = explode('/',$dfrom);
$newdfrom = $parts1[2] . '-' . $parts1[0] . '-' . $parts1[1];
        
$parts2 = explode('/',$dto);
$newdto = $parts2[2] . '-' . $parts2[0] . '-' . $parts2[1];    
 
$parts3 = explode('/',$rfrom);
$newrfrom = $parts3[2] . '-' . $parts3[0] . '-' . $parts3[1];
        
$parts4 = explode('/',$rto);
$newrto = $parts4[2] . '-' . $parts4[0] . '-' . $parts4[1];

    $results = DB::query("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
IFNULL(h.firstclassseats,0) - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,IFNULL(h.secondclassseats,0) -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode, 1 as tripx
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid"
." where a.flightdate between '".$newdfrom."' and '".$newdto."'" 
." and b.originairportid=".$airo." and b.destinationairportid=".$aird
." group by a.flightid
union 
SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
IFNULL(h.firstclassseats,0) - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,IFNULL(h.secondclassseats,0) -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode, 2 as tripx
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid"
." where a.flightdate between '".$newrfrom."' and '".$newrto."'" 
." and b.originairportid=".$aird." and b.destinationairportid=".$airo
." group by a.flightid
;");
//header('Content-Type: application/json; charset=utf-8');
//echo json_encode($results,JSON_UNESCAPED_UNICODE);
return $results;

}
if ($tripx == 0)
{
$results = DB::query("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(IFNULL(a.firstclassprice,0),'$') as firstclassprice
, CONCAT(IFNULL(a.secondclassprice,0),'$') as secondclassprice ,
h.firstclassseats - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,h.secondclassseats -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode, 0 as tripx
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid or a.flightid = j.returnflightid
group by a.flightid;");
//header('Content-Type: application/json; charset=utf-8');
//echo json_encode($results,JSON_UNESCAPED_UNICODE);
return $results;
}
    
}