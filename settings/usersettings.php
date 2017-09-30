
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
	
	
	
	
    
        <div class="ftitle">Settings</div>
        <form id="fm" method="post" novalidate>
<!--
            <div class="fitem">
                <label>Flight Code:</label>
                <input name="flightcode" id="flightcode" class="easyui-textbox" required="true">
            </div>	-->
            <div class="fitem">
                <label>Language:</label>
                <input id="languageid" class="easyui-combobox" name="languageid"
                       data-options="valueField:'languageid',textField:'languagename',url:'../lookuptable.php?table=language'">
            </div>
           
           
        </form>
    
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="updateSettings()" style="width:90px">Save</a>
		
<!--                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="loadRemote()">LoadRemote</a>-->
	</div>
	<script type="text/javascript">
            
             $('#fm').form('load', 'get_user_settings.php');
             
//             function loadRemote(){
//			$('#fm').form('load', 'get_user_settings.php');
//		}
            
		var url= 'update_settings.php';
                
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New Flight');
			$('#fm').form('clear');
			url = 'save_flight.php';
		}
	
		function updateSettings(){
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
						$.messager.alert('Success','Settings Updated');
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