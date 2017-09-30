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
	<h2>My Bookings</h2>
	<p>Select a Bookin to see Passengers and details.</p>
	
	<table id="dg" title="My bookings" class="easyui-datagrid" style="width:1050px;height:500px"
			url="get_bookings.php" 
			toolbar="#toolbar" pagination="true"
			fitColumns="true" singleSelect="true" idField="bookingid">
<!--		<thead>
			<tr>
				<th field="bookingid" width="35">Booking ID</th>
                                <th field="bookingtime" width="90">Booking Time</th>
				<th field="outflight" width="50">Outbound</th>
                                <th field="inflight" width="40">Inbound</th>
				<th field="tickettypename" width="35">Class</th>
				<th field="totalfare" width="30">Fare</th>
                                <th field="firstclassseats" width="55">First class Seats</th>
                                <th field="secondclassseats" width="55">Second class Seats</th>
			</tr>
		</thead>-->
	</table>

	<div id="toolbar">

            
            
            <span>Booknig ID:</span>
            
            <input id="bookingid" style="line-height:26px;border:1px solid #ccc">
<!--            <span>Flight Code:</span>
            <input id="flightcode" style="line-height:26px;border:1px solid #ccc">-->
            <a href="javascript:void(0)" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>	
            <br>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="requestCancel()">Request Cancel</a>

	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:380px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Request Cancellation</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
                <label>State:</label>
                <input id="bookingstateid" class="easyui-combobox" name="bookingstateid"
                       data-options="valueField:'bookingstateid',textField:'statename',url:'../lookuptable.php?table=bookingstate'">
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
			$('#dlg').dialog('open').dialog('setTitle','New User');
			$('#fm').form('clear');
			url = 'save_user.php';
		}
		
                 function requestCancel(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Request Cancel');
				$('#fm').form('load',row);
				url = 'booking_request_cancel.php?bookingid='+row.bookingid;
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
		function destroyBooking(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to cancel this booking?',function(r){
					if (r){
						$.post('destroy_booking.php',{id:row.bookingid},function(result){
							if (result.success){
                                                                 $.messager.alert('Confirm','Booking Cancelled Successfully !');
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
                
                
                //master detail code start
                $('#dg').datagrid({
                columns:[[
                {field:'bookingid',title:'booking ID',width:100},
                {field:'bookingtime',title:'Booking Time',width:100},
                {field:'outflight',title:'out flight',width:100},
                {field:'in flight',title:'in flight',width:100},
                {field:'tickettypename',title:'Class',width:100},
                {field:'totalfare',title:'Fare',width:100},
                {field:'firstclassseats',title:'Business',width:100},
                {field:'secondclassseats',title:'Economy',width:100},
                {field: 'action', title: 'Cancel'
//                    ,
//                formatter:function(value,row,index)
//                {
//		var s = '<button onclick="destroyBooking()">Cancel Booking</button>';
//		return s;
//        	}
                } 
                ]],
    view: detailview,
    detailFormatter:function(index,row){
        return '<div style="padding:2px"><table class="ddv"></table></div>';
    },
    onExpandRow: function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
        ddv.datagrid({
            url:'get_booking_passengers.php?bookingid='+row.bookingid,
            edatagrid:true,
            autoSave:true,
            fitColumns:true,
            singleSelect:true,
            rownumbers:true,
            loadMsg:'',
            height:'auto',
            columns:[[
                {field:'fname',title:'First Name',width:100},
                {field:'lname',title:'Last Name',width:100},
                {field:'phone',title:'Phone',width:100},
                {field:'email',title:'E-mail',width:100},
                {field:'birthday',title:'Birthday',width:100},
                {field:'birthmonth',title:'Birth Month',width:100},
                {field:'birthyear',title:'Birth Year',width:100},
                {field:'countryid',title:'Country',width:100},
                {field: 'action', title: 'Edit',
                formatter:function(value,row,index)
                {
		var s = '<button onclick="editRecord(this)">Edit</button><a href="../bookprintx.php?bid='+row.bookingid+'">Print</a>';
		return s;
        	}
                }                  
            ]],
            onResize:function(){
                $('#dg').datagrid('fixDetailRowHeight',index);
            },
            onLoadSuccess:function(){
                setTimeout(function(){
                    $('#dg').datagrid('fixDetailRowHeight',index);
                },0);
            }
        });
        $('#dg').datagrid('fixDetailRowHeight',index);
    }
});

function editRecord(btn){
	var tr = $(btn).closest('tr.datagrid-row');
	var index = parseInt(tr.attr('datagrid-row-index'));
	var dg = tr.closest('div.datagrid-view').children('table');
	var row = dg.datagrid('getRows')[index];
	console.log(row['bookingpassengerid'])
        
        //open edit form
        if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'update_user.php?id='+row.bookingpassengerid;
			}
        
        
}

function confirmBookingDelete(btn){
            $.messager.confirm('Booking Delete', 'Are you sure you want to cancel booking?', function(r){
                if (r){
                    //
                //alert('confirmed: '+row.bookingid);
                //if confirmed , call deleteBooking function
                deleteBooking(btn);
                }
            });
        }

function deleteBooking(btn){
	var tr = $(btn).closest('tr.datagrid-row');
	var index = parseInt(tr.attr('datagrid-row-index'));
	var dg = tr.closest('div.datagrid-view').children('table');
	var row = dg.datagrid('getRows')[index];
	console.log(row['bookingid'])
        
        //open edit form
        if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'update_user.php?id='+row.bookingpassengerid;
			}
        
        
}

function doSearch(){
    $('#dg').datagrid('load',{
        bookingid: $('#bookingid').val()
//        ,flightcode: $('#flightcode').val()
    });
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