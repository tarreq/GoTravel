/**
 * Created by tareq on 05.07.2017.
 */


//<script type="text/javascript">

    //Fetch Flights from DB depends on parameters
    function doSearch(){
        $radioval= document.querySelector('input[name="tripx"]:checked').value;
        $params = "get_flights.php?dfrom="+$('#dfrom').val()+"&dto="+$('#dto').val()+"&airo="+$('#airo').val()
            +"&aird="+$('#aird').val()+"&rfrom="+$('#rfrom').val()+"&rto="+$('#rto').val()+"&tripx="+$radioval;
        $('#ttg').datagrid('load',$params);
    }

// old grid functions start
var editIndex = undefined;
function endEditing(){
    if (editIndex == undefined){return true}
    if ($('#dg').datagrid('validateRow', editIndex)){
        $('#dg').datagrid('endEdit', editIndex);
        editIndex = undefined;
        return true;
    } else {
        return false;
    }
}
function onClickCell(index, field){
    if (editIndex != index){
        if (endEditing()){
            $('#dg').datagrid('selectRow', index)
                .datagrid('beginEdit', index);
            var ed = $('#dg').datagrid('getEditor', {index:index,field:field});
            if (ed){
                ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
            }
            editIndex = index;
        } else {
            setTimeout(function(){
                $('#dg').datagrid('selectRow', editIndex);
            },0);
        }
    }
}
function onEndEdit(index, row){
    var ed = $(this).datagrid('getEditor', {
        index: index,
        field: 'productid'
    });
    row.productname = $(ed.target).combobox('getText');
}
function append(){
    if (endEditing()){
        $('#dg').datagrid('appendRow',{status:'P'});
        editIndex = $('#dg').datagrid('getRows').length-1;
        $('#dg').datagrid('selectRow', editIndex)
            .datagrid('beginEdit', editIndex);
    }
}
function removeit(){
    if (editIndex == undefined){return}
    $('#dg').datagrid('cancelEdit', editIndex)
        .datagrid('deleteRow', editIndex);
    editIndex = undefined;
}
function accept(){
    if (endEditing()){
        $('#dg').datagrid('acceptChanges');
    }
}
function reject(){
    $('#dg').datagrid('rejectChanges');
    editIndex = undefined;
}
// old grid functions end

function makeBookingQ(){
//			var rows = $('#dg').datagrid('getChanges');
//			alert(rows.length+' rows are changed!');
    //var row = $('#ttg').datagrid('getSelected');
//                        if (row){
//                        alert('Item ID:'+row.flightid+"\nPrice:"+row.flightcode);
//                        }

var flights = document.getElementById('select-result');

fs = flights.innerHTML;
if (fs=="none")
{
    alert('Please select Flight!');
}

else {
    //add tab
    //addTab('حجز رحلة','bookingx.php?fid='+row.flightid+'&pax='+$('#pax').val()+'&cbclass='+$('#cbclass').val());
    addNewTab('Flight Booking','bookingx.php?fsid='+fs+'&pax='+$('#pax').val()+'&cbclass='+$('#cbclass').val());
    //alert(fs+'pax: '+$('#pax').val()+'class: '+'&cbclass='+$('#cbclass').val());
}
}

function makeBookingButton(fid){

    //add tab
    //addTab('حجز رحلة','bookingx.php?fid='+row.flightid+'&pax='+$('#pax').val()+'&cbclass='+$('#cbclass').val());
    addNewTab('Flight Booking','bookingx.php?fsid='+fid+'&pax='+$('#pax').val()+'&cbclass='+$('#cbclass').val());
    //alert(fs+'pax: '+$('#pax').val()+'class: '+'&cbclass='+$('#cbclass').val());

}

function openMyBookings(){



    //add tab
    //addTab('حجز رحلة','bookingx.php?fid='+row.flightid+'&pax='+$('#pax').val()+'&cbclass='+$('#cbclass').val());
    addStaticTab('My Bookings','mybookings.php');
    //alert(fs+'pax: '+$('#pax').val()+'class: '+'&cbclass='+$('#cbclass').val());

}

//helper method to create/ Open a Static tab, everytime you open URL with the tab name it will open the same 
//Tab and not a new one, if its already open, it will activate it
function addStaticTab(title, url){
    if ($('#tt').tabs('exists', title)){
        $('#tt').tabs('select', title);
    } else {
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
        $('#tt').tabs('add',{
            title:title,
            content:content,
            closable:true
        });
    }
}


//helper method to create a new tab, everytime you open URL with the tab name it will open a new 
//Tab with the same name provided
function addNewTab(title, url){
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
        $('#tt').tabs('add',{
            title:title,
            content:content,
            closable:true
        });
}

function validateForm() {
    if(document.getElementById('tripx').checked)
    
    
    var x = document.forms["form1"]["fname"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}

function validateFlightSearch(){
    
    var tripx= document.querySelector('input[name="tripx"]:checked').value;
    
    
    var dfrom = document.querySelector('input[name="dfrom"]').value;
    var dto = document.querySelector('input[name="dto"]').value;
    
    var rfrom = document.querySelector('input[name="rfrom"]').value;
    var rto = document.querySelector('input[name="rto"]').value;
    
    var airo = document.querySelector('input[name="airo"]').value;
    var aird = document.querySelector('input[name="aird"]').value;
    
        
    if (tripx == 1) {
        if (dfrom =="" || dto =="" || airo =="" || aird == "")
        {
        alert("Please fill dates and flight data for Oneway flight!");
        return false;
    }
    }
    
    if (tripx == 2) {
        if (dfrom =="" || dto =="" || airo =="" || aird == "" || rfrom =="" || rto == "")
        {
        alert("Please fill dates and flight data for Return flight!");
        return false;
    }
    }
    
    
    
}


function EnableDisable(tripx) {
      if (tripx==1){
      $('#rfrom').datebox('disable');
      $('#rto').datebox('disable');
                }
      if (tripx==2){
      $('#rfrom').datebox('enable');
      $('#rto').datebox('enable');
                }
  }
  
  
  