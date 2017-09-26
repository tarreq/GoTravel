<?php

$id = intval($_REQUEST['cityid']);

require_once('../mekrodb.php');

$result = DB::delete('city', "cityid=%i",$id );

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>