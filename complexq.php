<?php require "login/loginheader.php"; ?>

<!DOCTYPE html>

<html>
 

<head>
	<meta charset="UTF-8">
	<title>GO Travel</title>
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
        #selectable li { margin: 3px; padding: 1px; float: left; width: 300px; height: 150px; font-size: 14px; text-align: center; }
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
        
        #creditbox
        {
            background-color: #e6f2ff;
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
//$(document).ready(function(){
//     $("#frm1").submit();
//});

$(function () {
    $("#selectable").selectable({
        
        stop: function () {
            var text = $(this).children(".ui-selected").map(function () {
                return $(this).attr('id');
            }).get().join(',');
            $("#select-result").text(text);
            
        }
        ,cancel: 'a' 
        
    });
    
//    $(".selectable").selectable({
//        cancel: 'a'
//    });
});
  
 


 
        </script>  

       
	
	
</head>
<body bgcolor="#f2f2f2">

    <table>
        <tr>
            <td style="padding: 5px 10px 0px 5px;">
                <img src="travel.png" width="50px" height="50px">
            </td>
        <td style="padding: 5px 10px 0px 5px;">
	<h2>Go Travel</h2>
	<p><?php require "helper.php";  echo "Logged as: " . $_SESSION['username'] ."<br /><div style=\"color:#ffffff;font-weight: bold;text-align: center;background-color: #737373;width:130px;height:30px;font-size: 16px;\">Credit: ".getCredit(getUserId($_SESSION['username']))."</div>"; ?>
        </br>
        <a href="login/logout.php">Logout</a>
        </p>
        </td>
        <td width="360px" style="padding-left: 50px;"><div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-red"><i class="fa fa-star-o" style=" vertical-align: middle;"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Current Flight</span>
    <span class="info-box-number"><a href="#"><?php echo getCurrentFlightCode(); ?></a></span>
  </div>
  <!-- /.info-box-content -->
</div> </td>
<td width="360px" style="padding-left: 50px;"><div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-green"><i class="fa fa-envelope-o" style=" vertical-align: middle;"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Seats</span>
    <span class="info-box-number"><?php echo getLastFlightSeats()['remainingsecond']."/".getLastFlightSeats()['secondclassseats']." - ".getLastFlightSeats()['remainingfirst']."/".getLastFlightSeats()['firstclassseats']; ?></span>
  </div>
  <!-- /.info-box-content -->
</div> </td>
<td width="360px" style="padding-left: 50px;"><div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-aqua"><i class="fa fa-flag-o" style=" vertical-align: middle;"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Currency Rates</span>
    <span class="info-box-number"><?php echo "1 USD= ". /*convertCurrency(1, "USD", "SAR").*/ " SAR"; ?></span>

  </div>
  <!-- /.info-box-content -->
</div> 
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
		<div data-options="region:'west',split:true" title="Agent Dashboard" style="width:250px;">
			<div class="easyui-accordion" data-options="border:false">
<!--				<div title="Flights" style="padding:10px;">
					content1
				</div>-->
                                <div title="Bookings" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="addStaticTab('My Bookings','mybookings/mybookingsall.php')">All Bookings</a>
<!--                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="openMyBookings()">Book a ticket</a>-->
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="addStaticTab('Cancel Booking','mybookings/agentcancelbooking.php')">Cancel a booking</a>
                                        
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="addStaticTab('Booking Query','mybookings/mybookings.php')">Booking Query</a>
				</div>
                                <div title="Flights" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('All Flights','flights.php')">All Flights</a>
                                        
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-plane',plain:true" onclick="addStaticTab('Flights Reports','flightsreports.php')">Flights Reports</a>
				</div>
                                <div title="Passengers" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-users',plain:true" onclick="addStaticTab('Passengers','passenger/passengermanagement.php')">All Passengers</a>
                                        
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-users',plain:true" onclick="addStaticTab('Passengers','passenger/passengersreports.php')">Passengers Reports</a>
				</div>
                                <div title="Credit" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Credit','credit/agentcredit.php')">All Transactions</a>
                                        <br>
<!--                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Credit','credit.php')">Go Travel Credit</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Credit','credit.php')">Ticket Transactions</a>
                                        <br>-->
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="addStaticTab('Credit reports','credit/agentcreditreports.php')">Credit Reports</a>
				</div>
                                <div title="Settings" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-cogs',plain:true" onclick="addStaticTab('Profile Settings','settings/profilesettings.php')">Profile Settings</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-cogs',plain:true" onclick="addStaticTab('Application Settings','settings/usersettings.php')">Application Settings</a>
                                        <br>
				</div>
                                <div title="Contact" style="padding:10px;">
					
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Branch Contact</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Head Office Contact</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Direct Messeges</a>
				</div>
                               
                                <div title="Help" style="padding:10px;">
					
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Help</a>
                                        <br>
                                         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Support</a>
                                       
                                       
                                      
				</div>
                                
				
                                
                                
