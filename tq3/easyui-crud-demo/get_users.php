<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 30;
	$offset = ($page-1)*$rows;
	$result = array();

	include 'conn.php';
	
	$rs = mysql_query("select count(*) from bookingpassenger");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
        
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET CHARACTER SET utf8");
        mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
        
	$rs = mysql_query("select * from bookingpassenger where  limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
        
        
        header('Content-Type: application/json; charset=utf-8');
	echo json_encode($result,JSON_UNESCAPED_UNICODE);

?>