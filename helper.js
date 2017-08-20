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
function makeBooking(){
//			var rows = $('#dg').datagrid('getChanges');
//			alert(rows.length+' rows are changed!');
    var row = $('#ttg').datagrid('getSelected');
//                        if (row){
//                        alert('Item ID:'+row.flightid+"\nPrice:"+row.flightcode);
//                        }

    //add tab
    addTab('حجز رحلة','bookingx.php?fid='+row.flightid+'&pax='+$('#pax').val()+'&cbclass='+$('#cbclass').val());
}

//helper method to create new tab
function addTab(title, url){
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

//Start Card view code
var cardview = $.extend({}, $.fn.datagrid.defaults.view, {
    renderRow: function(target, fields, frozen, rowIndex, rowData){
        var cc = [];
        cc.push('<td style="height:50;width:100px; padding:10px 5px;border:1;">');
        if (!frozen && rowData.flightid){
            //var aa = rowData.itemid.split('-');
            //var img = 'shirt' + aa[1] + '.gif';
            //cc.push('<img src="images/' + img + '" style="width:150px;float:left">');
            //cc.push('<div style="float:left;margin-left:20px; width:250px;">');
            //for(var i=0; i<fields.length; i++){
            //var copts = $(target).datagrid('getColumnOption', fields[i]);
            //cc.push('<p><span class="c-label">' + copts.title + ':</span> ' + rowData[fields[i]] + '</p>');
            cc.push('<center><div ><h1>'+rowData.flightcode+'</h1><p>'+rowData.origin+ '--> '+rowData.destination+'</p>'+
                '<p>'+rowData.flightdate+ ' - '+rowData.flighttime+'</p>'+
                '<p>Tourism:'+rowData.remainingsecond+ ': '+rowData.secondclassprice+'</p>'+
                '<p>Business:'+rowData.remainingfirst+ ': '+rowData.firstclassprice+'</p>'+
                '<p><a class="btn btn-primary btn-lg" href="#" role="button">احجز</a></p></div></center>'
            );
    
    


            //}

            //cc.push('</div>');
        }
        cc.push('</td>');
        return cc.join('');
    }
});
$(function(){
    $('#ttg').datagrid({
        view: cardview
    });
});


//End card view code
//</script>