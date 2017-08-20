<?php

require_once('mekrodb.php');
require_once('FirePHPCore/fb.php');
require_once('helper.php');

ob_start();
#get a firePHP variable reference
$firephp = FirePHP::getInstance(true);

session_start();


// flightid, class and pax are fixed
$flightsids = htmlspecialchars($_POST['flightsids']);
$class = htmlspecialchars($_POST["cbclass"]);
$pax = htmlspecialchars($_POST["pax"]);
$firstclassprice = htmlspecialchars($_POST["firstclassprice"]);
$secondclassprice = htmlspecialchars($_POST["secondclassprice"]);


//array elements

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$nationality = $_POST['nationality'];
$birthday = $_POST['birthday'];
$birthmonth = $_POST['birthmonth'];
$birthyear = $_POST['birthyear'];

/*

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


*/






foreach ($_POST['fname'] as $key => $value) {echo $key.'=>'.$value.'<br>';}

doBooknig($flightsids, $class, $pax, getUserId($_SESSION['username']), $firstclassprice, $secondclassprice
        ,$fname, $lname, $phone, $email,$birthday,$birthmonth,$birthyear, $nationality);




//show fields
//foreach ( $fname as $key => $n ) {
////$values = mysql_real_escape_string($value);
////$query = mysql_query("INSERT INTO my_hobbies (hobbies) VALUES ('$values')", $connection );
//    echo $n[$key];
//
//}