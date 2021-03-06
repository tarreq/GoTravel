<?php require "login/loginheader.php"; ?>

<!DOCTYPE html>

<html>
 

<head>
	<meta charset="UTF-8">
	<title>Charter Booking System Admin - V1.0</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	    <link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
	    <link rel="stylesheet" type="text/css" href="../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../themes/color.css">
	    <link rel="stylesheet" type="text/css" href="../demo.css">
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="LTE/AdminLTE.min.css">
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
        <script src="LTE/adminlte.min.js"></script>
        
        <style>
        #feedback { font-size: 1.4em; }
        #selectable .ui-selecting { background: #FECA40; }
        #selectable .ui-selected { background: #F39814; color: white; }
        #selectable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
        #selectable li { margin: 3px; padding: 1px; float: left; width: 300px; height: 150px; font-size: 18px; text-align: center; }
        .ui-widget-content:hover {
           background-color: #e6f2ff;
        }
        
        #flightformtable.td{
            height: 30px;
            
        }
        .topics tr { line-height: 30px; }
        
        table#albums 
        {
            border-collapse:separate;
            border-spacing:0 8px;
        }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
<!--	<script type="text/javascript" src="../../jquery.min.js"></script>-->
	<script type="text/javascript" src="../../jquery.easyui.min.js"></script>
        <script type="text/javascript" src="helperq.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>

$(function () {
    $("#selectable").selectable({
        stop: function () {
            var text = $(this).children(".ui-selected").map(function () {
                return $(this).attr('id');
            }).get().join(',');
            $("#select-result").text(text);
        }
    });
});
  
 


 
        </script>  

       
	
	
</head>
<!--<body onload="document.form1.submit()">-->
<body>
    <table>
        <tr>
            <td style="padding: 5px 10px 0px 5px;">
                <img src="travel.png" width="50px" height="50px">
            </td>
        <td style="padding: 5px 10px 0px 5px;">
	<h2>Charter Booking System Admin v 1.0</h2>
	<p><?php require "helper.php";  echo "Logged as: " . $_SESSION['username'] ."<br />Credit: ".getCredit(getUserId($_SESSION['username'])); ?>
        </br>
        <a href="login/logout.php">Logout</a>
        </p>
        </td>
        </tr>
    </table>
	 
	<div style="margin:20px 0;"></div>
	<div class="easyui-layout" fit="true">
<!--		<div data-options="region:'north'" style="height:20px"></div>-->
		<div data-options="region:'south',split:true" style="height:50px;"></div>
<!--		<div data-options="region:'east',split:true" title="East" style="width:180px;">
			<ul class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true,dnd:true"></ul>
		</div>-->
		<div data-options="region:'west',split:true" title="Agent" style="width:250px;">
			<div class="easyui-accordion" data-options="fit:true,border:false">
<!--				<div title="Flights" style="padding:10px;">
					content1
				</div>-->
				<div title="Bookings" data-options="selected:true" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="openMyBookings()">My Bookings</a>
				</div>
                                <div title="Flights" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Flights Details','flights.php')">Flights</a>
				</div>
                                <div title="Passengers" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Passengers','passengers.php')">Passengers</a>
				</div>
                                <div title="Settings" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Settings','settings.php')">Settings</a>
				</div>
                                <div title="Credit" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Credit','credit.php')">My Credit</a>
				</div>

<!--				<div title="Users" style="padding:10px">
					content3
				</div>-->
			</div>
		</div>
		<div data-options="region:'center',title:'Main',iconCls:'icon-ok'">
			<div id="tt" class="easyui-tabs" data-options="fit:true,border:false,plain:true">
				<div title="Flights" style="padding:5px">
				
				<!-- selectable start -->
				

                <form id="form1" name="form1" action="admin.php" method="post" >
