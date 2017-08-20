<?php
require_once('mekrodb.php');


$flightid = htmlspecialchars($_POST['flightid']);
$class = htmlspecialchars($_POST["cmbclass"]);
$cbtitle = htmlspecialchars($_REQUEST['cmbtitle']);
$name = htmlspecialchars($_REQUEST['name']);
$surname = htmlspecialchars($_REQUEST['surname']);
$phone = htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$country = htmlspecialchars($_REQUEST['cmbcountry']);
//$birthdate = htmlspecialchars($_REQUEST['birthdate']);




//echo $flightid . "</br>".
//        $class . "</br>".
//        $cbtitle . "</br>".
//        $cbtitle . "</br>".
//        $name . "</br>".
//        $surname . "</br>".
//        $phone . "</br>".
//        $email . "</br>".
//        $country . "</br>";


//if Tourism class insert booking and put number in secondclassseats
if ($class == 1 ){
// insert a new booking
DB::insert('booking', array(
  'bookingid' => 0, // auto incrementing column
  'flightid' => $flightid,
  'tickettypeid' => $class,
  'passengertitle' => $cbtitle,
  'passengername' => $name,
  'passengersurname' => $surname ,
  'passengerphone' => $phone,
  'passengercountryid' => $country,
  'passengeremail' => $email,
  'secondclassseats' => 1
    
));
}


//if Tourism class insert booking and put number in secondclassseats
if ($class == 2 ){
// insert a new booking
DB::insert('booking', array(
  'bookingid' => 0, // auto incrementing column
  'flightid' => $flightid,
  'tickettypeid' => $class,
  'passengertitle' => $cbtitle,
  'passengername' => $name,
  'passengersurname' => $surname ,
  'passengerphone' => $phone,
  'passengercountryid' => $country,
  'passengeremail' => $email,
  'firstclassseats' => 1
    
));
}
//Return inserted booking ID
$insertedbookingid = DB::insertId(); // which id did it choose?!? tell me!!
echo "<span> Successfuly Saved booking No.:".$insertedbookingid."</span></br></br>"
        ."<a href=\"bookprint.php?bid=".$insertedbookingid."\">Print Ticket here</a>"
        ;


