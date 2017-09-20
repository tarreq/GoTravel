<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Flights</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/material/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
	
        
<!--        Paste rendered grid code here-->

<br>
<h2>Current Flight Passengers</h2>
        <?php 
        require_once('../helper.php');
        ?>
        <h3>Flight: <?php echo getCurrentFlightCode(); ?> </h3>


<br>

<table>
    <tr>
        <td width="100px">
            Adults: <h3>  <?php echo getPassengerCountByAge(getCurrentFlightId(),12.1,100); ?></h3>
        </td>
        <td width="100px">
            Children: <h3>  <?php echo getPassengerCountByAge(getCurrentFlightId(),2.1,12); ?>  </h3>
        </td>
        <td width="100px">
            Infants: <h3>   <?php echo getPassengerCountByAge(getCurrentFlightId(),0,2); ?> </h3>
        </td>
        <td>
          <a href="javascript:void(0)" class="easyui-linkbutton c1" data-options="iconCls:'fa fa-money'" onclick='downloadCSV({ filename: <?php echo "\"". getCurrentFlightCode(). "_Flight_Passengers.xls\"" ?> });'>Export to Excel</a>  
        </td>
       
    </tr>
</table>

<br>
<br>
<table id="dg" class="easyui-datagrid" title="Current Flight Passengers" fit="true"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,
				url: 'get_current_flight_passengers.php',
				method: 'get'
			">
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
<br>


<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newEntry()">New </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editEntry()">Edit </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyEntry()">Delete </a>
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
                
                function convertArrayOfObjectsToCSV(args) {
        var result, ctr, keys, columnDelimiter, lineDelimiter, data;

        data = args.data || null;
        if (data == null || !data.length) {
            return null;
        }

        columnDelimiter = args.columnDelimiter || ',';
        lineDelimiter = args.lineDelimiter || '\n';

        keys = Object.keys(data[0]);

        result = '';
        result += keys.join(columnDelimiter);
        result += lineDelimiter;

        data.forEach(function(item) {
            ctr = 0;
            keys.forEach(function(key) {
                if (ctr > 0) result += columnDelimiter;

                result += item[key];
                ctr++;
            });
            result += lineDelimiter;
        });

        return result;
    }

    function downloadCSV(args) {
        var data, filename, link;

        var csv = convertArrayOfObjectsToCSV({
            data: $('#dg').datagrid('getRows')
        });
        if (csv == null) return;

        filename = args.filename || 'export.csv';

        if (!csv.match(/^data:text\/csv/i)) {
            csv = 'data:application/vnd.ms-excel;charset=utf-8,' + csv;
        }
        data = encodeURI(csv);

        link = document.createElement('a');
        link.setAttribute('href', data);
        link.setAttribute('download', filename);
        link.click();
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