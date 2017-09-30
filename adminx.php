<?php 
require "login/loginheader.php"; 
require_once 'helper.php';
require_once 'common_lang.php';

?>

<!DOCTYPE html>

<html>
 

<head>
	<meta charset="UTF-8">
	<title><?php echo $lang['PAGE_TITLE']; ?></title>
        <!-- Latest compiled and minified CSS -->
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/all-themes.css">
        <link rel="stylesheet" type="text/css" href="css/custom_style.css">
        <link rel="stylesheet" type="text/css" href="css/waves.css">
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrapc.css">
        

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../themes/material/easyui.css">
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
<body style="background-color:#f2f2f2">
    
    <table>
        <tr>
            <td style="padding: 5px 10px 0px 5px;width:20%;">
                <img src="Images/go_travel_logo.gif"  height="90px">
            </td>
        <td style="padding: 5px 10px 0px 5px;width:75%;">
        <div id="userinfo" style="text-align: right;">
	
	<p><?php  echo $lang['LOGGED_AS_TITLE'].": " . $_SESSION['username'] ."<br />".$lang['USER_CREDIT_TITLE'].": ".getCredit(getUserId($_SESSION['username'])); ?>
        </br>
        <a href="login/logout.php"><?php echo $lang['LOGOUT_TITLE']; ?></a>
        
        </p>
        </div>
        </td>
        <td style="padding: 5px 10px 0px 5px;width:5%;"><img src="Images/profile_photo_1.png"  height="65px">
        </td>
        </tr>
    </table>
	 
<!--	<div style="margin:20px 0;"></div>-->
	<div class="easyui-layout" fit="true">
<!--		<div data-options="region:'north'" style="height:20px"></div>-->
<!--		<div data-options="region:'south',split:true" style="height:50px;"></div>-->
<!--		<div data-options="region:'east',split:true" title="East" style="width:180px;">
			<ul class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true,dnd:true"></ul>
		</div>-->
		<div data-options="region:'west',split:true" title="<?php echo $lang['admin_dashboard_title']; ?>" style="width:250px;">
			<div class="easyui-accordion" data-options="border:false">
<!--				<div title="Flights" style="padding:10px;">
					content1
				</div>-->
                                <div title="<?php echo $lang['current_flight_menu_title']; ?>" style="padding:10px;">
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-money',plain:true" onclick="addStaticTab('Current Flight Passengers','currentflight/flightpassengers.php')"><?php echo $lang['current_flight_menu_passengers_data']; ?></a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-money',plain:true" onclick="addStaticTab('Current Flight Payments','currentflight/flightpayment.php')"><?php echo $lang['current_flight_menu_payments']; ?></a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-money',plain:true" onclick="addStaticTab('Current Flight Bookings','currentflight/flightbookings.php')"><?php echo $lang['current_flight_menu_bookings']; ?></a>
<!--                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-money',plain:true" onclick="addStaticTab('Current Flight Reports','currentflight/flightreports.php')"><?php echo $lang['current_flight_menu_Reports']; ?></a>-->
				</div>
                                <div title="<?php echo $lang['payments_menu_title']; ?>" style="padding:10px;">
                                        
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-money',plain:true" onclick="addStaticTab('Payments','payment/payment.php')"><?php echo $lang['payments_menu_item_all_payments']; ?></a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-money',plain:true" onclick="addStaticTab('Payments','payment/paymentreports.php')"><?php echo $lang['payments_menu_item_payment_reports']; ?></a>
				</div>
                                <div title="Bookings" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="addStaticTab('All Bookings','mybookings/mybookingsall.php')">All Bookings</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="addStaticTab('Book a ticket','adminbooking.php')">Book a ticket</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="addStaticTab('Cancel Booking','mybookings/mybookingscancel.php')">Cancel a booking</a>
                                        
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-hand-pointer-o',plain:true" onclick="addStaticTab('Booking Query','mybookings/mybookings.php')">Booking Query</a>
				</div>
                                    <div title="Flights" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-users',plain:true" onclick="addStaticTab('All Flights','flights.php')">All Flights</a>
                                        <br>
                                        
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-plane',plain:true" onclick="addStaticTab('Flights Reports','flightsreports.php')">Flights Reports</a>
				</div>
                                <div title="Passengers" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-users',plain:true" onclick="addStaticTab('Passengers','passenger/passengermanagement.php')">All Passengers</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-users',plain:true" onclick="addStaticTab('Passengers','passenger/passengersreports.php')">Passengers Reports</a>
				</div>

				
                                <div title="Flights Setup" style="padding:10px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-plane',plain:true" onclick="addStaticTab('Flights Management','flight/flightmanagement.php')">Flights</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-flag',plain:true" onclick="addStaticTab('Airports Management','airport/airportmanagement.php')">Airports</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-road',plain:true" onclick="addStaticTab('Routes Management','route/routemanagement.php')">Routes</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-home',plain:true" onclick="addStaticTab('Cities Management','cities/citymanagement.php')">Cities</a>
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
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Agent Contact</a>
                                        <br>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Direct Messeges</a>
				</div>
                                <div title="Help" style="padding:10px;">
					
                                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Help</a>
                                        <br>
                                         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-envelope-o',plain:true" onclick="">Support</a>
                                       
                                       
                                      
				</div>
                                    
                                
