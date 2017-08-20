<?php
//DATABASE CONNECTION VARIABLES
$host = "localhost"; // Host name
$username = "saud_godb3_user"; // Mysql username
$password = "123456@godb3"; // Mysql password
$db_name = "saud_godb3"; // Database name

//DO NOT CHANGE BELOW THIS LINE UNLESS YOU CHANGE THE NAMES OF THE MEMBERS AND LOGINATTEMPTS TABLES

$tbl_prefix = ""; //***PLANNED FEATURE, LEAVE VALUE BLANK FOR NOW*** Prefix for all database tables
$tbl_members = $tbl_prefix."members";
$tbl_attempts = $tbl_prefix."loginAttempts";
