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
    
    <div id="filterdiv">
        
        <br>
        <h2>Select filters to apply to flights:</h2>
        <br>
        <br>
        
        <form id="paymentreportsform" method="post" action="flightsreports.php.php"> 
        <table>
            <tr>
                <td>From:</td><td><input id="originairportid" class="easyui-combobox" name="originairportid"
                data-options="valueField:'id',textField:'airportcode',url:'lookuptable.php?table=airport'"></td>
                <td>To:</td><td><input id="destinationairportid" class="easyui-combobox" name="destinationairportid"
                data-options="valueField:'id',textField:'airportcode',url:'lookuptable.php?table=airport'"></td>
                
            </tr>
            <tr>
                <td width="100px">Departure </td>
                <td width="150px"> 
                <input id="ddate" name="ddate" class="easyui-datebox" data-options="label:'Select Date:',labelPosition:'top',onSelect:onSelect">
                </td>
                <td width="100px">Return</td>
                <td width="150px"> 
                <input id="rdate" name="rdate" class="easyui-datebox" data-options="label:'Select Date:',labelPosition:'top',onSelect:onSelect">
                </td>
            </tr>
            <tr>
                <td width="60px">
<!--            <div style="color:#ed0202;">
                <h2>Total: <span id="PaymentTotalSpan"></span></h2>
                
            </div>-->
            </td>
            <td>
<!--<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'fa fa-money',plain:true" onclick='downloadCSV({ filename: "stock-data.xls" });'>Export XLS</a>-->
            </td>
            </tr>
            
            
        </table>
        </form>
        
    </div>
    	
	
	<table id="dg" title="Payments Reports" class="easyui-datagrid" style="width:700px;height:250px"
			fit="true" url="get_flights_reports.php"
			toolbar="#toolbar" pagination="true" showFooter="true"
			rownumbers="true" fitColumns="true" singleSelect="true" idField="flightid">
		<thead>
			<tr>
				
                                <th field="flightcode" width="110">fligh code</th>
				<th field="flightdate" width="50">flight date</th>
				<th field="origin" width="50">from</th>
                                <th field="destination" width="50">to</th>
                                <th field="flighttime" width="110">flight time</th>
				<th field="firstclassprice" width="50">Business Price</th>
				<th field="secondclassprice" width="50">Economy price</th>
                                <th field="remainingfirst" width="50">Available Business</th>
                                <th field="remainingsecond" width="50">Available Economy</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
<!--		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New Payment</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Payment</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Delete Payment</a>-->
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

      
   //function on dates select
    function onSelect(){
        
        var originairportid = $('#originairportid').combobox('getValue');
        var destinationairportid = $('#destinationairportid').combobox('getValue');
        var newpfrom = '';
        var newpto = '';
        
        var datevalf = $('#ddate').datebox('getValue');
        var datevalt = ($('#rdate').datebox('getValue'));
        
        
        
        if(datevalf.indexOf("/")> 0)
            {
                var parts1 = datevalf.split("/");
                newpfrom = parts1[2] + '-' + parts1[0] + '-' + parts1[1];
            }
            
        if(datevalt.indexOf("/")> 0)
            {
                var parts2 = datevalt.split("/");
                newpto = parts2[2] + '-' + parts2[0] + '-' + parts2[1];
            }
        
        
        
//        var parts2 = datevalt.split("/");
//         newpto = parts2[2] + '-' + parts2[0] + '-' + parts2[1];
        
        $('#dg').datagrid('load', 'get_flights_reports.php?originairportid='+originairportid+'&destinationairportid='+destinationairportid+'&ddate='+newpfrom+'&rdate='+newpto);
        }
        
   
   $('#originairportid').combobox({
        	
	onChange: function(row){
            onSelect();

               }
               
       })
       
       
       $('#destinationairportid').combobox({
        onChange: function(row){
            onSelect();

               }
               
       })
       
           
        $('#dg').datagrid({
	onLoadSuccess:function(data) {
        
        var data = $('#dg').datagrid('getData');
        var rows = data.rows;
        var sum = 0;
 
        for (i=0; i < rows.length; i++) {
        sum+= parseInt(rows[i].paymentusdamount);
        }
	
	$('#PaymentTotalSpan').text(sum);
        $('#dg').datagrid('reloadFooter', [{paymentcurrencyid:'Total',paymentusdamount:sum}]);
          
	}
    })
    
        //grid sum
        function somma () {
  var data = $('#dg').datagrid('getData');
  var rows = data.rows;
  var sum = 0;
 
  for (i=0; i < rows.length; i++) {
        sum+= parseInt(rows[i].paymentusdamount);
  }
	 
  // just to show if the sum is OK
 alert('sum=' + sum);
 $('#sumtext').textbox('setText', sum);
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