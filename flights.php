<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Flights</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/material/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
	
        
<!--        Paste rendered grid code here-->
<table id="dg" class="easyui-datagrid" title="Flights" fit="true" toolbar="#toolbar" idField="flightid"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,
				url: 'get_flights_q.php',
				method: 'get'
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
                                
<!--				<th data-options="field:'cityid',width:100,
						formatter:function(value,row){
							return row.citynameenglish;
						},
						editor:{
							type:'combobox',
							options:{
								valueField:'cityid',
								textField:'citynameenglish',
								method:'get',
								url:'lookup.php/?table=city',
								required:true
							}
						}">city</th>-->
				
			</tr>
		</thead>
	</table>

<div id="toolbar">

            <span>Flight ID:</span>
            <input id="flightcode" style="line-height:26px;border:1px solid #ccc">
<!--            <span>Flight Code:</span>
            <input id="flightcode" style="line-height:26px;border:1px solid #ccc">-->
            <a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>	

	</div>
<br>
<!--<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newEntry()">New </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editEntry()">Edit </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyEntry()">Delete </a>
</div>-->
	
	
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Payment');
			$('#fm').form('clear');
			url = 'save_payment.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'update_user.php?id='+row.id;
			}
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('destroy_user.php',{id:row.id},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}
                
                //filter 
function doSearch(){
//    $('#dg').datagrid('load',{
//        flightcode: $('#flightcode').val()

//var flightcode = $('#flightcode').combobox('getValue');
$('#dg').datagrid('load', 'get_flights_q.php?flightcode='+$('#flightcode').val());
    //});
}
	</script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
		.fitem input{
			width:160px;
		}
	</style>
</body>
</html>