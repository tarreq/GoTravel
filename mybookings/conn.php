<?php
require '../db_global.php';

$conn = @mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db(DB_NAME, $conn);

?>