<!--                <script>document.getElementById('form1').submit();</script>-->
                <table id="albums">
                
                <tr>
                <td width="100px">Flight</td>
                <td width="200px"> 
                <input id="tripx" type="radio" name="tripx" value="0" checked="checked"> All Flights
                <input id="tripx" type="radio" name="tripx" value="1"> One way 
                <input id="tripx" type="radio" name="tripx" value="2"> Return
                </td>

                </tr>
                
                <tr>
                <td width="100px">Departure from </td>
                <td width="150px"> 
                <input id="dfrom" name="dfrom"  class="easyui-datebox">
                </td>
                <td width="100px">Departure To </td>
                <td width="150px"> 
                <input id="dto" name="dto" class="easyui-datebox" >
                </td>
                </tr>
                
                <tr>
                <td width="100px">Return From </td>
                <td width="150px"> 
                <input id="rfrom" name="rfrom" class="easyui-datebox" >
                </td>
                <td width="100px">Return To </td>
                <td width="150px"> 
                <input id="rto" name="rto" class="easyui-datebox"  >
                </td>
                 </tr>
                
                <tr>
                <td width="100px">From </td>
                <td width="150px"> 
                <input id="airo" class="easyui-combobox" name="airo"
                data-options="valueField:'id',textField:'airportarabicname',url:'lookup.php?table=airport'">
                </td>
               
                <td width="100px">To </td>
                <td width="150px">
                <input id="aird" class="easyui-combobox" name="aird"
                data-options="valueField:'id',textField:'airportarabicname',url:'lookup.php?table=airport'">
                </td>
                </tr>
                
                <tr>
                <td width="100px">Pax </td>
                <td width="150px">
                <select id="pax" name="pax" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                </select>
                </td>
                
                <td width="100px">Class </td>
                <td width="150px">
                <select id="cbclass" name="cbclass" >
                <option value="1">Tourism</option>
                <option value="2">Business</option>
                </select>
                </td>
                </tr>  
<!--                <span style="display:inline-block;width:300px;"></span>-->
                
                <tr>
                <td width="100px">
                
                </td>

                <td style="height:60px;width:150px;">
                <input class="ui-button ui-widget ui-corner-all" type="submit" value="Search Flights">
                </td>
                <td>
                    
                </td>
                <td style="height:60px;width:100px;">
                <a href="javascript:void(0)" class="easyui-linkbutton c1" style="width:130px; height:30px;" onclick="makeBookingQ()">Book Flight</a>
                </td>
                </tr>
                </table> 
        </form>
                                
                                 <p id="feedback">
                    <div id="select-result" style="display: none;">none</div>
                </p>
                
                <ul id="selectable">
                    <?php 
                    $tripx = array( "-","Outbound", "Inbound");
                    if (!empty($_POST))
                    {
                    $results = getFlights($_POST["dfrom"], $_POST["dto"], $_POST["rfrom"], $_POST["rto"], $_POST["airo"], $_POST["aird"],$_POST["tripx"]);
                    
                    foreach ($results as $row) {
                    
                    echo "<li class=\"ui-widget-content\" id=\"".$row['flightid']."\">" . $row['flightcode']."</br>".$row['flightdate']." - ".$row['flighttime'] 
                            ."</br>".$row['origin']."-->".$row['destination'] 
                          ."</br>Tourism:".$row['remainingsecond']." / ".$row['secondclassprice']."</br>Business: ".$row['remainingfirst']." / ".$row['firstclassprice']
                          ."</br>". $tripx[$row['tripx']]
//                            ($row['tripx'] == 1 ? "ذهاب" : "عودة")
                          
                          . "</li>";
        
                    }
//                        foreach ($_POST as $param_name => $param_val) {
//                        echo "Param: $param_name; Value: $param_val<br />\n";}
                    }
                    else
                        {
                    $results = getFlights(1,1, 1, 1, 1, 1,0);
                    
                    foreach ($results as $row) {
                    
                    echo "<li class=\"ui-widget-content\" id=\"".$row['flightid']."\">" . $row['flightcode']."</br>".$row['flightdate']." - ".$row['flighttime'] 
                            ."</br>".$row['origin']."-->".$row['destination'] 
                          ."</br>Tourism:".$row['remainingsecond']." / ".$row['secondclassprice']."</br>Business: ".$row['remainingfirst']." / ".$row['firstclassprice']
                          ."</br>". $tripx[$row['tripx']]
//                            ($row['tripx'] == 1 ? "ذهاب" : "عودة")
                          
                          . "</li>";
        
                    }
//                        foreach ($_POST as $param_name => $param_val) {
//                        echo "Param: $param_name; Value: $param_val<br />\n";}
                    }
                    ?>
               
                </ul>
                <br>
                <div>
                    
                </div>

					<!-- Datagrid end -->
				</div>
			</div>
		</div>
	</div>
</body>
</html>