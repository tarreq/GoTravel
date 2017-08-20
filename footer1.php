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
    
      	
	
	<table id="tt" title="DataGrid" class="easyui-datagrid" style="width:400px;height:250px"
        url="datagrid17_data.json"
        fitColumns="true" rownumbers="true" showFooter="true">
    <thead>
        <tr>
            <th field="name" width="80">Product Name</th>
            <th field="price" width="40" align="right">Unit Price</th>
        </tr>
    </thead>
</table>

    
	
	
</body>
</html>