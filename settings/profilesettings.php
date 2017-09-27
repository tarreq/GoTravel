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
	
	
	<table id="dg" title="Routes" class="easyui-datagrid" style="width:700px;height:250px"
			url="../lookuptable.php?table=members" fit="true"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" idField="id">
           <thead>
			<tr>
                                <th data-options="field:'username',width:80">Agent/User</th>	
                                <th data-options="field:'memberfirmname',width:80">Agent Company Name</th>
                                <th data-options="field:'memberfirmaddress',width:80">Agent Address</th>
				<th data-options="field:'email',width:90">E-mail</th>
                                <th data-options="field:'membercontactname',width:80">Contact Name</th>
				<th data-options="field:'memberphone',width:90">Phone</th>
                                
                                
			</tr>
		</thead>
	</table>
    
    
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Add New</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Delete</a>
	</div>
	
    <div id="dlg" class="easyui-dialog" style="width:400px;height:480px;padding:10px 20px"
         closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Profile</div>
        <form id="fm" method="post" novalidate>

            <div class="fitem">
                <label>Agent/Company name:</label>
                <input name="memberfirmname" id="memberfirmname" class="easyui-textbox" required="true">
            </div>	
           
            <div class="fitem">
                <label>Address:</label>
                <input name="memberfirmaddress" id="memberfirmaddress" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>E-mail:</label>
                <input name="email" id="email" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Contact Name:</label>
                <input name="membercontactname" id="membercontactname" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Contact Phone:</label>
                <input name="memberphone" id="memberphone" class="easyui-textbox" required="true">
            </div>	
            
        </form>
    </div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var url;
		
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Profile');
				$('#fm').form('load',row);
				url = 'update_profile.php?id='+row.id;
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
				$.messager.confirm('Confirm','Are you sure you want to delete this Flight?',function(r){
					if (r){
						$.post('destroy_flight.php',{flightid:row.flightid},function(result){
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