<!--                                data-options="selected:true"-->
<!--				<div title="Users" style="padding:10px">
					content3
				</div>-->
			</div>
		</div>
		<div data-options="region:'center',title:'Main',iconCls:'icon-ok'">
			<div id="tt" class="easyui-tabs" data-options="fit:true,border:false,plain:true">
				<div title="Flights" style="padding:5px">
				
				<!-- selectable start -->
				

                <form name="form1" action="complexq.php" method="post" onsubmit="return validateFlightSearch()">
                <table id="albums">
                
                <tr>
                <td width="100px">Flight</td>
                <td width="200px"> 
                <input id="tripx_all" type="radio" name="tripx" value="0" checked="checked"> All Flights
                <input id="tripx_oneway" type="radio" name="tripx" value="1" onclick="EnableDisable(1)"> One way 
                <input id="tripx_return" type="radio" name="tripx" value="2" onclick="EnableDisable(2)"> Return
                </td>

                </tr>
                
                
                <tr>
                <td width="100px">From </td>
                <td width="150px"> 
                <input id="airo" class="easyui-combobox" name="airo"
                data-options="valueField:'id',textField:'airport',url:'data_get/get_origin_airports.php'">
                </td>
               
                <td width="100px">To </td>
                <td width="150px">
                <input id="aird" class="easyui-combobox" name="aird"
                data-options="valueField:'id',textField:'airport'">
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
                <input id="rfrom" name="rfrom" class="easyui-datebox">
                </td>
                <td width="100px">Return To </td>
                <td width="150px"> 
                <input id="rto" name="rto" class="easyui-datebox"  >
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
                    $results = getFlights($_POST["dfrom"], $_POST["dto"],(isset($_POST['rfrom'])  ? $_POST["rfrom"] : 1 ), (isset($_POST['rto'])  ? $_POST["rto"] : 1 ), $_POST["airo"], $_POST["aird"],$_POST["tripx"]);
                    
                    foreach ($results as $row) {
                    
                    echo "<li class=\"ui-widget-content\" id=\"".$row['flightid']."\">" . $row['flightcode']."</br>".$row['origin']."-->".$row['destination'] 
                          ."</br>Tourism:".$row['remainingsecond']." / ".$row['secondclassprice']."</br>Business: ".$row['remainingfirst']." / ".$row['firstclassprice']
                          ."</br>". $tripx[$row['tripx']]
                          ."</br><a href=\"javascript:void(0)\" class=\"easyui-linkbutton c6\" style=\"width:90px; height:22px;\" onclick=\"makeBookingButton(".$row['flightid'].");return false;\">Book Flight</a>"
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
                          ."</br><a href=\"javascript:void(0)\" class=\"easyui-linkbutton c6\" style=\"width:90px; height:22px;\" onclick=\"makeBookingButton(".$row['flightid'].");return false;\">Book Flight</a>"
//                          ."<a id=\"myLink\" href=\"javascript:void(0)\" onclick=\"makeBookingButton();return false;\">Book</a>"
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
        <script>
        
   
   $('#airo').combobox({
        valueField: 'id',
	textField: 'airport',
	
	onChange: function(row){
            var origin = $('#airo').combobox('getValue');
            $('#aird').combobox('reload', 'data_get/get_destination_airports.php?origin='+origin)

        
            
		
	}
})
        
        </script>
</body>
</html>