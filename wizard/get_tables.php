<?php

require_once('../mekrodb.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$results = DB::query("SELECT table_name FROM information_schema.tables where table_schema='godb3';");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($results,JSON_UNESCAPED_UNICODE);
    
?>