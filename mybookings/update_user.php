<?php

$id = intval($_REQUEST['id']);
$firstname = htmlspecialchars($_REQUEST['fname']);
$lastname = htmlspecialchars($_REQUEST['lname']);
$phone = htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);
$birthday = htmlspecialchars($_REQUEST['birthday']);
$birthmonth = htmlspecialchars($_REQUEST['birthmonth']);
$birthyear = htmlspecialchars($_REQUEST['birthyear']);

include 'conn.php';

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

$sql = "update bookingpassenger set fname='$firstname',lname='$lastname',phone='$phone',email='$email'"
        . ",birthday='$birthday',birthmonth='$birthmonth', birthyear='$birthyear' where bookingpassengerid=$id";
$result = @mysql_query($sql);
if ($result){
        header('Content-Type: application/json; charset=utf-8');
	echo json_encode(array(
		'bookingpassengerid' => $id,
		'fname' => $firstname,
		'lname' => $lastname,
		'phone' => $phone,
		'email' => $email,
                'birthday' => $birthday,
                'birthmonth' => $birthmonth,
                'birthyear' => $birthyear
	),JSON_UNESCAPED_UNICODE);
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>