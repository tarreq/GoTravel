<?php

$id = intval($_REQUEST['id']);

require_once('../mekrodb.php');

$result = DB::delete('airport', "id=%i",$id );

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>