<!--				<div title="Users" style="padding:10px">
					content3
				</div>-->
			</div>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'" style="background-color:#f2f2f2;">
			<div id="tt" class="easyui-tabs" data-options="fit:true,border:false,plain:true">
				<div title="Dashboard" style="padding:5px;background-color:#f2f2f2;">
				
                                    <table id="dashtable" >
                                        <tr>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-red">
                                                    <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Total Credit</span>
                                                        <span class="info-box-number"> <?php echo getTotalCredit()." USD"; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Total users credit 
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-green">
                                                    <span class="info-box-icon"><i class="fa fa-plane"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Last Flight Seats</span>
                                                        <span class="info-box-number"><?php echo getLastFlightSeats()['remainingsecond']."/".getLastFlightSeats()['secondclassseats']." - ".getLastFlightSeats()['remainingfirst']."/".getLastFlightSeats()['firstclassseats']; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            <?php echo getLastFlightSeats()['flightcode']; ?>
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-yellow">
                                                    <span class="info-box-icon"><i class="fa fa-usd"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Last Payment</span>
                                                        <span class="info-box-number"><?php echo getLastPayment()['paymentusdamount']; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            <?php echo getLastPayment()['username']; ?>
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <!-- weather widget start --><div id="m-booked-bl-simple-30361"> <div class="booked-wzs-160-110 weather-customize" style="background-color:#11b6c2;width:250px;" id="width3"> <div class="booked-wzs-160-110_in"> <a target="_blank" class="booked-wzs-top-160-110" href="http://www.booked.net/"><img src="//s.bookcdn.com/images/letter/s5.gif" alt="booked.net" /></a> <div class="booked-wzs-160-data"> <div class="booked-wzs-160-left-img wrz-01"></div> <div class="booked-wzs-160-right"> <div class="booked-wzs-day-deck"> <div class="booked-wzs-day-val"> <div class="booked-wzs-day-number"><span class="plus">+</span>28</div> <div class="booked-wzs-day-dergee"> <div class="booked-wzs-day-dergee-val">&deg;</div> <div class="booked-wzs-day-dergee-name">C</div> </div> </div> <div class="booked-wzs-day"> <div class="booked-wzs-day-d"><span class="plus">+</span>28&deg;</div> <div class="booked-wzs-day-n"><span class="plus">+</span>23&deg;</div> </div> </div> <div class="booked-wzs-160-info"> <div class="booked-wzs-160-city">Istanbul</div> <div class="booked-wzs-160-date">Friday, 21</div> </div> </div> </div> <a target="_blank" href="http://hotelmix.co.uk/weather/istanbul-18319" class="booked-wzs-bottom-160-110"> <div class="booked-wzs-center"><span class="booked-wzs-bottom-l"> See 7-Day Forecast</span></div> </a> </div> </div> </div><script type="text/javascript"> var css_file=document.createElement("link"); css_file.setAttribute("rel","stylesheet"); css_file.setAttribute("type","text/css"); css_file.setAttribute("href",'https://s.bookcdn.com/css/w/booked-wzs-widget-160.css?v=0.0.1'); document.getElementsByTagName("head")[0].appendChild(css_file); function setWidgetData(data) { if(typeof(data) != 'undefined' && data.results.length > 0) { for(var i = 0; i < data.results.length; ++i) { var objMainBlock = document.getElementById('m-booked-bl-simple-30361'); if(objMainBlock !== null) { var copyBlock = document.getElementById('m-bookew-weather-copy-'+data.results[i].widget_type); objMainBlock.innerHTML = data.results[i].html_code; if(copyBlock !== null) objMainBlock.appendChild(copyBlock); } } } else { alert('data=undefined||data.results is empty'); } } </script> <script type="text/javascript" charset="UTF-8" src="https://widgets.booked.net/weather/info?action=get_weather_info&ver=6&cityID=18319&type=1&scode=124&ltid=3458&domid=579&anc_id=67358&cmetric=1&wlangID=1&color=11b6c2&wwidth=250&header_color=ffffff&text_color=333333&link_color=08488D&border_form=1&footer_color=ffffff&footer_text_color=333333&transparent=0"></script><!-- weather widget end -->
                                            </td>
                                        </tr>
                                                                                <tr>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-blue">
                                                    <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Currency Rate</span>
                                                        <span class="info-box-number"><?php echo "1 USD= ".  /*convertCurrency(1, "USD", "SAR").*/ " SAR"; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Current USD rate 
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-yellow">
                                                    <span class="info-box-icon"><i class="fa fa-plane"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Last Flight Seats</span>
                                                        <span class="info-box-number"><?php echo getLastFlightSeats()['remainingsecond']."/".getLastFlightSeats()['secondclassseats']." - ".getLastFlightSeats()['remainingfirst']."/".getLastFlightSeats()['firstclassseats']; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            <?php echo getLastFlightSeats()['flightcode']; ?>
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-aqua">
                                                    <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Total Credit</span>
                                                        <span class="info-box-number"> <?php echo getTotalCredit()." USD"; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Total users credit 
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-red">
                                                    <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Total Credit</span>
                                                        <span class="info-box-number"> <?php echo getTotalCredit()." USD"; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Total users credit 
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left: 30px;">
                                                
