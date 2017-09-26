<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/material/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
	
	
	<table id="dg" title="Payments" class="easyui-datagrid" style="width:700px;height:250px"
			url="../lookuptable_join.php?table1=airport&table2=city&fk=cityid&pk=cityid" fit="true"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" idField="paymentid">
		<thead>
         <tr>
             <th data-options="field:'cityid',width:60,
                        formatter:function(value,row){
                            return row.citynameenglish;
                        }" width="50">cityid</th>
             
             <th field="airportcode" width="50">airportcode</th>
             <th field="airportarabicname" width="50">airportarabicname</th>
             <th field="airportenglishname" width="50">airportenglishname</th>
             
         </tr>
     </thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Add New</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Delete</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Payment Information</div>
		<form id="fm" method="post" novalidate>
                        <div class="fitem">
				<label>Airport Code:</label>
				<input name="airportcode" id="airportcode" class="easyui-textbox" required="true">
			</div>	
                        <div class="fitem">
				<label>Airport Arabic Name:</label>
				<input name="airportarabicname" id="airportarabicname" class="easyui-textbox" required="true">
			</div>	
			<div class="fitem">
				<label>Airport English Name:</label>
				<input name="airportenglishname" id="airportenglishname" class="easyui-textbox" required="true">
			</div>	
			<div class="fitem">
				<label>City:</label>
				<input id="cityid" class="easyui-combobox" name="cityid"
                data-options="valueField:'cityid',textField:'citynameenglish',url:'../lookuptable.php?table=city'">
			</div>
			
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Payment');
			$('#fm').form('clear');
			url = 'save_airport.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Airport');
				$('#fm').form('load',row);
				url = 'update_airport.php?id='+row.id;
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
				$.messager.confirm('Confirm','Are you sure you want to delete this Airport?',function(r){
					if (r){
						$.post('destroy_airport.php',{id:row.id},function(result){
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