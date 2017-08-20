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
        <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.edatagrid.js"></script>
        
</head>
<body>
	<h2>My Bookings</h2>
	<p>Select a Bookin to see Passengers and details.</p>
	
	<table id="dg" title="My bookings" class="easyui-datagrid" style="width:950px;height:500px"
			rownumbers="true" fitColumns="true" singleSelect="true" >
		
	</table>

	<div id="toolbar">

		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Passenger</a>

	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">User Information</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>First Name:</label>
				<input name="fname" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Last Name:</label>
				<input name="lname" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Phone:</label>
				<input name="phone" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Email:</label>
				<input name="email" class="easyui-textbox" validType="email">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var conf = {
    options:{
        edatagrid:true,
        autoSave:true,
        autoUpdateDetail:false,
        fitColumns:true,
        columns:[[
            {field:'company',title:'Company Name',width:200,editor:'text'},
            {field:'contact',title:'Contact Name',width:200,editor:'text'},
            {field:'country',title:'Country',width:200,editor:'text'}
        ]],
        data:[
            {company:'Speed Info',contact:'Minna John',country:'Sweden'}
        ]
    },
    subgrid:{
        options:{
            edatagrid:true,
            autoSave:true,
            autoUpdateDetail:false,
            fitColumns:true,
            foreignField:'companyid',
            columns:[[
                {field:'orderdate',title:'Order Date',width:200,editor:'datebox'},
                {field:'shippeddate',title:'Shipped Date',width:200,editor:'datebox'},
                {field:'freight',title:'Freight',width:200,editor:'numberbox'}
            ]],
            data:[
                {orderdate:'08/23/2012',shippeddate:'12/25/2012',freight:9734}
            ]
        }
    }
};

$(function(){
    $('#dg').edatagrid({
        title:'DataGrid - Nested SubGrid',
        width:700,
        height:300
    }).datagrid('subgrid', conf);
});
               
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