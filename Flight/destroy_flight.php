<?php

$id = intval($_REQUEST['flightid']);

require_once('../mekrodb.php');

$result = DB::delete('flight', "flightid=%i",$id );

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>