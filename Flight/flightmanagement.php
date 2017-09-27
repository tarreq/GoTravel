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
			url="get_flights.php" fit="true"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" idField="cityid">
           <thead>
			<tr>
				<th data-options="field:'flightcode',width:80">Flight Code</th>
                                <th data-options="field:'id',width:80">route</th>
				<th data-options="field:'flightdate',width:90">Date</th>
                                <th data-options="field:'flighttime',width:80">Time</th>
				<th data-options="field:'origin',width:90">Origin Airport</th>
                                <th data-options="field:'destination',width:90">Destination Airport</th>
				<th data-options="field:'firstclassprice',width:120">Business Price</th>
                                <th data-options="field:'secondclassprice',width:120">Economy Price</th>
				<th data-options="field:'remainingfirst',width:120">Business Seats </th>
                                <th data-options="field:'remainingsecond',width:120">Economy Seats</th>
                                <th data-options="field:'flightstatuscode',width:120">Ststues</th>
                                
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
        <div class="ftitle">Flight</div>
        <form id="fm" method="post" novalidate>

            <div class="fitem">
                <label>Flight Code:</label>
                <input name="flightcode" id="flightcode" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Route:</label>
                <input id="id" class="easyui-combobox" name="id"
                       data-options="valueField:'id',textField:'routedesc',url:'get_routes_list.php'">
            </div>
            <div class="fitem">
                <label>Date:</label>
                <input name="flightdate" id="flightdate" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Time:</label>
                <input name="flighttime" id="flighttime" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Business price:</label>
                <input name="firstclassprice" id="firstclassprice" class="easyui-textbox" required="true">
            </div>	
            <div class="fitem">
                <label>Economy price:</label>
                <input name="secondclassprice" id="secondclassprice" class="easyui-textbox" required="true">
            </div>	
             <div class="fitem">
                <label>Jet ID:</label>
                <input id="jetid" class="easyui-combobox" name="jetid"
                       data-options="valueField:'jetid',textField:'jetcode',url:'../lookuptable.php?table=jet'">
            </div>
            <div class="fitem">
                <label>Flight Status:</label>
                <input id="flightstatusid" class="easyui-combobox" name="flightstatusid"
                       data-options="valueField:'flightstatusid',textField:'flightstatuscode',url:'../lookuptable.php?table=flightstatus'">
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
				$('#dlg').dialog('open').dialog('setTitle','Edit Flight');
				$('#fm').form('load',row);
				url = 'update_flight.php?flightid='+row.flightid;
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