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
$flightid = $_GET['fid'];


$results = DB::queryFirstRow("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(a.firstclassprice,'$') as firstclassprice
, CONCAT(a.secondclassprice,'$') as secondclassprice ,
h.firstclassseats - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,h.secondclassseats -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode
FROM godb.flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid inner join jet h
on a.jetid = h.jetid inner join booking j
on a.flightid = j.flightid"
." where a.flightid=".$_GET['fid'].";");

echo "<table id=\"flight\" class=\"table\">
    <tr>
        <th>رقم الرحلة</th>
        <th>التاريخ</th>
        <th>الوقت</th>
        <th>من</th>
        <th>الي</th>
        <th>سعر رجال أعمال</th>
        <th>سعر سياحية</th>
        <th>مقاعد د.اولي</th>
        <th>مقاعد د.ثانية</th>
        <th>الحالة</th>
        
    </tr>
    <tr>
        <td>".$results['flightcode']."</td>
        <td>".$results['flightdate'] ."</td>
        <td>".$results['flighttime'] ."</td>
        <td>".$results['origin'] ."</td>
        <td>".$results['destination']."</td>
        <td>".$results['firstclassprice'] ."</td>
        <td>".$results['secondclassprice'] ."</td>
        <td>".$results['remainingfirst'] ."</td>
        <td>".$results['remainingsecond'] ."</td>
        <td>".$results['flightstatuscode'] ."</td>
        
    </tr>

"
?>


<!--<div class="easyui-panel" title="Ajax Form" style="width:300px;padding:10px;">-->
    <form id="ff" action="booking_proc.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Class:</td>
                <td><input class="easyui-combobox" name="class"
                data-options="valueField:'tickettypeid',textField:'tickettypename',url:'lookup.php?table=tickettype'">
                
                <input type="hidden" name="flightid" value="<?php echo $flightid; ?>">
                </td>
            </tr>
            <tr>
                <td>Title: </td>
                <td>
                    <select id="cbtitle" class="easyui-combobox" name="cbtitle" required="true">
                    <option value="1">Mr.</option>
                    <option value="2">Mrs./Ms.</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Passenger Name:</td>
                <td><input name="name" class="easyui-validatebox"></input></td>
            </tr>
            <tr>
                <td>Sur Name:</td>
                <td><input name="surname" class="easyui-validatebox" ></input></td>
            </tr>
            <tr>
                <td>Passenger Phone:</td>
                <td><input name="phone" type="text" class="easyui-validatebox" required="true" validType="string"></input></td>
            </tr>
            <tr>
                <td>Passenger Email:</td>
                <td><input class="easyui-validatebox" type="text" name="email" required="true" validType="email"></input></input></td>
            </tr>
            <tr>
                <td>Country :</td>
                <td><input id="country" class="easyui-combobox"
                data-options="valueField:'id',textField:'namearabic',url:'lookup.php?table=country'"></td>
            </tr>
            <tr>
                <td>Birthdate :</td>
                <td><input id="birthdate"  class="easyui-datebox" name="birthdate" required="required"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Submit"></input></td>
            </tr>
        </table>
    </form>
<!--</div>-->
    
    </html>