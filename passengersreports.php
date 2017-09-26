<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Passengers</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/material/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="datagrid-filter.js"></script>
</head>
<body>
	
        
<!--        Paste rendered grid code here-->
<table id="dg" class="easyui-datagrid" title="Flights" fit="true"
			data-options="
				url: 'get_passengers_q.php'">
		<thead>
			<tr>
				<th data-options="field:'bookingid',width:80">Booking ID</th>
				<th data-options="field:'fname',width:90">Name</th>
                                <th data-options="field:'lname',width:80">Surname</th>
				<th data-options="field:'phone',width:90">phone</th>
                                <th data-options="field:'email',width:90">Email</th>
				<th data-options="field:'countryid',width:120">Country</th>
                                <th data-options="field:'birthday',width:120">Birthday</th>
				<th data-options="field:'birthmonth',width:120">Birthmonth</th>
                                <th data-options="field:'birthyear',width:120">birthyear</th>
                                
                                
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
<br>
<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newEntry()">New </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editEntry()">Edit </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyEntry()">Delete </a>
</div>
	
	
	<script type="text/javascript">
                 
                 
                 $(function(){
            var dg = $('#dg').datagrid();
            dg.datagrid('enableFilter');
            dg.datagrid('doFilter');
        });
            
            
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