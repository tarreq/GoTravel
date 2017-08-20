<?php require "login/loginheader.php"; ?>

<!DOCTYPE html>

<html>
 

<head>
	<meta charset="UTF-8">
	<title>Complex Layout - jQuery EasyUI Demo</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../themes/color.css">
	<link rel="stylesheet" type="text/css" href="../demo.css">
	<script type="text/javascript" src="../../jquery.min.js"></script>
	<script type="text/javascript" src="../../jquery.easyui.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        

<!--	<script type="text/javascript">
		$(function(){
			$('#dg').edatagrid({
				url: 'get_flights.php',
				saveUrl: 'save_user.php',
				updateUrl: 'update_user.php',
				destroyUrl: 'destroy_user.php'
			});
		});
	</script>-->
	
	
</head>
<body>
	<h2>Charter Booking System v 1.0</h2>
	<p><?php echo "Logged as: " . $_SESSION['username']; ?>
        <a href="login/logout.php">Logout</a>
        </p>
	 
	<div style="margin:20px 0;"></div>
	<div class="easyui-layout" fit="true">
		<div data-options="region:'north'" style="height:50px"></div>
		<div data-options="region:'south',split:true" style="height:50px;"></div>
<!--		<div data-options="region:'east',split:true" title="East" style="width:180px;">
			<ul class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true,dnd:true"></ul>
		</div>-->
		<div data-options="region:'west',split:true" title="Admin" style="width:250px;">
			<div class="easyui-accordion" data-options="fit:true,border:false">
				<div title="Flights" style="padding:10px;">
					Flights
				</div>
				<div title="Bookings" data-options="selected:true" style="padding:10px;">
					Bookings
				</div>
				<div title="Users" style="padding:10px">
					Users
				</div>
			</div>
		</div>
		<div data-options="region:'center',title:'الرئيسية',iconCls:'icon-ok'">
			<div id="tt" class="easyui-tabs" data-options="fit:true,border:false,plain:true">
				<div title="الرحلات" style="padding:5px">
				
				<!-- Datagrid start -->
				

	<table id="ttg" fit="true"
            title="الرحلات" singleSelect="true" fitColumns="true" remoteSort="false"
            url="get_flights_test.php" pagination="true" sortOrder="desc" sortName="itemid">
		<thead>
			<tr>
				<th data-options="field:'flightcode',width:80">كود الرحلة</th>
				<th data-options="field:'flightdate',width:90">التاريخ</th>
                                <th data-options="field:'flighttime',width:80">الوقت</th>
				<th data-options="field:'origin',width:90">مطار الانطلاق</th>
                                <th data-options="field:'destination',width:90">مطار الوصول</th>
				<th data-options="field:'firstclassprice',width:120">سعر الدرجة اﻷولي</th>
                                <th data-options="field:'secondclassprice',width:120">سعر الدرجة الثانية</th>
				<th data-options="field:'remainingfirst',width:120">عدد مقاعد د.أولي</th>
                                <th data-options="field:'remainingsecond',width:120">عدد مقاعد د.ثانية</th>
                                <th data-options="field:'flightstatuscode',width:120">الحالة</th>
				
			</tr>
		</thead>
	</table>

	<div id="tb" style="height:auto">
            </br>
                <span>تاريخ من </span>
                <input id="dfrom"  class="easyui-datebox" required="required">

                <span>تاريخ إلي</span>
                <input id="dto"  class="easyui-datebox"  required="required">
                </br>
                
                <span>مطار المغادرة</span>
                <input id="airo" class="easyui-combobox" name="origin"
                data-options="valueField:'id',textField:'airportarabicname',url:'lookup.php?table=airport'">
                
                </br>
                
                <span>مطار الوصول</span>
                <input id="aird" class="easyui-combobox" name="destination"
                data-options="valueField:'id',textField:'airportarabicname',url:'lookup.php?table=airport'">
                
                </br>
                <span style="display:inline-block;width:300px;"></span>
                <a href="#" class="easyui-linkbutton c1" onclick="doSearch()">ابحث في الرحلات</a>
                
                </br>
                
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append()">Append</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit()">Remove</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept()">Accept</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject()">Reject</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="getChanges()">احجز</a>
	</div>
	
	<script type="text/javascript">
    
          //Start Card view code
        var cardview = $.extend({}, $.fn.datagrid.defaults.view, {
            renderRow: function(target, fields, frozen, rowIndex, rowData){
                var cc = [];
                cc.push('<td style="height:100;width:100px; padding:10px 5px;border:1;">');
                if (!frozen && rowData.flightid){
                    //var aa = rowData.itemid.split('-');
                    //var img = 'shirt' + aa[1] + '.gif';
                    //cc.push('<img src="images/' + img + '" style="width:150px;float:left">');
                    //cc.push('<div style="float:left;margin-left:20px; width:250px;">');
                    //for(var i=0; i<fields.length; i++){
                        //var copts = $(target).datagrid('getColumnOption', fields[i]);
                        //cc.push('<p><span class="c-label">' + copts.title + ':</span> ' + rowData[fields[i]] + '</p>');
                        cc.push('<center><div class="jumbotron"><h1>'+rowData.flightcode+'</h1><p>'+rowData.origin+ ' - '+rowData.destination+'</p>'+
                        '<p>'+rowData.flightdate+ ' - '+rowData.flighttime+'</p>'+
                        '<p><a class="btn btn-primary btn-lg" href="#" role="button">احجز</a></p></div></center>'
                                );
                        
                    //}
                    
                    //cc.push('</div>');
                }
                cc.push('</td>');
                return cc.join('');
            }
        });
        $(function(){
            $('#ttg').datagrid({
                view: cardview
            });
        });

        //End card view code
	</script>					
					<!-- Datagrid end -->
				</div>
			</div>
		</div>
	</div>
</body>
</html>