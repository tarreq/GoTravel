<?php
require_once '../db_global.php';

//DATABASE CONNECTION VARIABLES
$host = DB_SERVER; // Host name
$username = DB_USER; // Mysql username
$password = DB_PASSWORD; // Mysql password
$db_name = DB_NAME; // Database name

//DO NOT CHANGE BELOW THIS LINE UNLESS YOU CHANGE THE NAMES OF THE MEMBERS AND LOGINATTEMPTS TABLES

$tbl_prefix = ""; //***PLANNED FEATURE, LEAVE VALUE BLANK FOR NOW*** Prefix for all database tables
$tbl_members = $tbl_prefix."members";
$tbl_attempts = $tbl_prefix."loginAttempts";
