<?php require "login/loginheader.php"; ?>

<!DOCTYPE html>

<html>
 

<head>
	<meta charset="UTF-8">
	<title>Complex Layout - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../themes/color.css">
	<link rel="stylesheet" type="text/css" href="../demo.css">
	<script type="text/javascript" src="../../jquery.min.js"></script>
	<script type="text/javascript" src="../../jquery.easyui.min.js"></script>

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
					content1
				</div>
				<div title="Bookings" data-options="selected:true" style="padding:10px;">
					content2
				</div>
				<div title="Users" style="padding:10px">
					content3
				</div>
			</div>
		</div>
		<div data-options="region:'center',title:'الرئيسية',iconCls:'icon-ok'">
			<div id="tt" class="easyui-tabs" data-options="fit:true,border:false,plain:true">
				<div title="الرحلات" style="padding:5px">
				
				<!-- Datagrid start -->
				

	<table id="dg" class="easyui-datagrid" title="بحث" fit="true"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,
				toolbar: '#tb',
				url: 'get_flights.php',
				method: 'get',
				onClickCell: onClickCell,
				onEndEdit: onEndEdit
			">
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
            
            function doSearch(){
                $params = "get_flights.php?dfrom="+$('#dfrom').val()+"&dto="+$('#dto').val()+"&airo="+$('#airo').val()
                +"&aird="+$('#aird').val();
                $('#dg').datagrid('load',$params);
                }
                
                
		var editIndex = undefined;
		function endEditing(){
			if (editIndex == undefined){return true}
			if ($('#dg').datagrid('validateRow', editIndex)){
				$('#dg').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		function onClickCell(index, field){
			if (editIndex != index){
				if (endEditing()){
					$('#dg').datagrid('selectRow', index)
							.datagrid('beginEdit', index);
					var ed = $('#dg').datagrid('getEditor', {index:index,field:field});
					if (ed){
						($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
					}
					editIndex = index;
				} else {
					setTimeout(function(){
						$('#dg').datagrid('selectRow', editIndex);
					},0);
				}
			}
		}
		function onEndEdit(index, row){
			var ed = $(this).datagrid('getEditor', {
				index: index,
				field: 'productid'
			});
			row.productname = $(ed.target).combobox('getText');
		}
		function append(){
			if (endEditing()){
				$('#dg').datagrid('appendRow',{status:'P'});
				editIndex = $('#dg').datagrid('getRows').length-1;
				$('#dg').datagrid('selectRow', editIndex)
						.datagrid('beginEdit', editIndex);
			}
		}
		function removeit(){
			if (editIndex == undefined){return}
			$('#dg').datagrid('cancelEdit', editIndex)
					.datagrid('deleteRow', editIndex);
			editIndex = undefined;
		}
		function accept(){
			if (endEditing()){
				$('#dg').datagrid('acceptChanges');
			}
		}
		function reject(){
			$('#dg').datagrid('rejectChanges');
			editIndex = undefined;
		}
		function getChanges(){
//			var rows = $('#dg').datagrid('getChanges');
//			alert(rows.length+' rows are changed!');
                        var row = $('#dg').datagrid('getSelected');
//                        if (row){
//                        alert('Item ID:'+row.flightid+"\nPrice:"+row.flightcode);
//                        }
                        
                        //add tab
                        addTab('حجز رحلة','bookingx.php?fid='+row.flightid);
		}
                
                function addTab(title, url){
    if ($('#tt').tabs('exists', title)){
        $('#tt').tabs('select', title);
    } else {
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
        $('#tt').tabs('add',{
            title:title,
            content:content,
            closable:true
        });
    }
}
	</script>					
					<!-- Datagrid end -->
				</div>
			</div>
		</div>
	</div>
</body>
</html>