<!--                                                <table id="dg" title="Payments" class="easyui-datagrid"
                                                       url="payment/get_payments.php"
                                                       pagination="true" fit="true"
                                                       rownumbers="true" singleSelect="true">
                                                    <thead>
                                                        <tr>
                                                            <th data-options="field:'adminid',
                                                                formatter:function(value,row){
                                                                return row.adminuser;
                                                                }">Added By</th>
                                                            <th data-options="field:'agentid',
                                                                formatter:function(value,row){
                                                                return row.agentuser;
                                                                }">Agent name</th>
                                                            <th field="paymenttime">Time</th>
                                                            <th field="paymentamount">Paid Amount</th>
                                                            <th field="paymentcurrencyid">Currency</th>
                                                            <th field="paymentusdamount">USD Amount</th>
                                                        </tr>
                                                    </thead>
                                                </table>-->
                                                <div class="box" style="height: 180px;overflow-y: scroll;">
                                                    <div class="box-header">
                                                        <h3 class="box-title">Agents Payments</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body no-padding">
                                                        <table class="table table-striped">
                                                            <tbody><tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Added By</th>
                                                                    <th>Agent</th>
                                                                    <th style="width: 40px">Amount</th>
                                                                </tr>
                                                                <?php
                                                                $result = lookUpTable("payment");

                                                                //loop through column array
                                                                for ($x = 0; $x < count($result); $x++) {
                                                                    echo "<tr>
                  <td>" . ($x + 1) . "</td><td>" .getUserName($result[$x]['adminid']). "</td>
                  <td>" .getUserName($result[$x]['agentid']). "</td>
                    
                  
                  <td><span class=\"badge bg-red\">" . $result[$x]['paymentusdamount'] . " $</span></td>
                </tr>";
                                                                }
                                                                ?>
                                                            </tbody></table>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                
                                                
                                            </td>
                                            <td colspan="2" style="padding-left: 30px;">
                                                
                                                <div class="box" style="height: 180px;overflow-y: scroll;">
                                                    <div class="box-header">
                                                        <h3 class="box-title">Agents Credit</h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body no-padding">
                                                        <table class="table table-striped">
                                                            <tbody><tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Agent</th>
                                                                    <th>Percentage</th>
                                                                    <th style="width: 40px">Credit</th>
                                                                </tr>
                                                                <?php
                                                                $result = lookupTable("members");

                                                                //loop through column array
                                                                for ($x = 0; $x < count($result); $x++) {
                                                                    echo "<tr>
                  <td>" . ($x + 1) . "</td><td>" . $result[$x]['username'] . "</td>
                  <td>
                    <div class=\"progress progress-xs progress-striped active\">
                      <div class=\"progress-bar progress-bar-success\" style=\"width: " . ( floor($result[$x]['membercredit'] / 1000) ) . "%\"></div>
                    </div>
                  </td>
                  <td><span class=\"badge bg-green\">" . $result[$x]['membercredit'] . " $</span></td>
                </tr>";
                                                                }
                                                                ?>
                                                            </tbody></table>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left: 30px;">
                                                <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Upcoming Flights
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            
                <div class="box-body no-padding">
                                                        <table class="table table-striped">
                                                            <tbody><tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Code</th>
                                                                    <th>Date</th>
                                                                    <th style="width: 40px">Fare</th>
                                                                </tr>
                                                                <?php
                                                                $result = lookUpTableWhere("flight","flightdate",">=", "2017-09-29",5);

                                                                //loop through column array
                                                                for ($x = 0; $x < count($result); $x++) {
                                                                    echo "<tr>
                  <td>" . ($x + 1) . "</td><td>" .$result[$x]['flightcode'] . "</td>
                  <td>"
                    .$result[$x]['flightdate'].
                  "</td>
                  <td><span class=\"badge bg-red\">" . $result[$x]['firstclassprice'] . " $</span></td>
                </tr>";
                                                                }
                                                                ?>
                                                            </tbody></table>
                                                    </div>
                        </div>
                    </div>
                                            </td>
                                            <td colspan="2" style="padding-left: 30px;">
                                                <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?php echo "Flight ". getCurrentFlightCode(). " last bookings"; ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                             <div class="box-body no-padding">
                                                        <table class="table table-striped">
                                                            <tbody><tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Agent</th>
                                                                    <th>Booking No.</th>
                                                                    <th style="width: 40px">Fare</th>
                                                                </tr>
                                                                <?php
                                                                $result = lookUpTableWhere("booking","flightid","=", getCurrentFlightId(),5);

                                                                //loop through column array
                                                                for ($x = 0; $x < count($result); $x++) {
                                                                    echo "<tr>
                  <td>" . ($x + 1) . "</td><td>" .getUserName($result[$x]['memberid']) . "</td>
                  <td>"
                    .$result[$x]['bookingid'].
                  "</td>
                  <td><span class=\"badge bg-green\">" . $result[$x]['totalfare'] . " $</span></td>
                </tr>";
                                                                }
                                                                ?>
                                                            </tbody></table>
                                                    </div>
                        </div>
                    </div>
                                            </td>
                                        </tr>
                                    </table>
			</div>
		</div>
	</div>
</body>
</html>