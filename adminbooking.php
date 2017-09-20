<!DOCTYPE html>
<html>
<head>
        
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
	<meta charset="UTF-8">
	
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
<body>
   <div title="Flights" style="padding:5px">
				
				<!-- selectable start -->
				

                                <form name="form1" action="adminbooking.php" method="post" onsubmit="return validateFlightSearch()">
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
                    <div id="select-result" >none</div>
                </p>
                
                <ul id="selectable">
                    <?php 
                    require "helper.php";
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