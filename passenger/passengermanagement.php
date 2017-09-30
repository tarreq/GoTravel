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
	
	
	<table id="dg" title="Passengers" class="easyui-datagrid" style="width:700px;height:250px"
			url="get_passengers.php" fit="true"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" idField="bookingpassengerid">
           <thead>
			<tr>
				<th data-options="field:'bookingid',width:80">Booking ID</th>
				<th data-options="field:'fname',width:90">Name</th>
                                <th data-options="field:'lname',width:80">Surname</th>
				<th data-options="field:'phone',width:90">phone</th>
                                <th data-options="field:'email',width:90">Email</th>
				<th data-options="field:'nameenglish',width:120">Country</th>
                                <th data-options="field:'birthday',width:120">Birthday</th>
				<th data-options="field:'birthmonth',width:120">Birthmonth</th>
                                <th data-options="field:'birthyear',width:120">birthyear</th>
				
			</tr>
		</thead>
	</table>
    
    
	<div id="toolbar">
		
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Passenger</a>
		
	</div>
	
    <div id="dlg" class="easyui-dialog" style="width:400px;height:480px;padding:10px 20px"
         closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Passenger</div>
        <form id="fm" method="post" novalidate>

            <div class="fitem">
                <label>Name:</label>
                <input name="fname" id="fname" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Last Name:</label>
                <input name="lname" id="lname" class="easyui-textbox" required="true">
            </div>
            
            <div class="fitem">
                <label>Phone:</label>
                <input name="phone" id="phone" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>E-mail:</label>
                <input name="email" id="email" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Country:</label>
                <input id="countryid" class="easyui-combobox" name="countryid"
                       data-options="valueField:'id',textField:'nameenglish',url:'../lookuptable.php?table=country'">
            </div>
            <div class="fitem">
                <label>Birthday:</label>
                <input name="birthday" id="birthday" class="easyui-textbox" required="true">
            </div>	
             <div class="fitem">
                <label>Birth Month:</label>
                <input name="birthmonth" id="birthmonth" class="easyui-textbox" required="true">
            </div>
             <div class="fitem">
                <label>Birth Year:</label>
                <input name="birthyear" id="birthyear" class="easyui-textbox" required="true">
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
			$('#dlg').dialog('open').dialog('setTitle','New Flight');
			$('#fm').form('clear');
			url = 'save_flight.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Passenger');
				$('#fm').form('load',row);
				url = 'update_passenger.php?bookingpassengerid='+row.bookingpassengerid;
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
                                                $.messager.alert('Success','Passenger Updated');
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