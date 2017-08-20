<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../themes/color.css">
	<link rel="stylesheet" type="text/css" href="../demo.css">
	<script type="text/javascript" src="../../jquery.min.js"></script>
	<script type="text/javascript" src="../../jquery.easyui.min.js"></script>
</head>
    
<?php
require_once('mekrodb.php');


//get passengers data
$passengers = DB::query("SELECT a.fname, a.lname , a.phone, b.namearabic FROM bookingpassenger a 
inner join country b on a.countryid = b.id
where bookingid=".$_GET['bid']);


//Get flight data
$results = DB::query("select b.tickettypename,a.passengercount,a.totalfare,d.flightcode,d.flightdate,d.flighttime, e.routeperiod,
 h.citynamearabic as origincity , k.citynamearabic as destinationcity,
 f.airportcode as origincode, f.airportarabicname as originname,
  g.airportcode as destinationcode, g.airportarabicname as destinationname

from booking a inner join tickettype b 
on a.tickettypeid = b.tickettypeid inner join flight d
on a.flightid = d.flightid or a.returnflightid = d.flightid inner join route e 
on d.routeid = e.id inner join airport f 
on e.originairportid = f.id inner join airport g
on e.destinationairportid = g.id inner join city h
on f.cityid = h.cityid inner join city k
on g.cityid = k.cityid
where a.bookingid=".$_GET['bid']);

//print passengers data
echo "<table id=\"passenger\" class=\"table\">"
."<tr><td><h2>passenger/s Names: </h2></td></tr>"
;

foreach ($passengers as $row) {
    
  echo "<tr><td> " . $row['fname'] . " " .  $row['lname']."</td></tr>";
  
}

//print flight data
echo "<h2>Booking No:".$_GET['bid']."</h2></br></br>".
    "<table id=\"flight\" class=\"table\">
        <tr><td><h2>Flight Details: </h2></td></tr>
        <tr>
        <td>Ticket Type</td><td>".$results[0]['tickettypename']."</td></tr>
        <tr>
        <td>From - To</td><td>Flight No.</td><td>Date</td><td>Departue</td><td>Duration</td></tr>
        ";
        foreach ($results as $row) {
        echo "<tr><td>".$row['origincity']." - ".$row['destinationcity']."</td><td>"
                .$row['flightcode']."</td><td>".$row['flightdate']."</td><td>".$row['flighttime']
                ."</td><td>".$row['routeperiod']."</td></tr>";
            };
        
            //echo "</tr>";


?>

    
    </html>