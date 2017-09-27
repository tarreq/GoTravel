<?php




require_once('../helper.php');
require_once('../mekrodb.php');

session_start();

//get current userId 
$userId = getUserId($_SESSION['username']);
$languageid = htmlspecialchars($_REQUEST['languageid']);


// insert a new payment
$updateResult= DB::update('members', array(
  'languageid' => $languageid
        
), "id=%s", $userId);
 
//$result = DB::insertId(); // which id did it choose?!? tell me!!

if ($updateResult){
	echo json_encode(array(
		'id' => $updateResult
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>