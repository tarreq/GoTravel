<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
</head>
<body>
	<h2>My Credit</h2>
	<p>Creadit Transactions Details.</p>
	
	<table id="dg" title="Transactions" class="easyui-datagrid" style="width:950px;height:500px"
			url="get_agent_credit.php" 
			pagination="true" fitColumns="true" singleSelect="true" idField="paymentid">
		<thead>
			<tr>
				<th field="paymenttime" width="35">Payment Time</th>
                                <th field="addedby" width="90">Added By</th>
				<th field="paymentamount" width="50">Payment Amount</th>
                                <th field="currencyname" width="40">Payment Currecy</th>
				<th field="paymentusdamount" width="35">Payment USD Amount</th>
				
			</tr>
		</thead>
	</table>

	<div id="toolbar">

            <span>Booknig ID:</span>
            <input id="bookingid" style="line-height:26px;border:1px solid #ccc">
<!--            <span>Flight Code:</span>
            <input id="flightcode" style="line-height:26px;border:1px solid #ccc">-->
            <a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>	

	</div>
	

	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New User');
			$('#fm').form('clear');
			url = 'save_user.php';
		}
		function editUser(){
                    
                        //tq get selected
                        var tr = $(btn).closest('tr.datagrid-row');
                        var index = parseInt(tr.attr('datagrid-row-index'));
                        var dg = tr.closest('div.datagrid-view').children('table');
                        var row = dg.datagrid('getRows')[index];
                        
                        if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'mybookings/update_user.php?id='+row.bookingpassengerid;
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