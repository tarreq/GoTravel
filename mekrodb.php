<?php
require_once('meekrodb.2.3.class.php');
require_once ('db_global.php');

DB::$user = DB_USER;
DB::$password = DB_PASSWORD;
DB::$dbName = DB_NAME;
DB::$encoding = 'utf8'; // defaults to latin1 if omitted

?>