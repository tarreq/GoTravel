<?php

$id = intval($_REQUEST['id']);
$firstname = htmlspecialchars($_REQUEST['fname']);
$lastname = htmlspecialchars($_REQUEST['lname']);
$phone = htmlspecialchars($_REQUEST['phone']);
$email = htmlspecialchars($_REQUEST['email']);

include 'conn.php';

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

$sql = "update bookingpassenger set fname='$firstname',lname='$lastname',phone='$phone',email='$email' where bookingpassengerid=$id";
$result = @mysql_query($sql);
if ($result){
        header('Content-Type: application/json; charset=utf-8');
	echo json_encode(array(
		'bookingpassengerid' => $id,
		'fname' => $firstname,
		'lname' => $lastname,
		'phone' => $phone,
		'email' => $email
	),JSON_UNESCAPED_UNICODE);
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>