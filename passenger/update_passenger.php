<?php
/*
				<th data-options="field:'fname',width:90">Name</th>
                                <th data-options="field:'lname',width:80">Surname</th>
				<th data-options="field:'phone',width:90">phone</th>
                                <th data-options="field:'email',width:90">Email</th>
				<th data-options="field:'nameenglish',width:120">Country</th>
                                <th data-options="field:'birthday',width:120">Birthday</th>
				<th data-options="field:'birthmonth',width:120">Birthmonth</th>
                                <th data-options="field:'birthyear',width:120">birthyear</th>
*/

$bookingpassengerid = htmlspecialchars($_REQUEST['bookingpassengerid']);
$fname = htmlspecialchars($_REQUEST['fname']);
$lname = htmlspecialchars($_REQUEST['lname']);
$phone = htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$countryid = htmlspecialchars($_REQUEST['countryid']);
$birthday = htmlspecialchars($_REQUEST['birthday']);
$birthmonth = htmlspecialchars($_REQUEST['birthmonth']);
$birthyear = htmlspecialchars($_REQUEST['birthyear']);


require_once('../helper.php');
require_once('../mekrodb.php');


// insert a new payment
$updateResult= DB::update('bookingpassenger', array(
  'fname' => $fname,
  'lname' => $lname,
  'phone' => $phone,
  'email' => $email,
  'countryid' => $countryid,
  'birthday' => $birthday,
  'birthmonth' => $birthmonth,
  'birthyear' => $birthyear
        
), "bookingpassengerid=%s", $bookingpassengerid);
 
//$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($updateResult){
	echo json_encode(array(
		'$bookingpassengerid' => $updateResult
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>