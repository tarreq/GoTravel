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



$results = DB::queryFirstRow("select a.passengername , a.passengersurname, a.passengerphone,a.passengeremail, 
b.tickettypename,d.flightcode,d.flightdate,d.flighttime, c.namearabic ,e.routeperiod,
 h.citynamearabic as origincity , k.citynamearabic as destinationcity,
 f.airportcode as origincode, f.airportarabicname as originname,
  g.airportcode as destinationcode, g.airportarabicname as destinationname

from booking a inner join tickettype b 
on a.tickettypeid = b.tickettypeid inner join country c
on a.passengercountryid = c.id inner join flight d
on a.flightid = d.flightid inner join route e 
on d.routeid = e.id inner join airport f 
on e.originairportid = f.id inner join airport g
on e.destinationairportid = g.id inner join city h
on f.cityid = h.cityid inner join city k
on g.cityid = k.cityid
where a.bookingid =".$_GET['bid']);

echo "<h2>Booking No:".$_GET['bid']."</h2></br></br>".
    "<table id=\"flight\" class=\"table\">
        <tr>
        <td>Name</td><td>".$results['passengername']."</td></tr>
        <tr>
        <td>Sur Name</td><td>".$results['passengersurname'] ."</td></tr>
        <tr>
        <td>Phone</td><td>".$results['passengerphone'] ."</td></tr>
        <tr>
        <td>E-mail</td><td>".$results['passengeremail'] ."</td></tr>
        <tr>
        <td>Nationality</td><td>".$results['namearabic'] ."</td></tr>
        <tr>
        <td>Ticket Type</td><td>".$results['tickettypename']."</td></tr>
        <tr>
        <td>From - To</td><td>Flight No.</td><td>Date</td><td>Departue</td><td>Duration</td></tr>
        <tr>
        <td>".$results['origincity']." - ".$results['destinationcity']."</td><td>".$results['flightcode']."</td><td>".$results['flightdate']."</td><td>".$results['flighttime']."</td><td>".$results['routeperiod']."</td>
        
    </tr>

"
?>

    
    </html>