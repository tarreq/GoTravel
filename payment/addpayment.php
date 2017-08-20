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
			url="get_payments.php" fit="true"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" idField="paymentid">
		<thead>
			<tr>
				<th data-options="field:'adminid',width:60,
                        formatter:function(value,row){
                            return row.adminuser;
                        }">Added By</th>
				<th data-options="field:'agentid',width:60,
                        formatter:function(value,row){
                            return row.agentuser;
                        }">Agent name</th>
                                <th field="paymenttime" width="110">Time</th>
				<th field="paymentamount" width="50">Paid Amount</th>
				<th field="paymentcurrencyid" width="50">Currency</th>
                                <th field="paymentusdamount" width="50">USD Amount</th>
			</tr>
		</thead>
	</table>
<!--	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New Payment</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Payment</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Delete Payment</a>
	</div>-->
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			buttons="#dlg-buttons">
		<div class="ftitle">Payment Information</div>
                <form id="fm" method="post" novalidate action="save_payment.php">
			<div class="fitem">
				<label>Agent: </label>
<!--				<input name="agentid" class="easyui-textbox" required="true">-->
                                <input id="agentid" class="easyui-combobox" name="agentid"
                data-options="valueField:'id',textField:'username',url:'../lookuptable.php?table=members'">
			</div>
			<div class="fitem">
				<label>Paid Amount:</label>
				<input name="paymentamount" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Currency:</label>
				<input id="paymentcurrencyid" class="easyui-combobox" name="paymentcurrencyid"
                data-options="valueField:'currencyid',textField:'currencyname',url:'../lookuptable.php?table=currency'">
			</div>
			<div class="fitem">
				<label>Payment USD Amount:</label>
				<input name="paymentusdamount" class="easyui-textbox" required="true">
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
				$.messager.confirm('Confirm','Are you sure you want to delete this payment?',function(r){
					if (r){
						$.post('destroy_payment.php',{id:row.paymentid},function(result){
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