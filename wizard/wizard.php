
<!DOCTYPE html>

<html>
 

<head>
	<meta charset="UTF-8">
	<title>DataGrdi wizard V 1.0</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../../themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../../themes/color.css">
	<link rel="stylesheet" type="text/css" href="../../demo.css">
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        
        
        
        <style>
       
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
<!--	<script type="text/javascript" src="../../jquery.min.js"></script>-->
	<script type="text/javascript" src="../../../jquery.easyui.min.js"></script>
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>

  
 


 
        </script>  

       
	
	
</head>
<body bgcolor="#f2f2f2">
    
    <br>
    <br>
    <form name="form1" action="wizard.php" method="post">
    <table>
        <tr>
            <td>
    
     <input id="tablecb1" class="easyui-combobox" name="tablecb"
                data-options="valueField:'table_name',textField:'table_name',url:'get_tables.php'">
            </td>
            <td>
    
     <input id="tablecb2" class="easyui-combobox" name="tablecb2"
                data-options="valueField:'table_name',textField:'table_name',url:'get_tables.php'">
            </td>
            <td>
<!--                <input class="ui-button ui-widget ui-corner-all" type="submit" value="Render Datagrid">-->
                <a href="javascript:void(0)" id="a_render" class="easyui-linkbutton c1" style="width:130px; height:30px;">Grid Render</a>
            </td>
           
            
     
     </tr>
     <tr>
          <td>
                <div id="datalist1" class="easyui-datalist" title="Select Grid columns" style="width:400px;height:250px" data-options="
                     url: 'get_table_columns.php',
                     method: 'get',
                     singleSelect: false
                     ">
                </div>
            </td>
            <td>
                <div id="datalist2" class="easyui-datalist" title="Select Grid columns" style="width:400px;height:250px" data-options="
                     url: 'get_table_columns.php',
                     method: 'get',
                     singleSelect: false
                     ">
                </div>
            </td>
            <td>
                <div id="p2">
                    
                </div>
            </td>
            <td>
                <div id="p3">
                    
                </div>
            </td>
     </tr>
     <tr>
         <td>
             <div id="gridrender" style="width:600px;height:400px">
                 
             </div>
         </td>
     </tr>

     </table>
  
    </form>
   
    <script>
        
        var myarray1 = [];
        var myarray2 = [];
         
   $('#tablecb1').combobox({
        onChange: function(row){
            var tablename = $('#tablecb1').combobox('getValue');
                    $('#datalist1').datalist('load','get_table_columns.php?tablename='+tablename);
                    $('#datalist1').datalist({
                            
                            textField: 'COLUMN_NAME',
                            checkbox: true,
                            onClickRow: function(index,row){
                                $('#p2').append(row.COLUMN_NAME+',');
                                myarray1.push(row.COLUMN_NAME);
                                
                                }
                        })
            
    
	}
})

  $('#tablecb2').combobox({
        onChange: function(row){
            var tablename = $('#tablecb2').combobox('getValue');
                    $('#datalist2').datalist('load','get_table_columns.php?tablename='+tablename);
                    $('#datalist2').datalist({
                            
                            textField: 'COLUMN_NAME',
                            checkbox: true,
                            onClickRow: function(index,row){
                                $('#p3').append(row.COLUMN_NAME+',');
                                myarray2.push(row.COLUMN_NAME);
                                
                                }
                        })
            
    
	}
})


        $('#a_render').click(function(){
        //alert('Sign new href executed.');
        //get columns in DIV
        var columns = $('#p2').text()
        var columnsArr = columns.split(',');
        
        var content =''
        
        
        content +='<table id="dg" title="My Grid" class="easyui-datagrid" style="width:700px;height:600px"'
                +' url="lookuptable_join.php?table1='+$('#tablecb1').combobox('getValue')+ '&table2='+$('#tablecb2').combobox('getValue')+'&fk='+myarray1[0]+'&pk='+myarray2[0]+'"'
		+' toolbar="#toolbar" pagination="true"'
		+' fitColumns="true" singleSelect="true">'
		+'<thead><tr>';
        
        //loop through column array
        $.each( myarray1, function( index, value ){
        content +='<th field="'+value+'" width="50">'+value+'</th>';
        });
        
        //loop through second array
        for ( var i = 1; i< myarray2.length ; i++ ) {
               content +='<th field="'+myarray2[i]+'" width="50">'+myarray2[i]+'</th>';
            }
        
        
        //close the grid
       content +='</tr></thead></table>'+"<br>";
       
       //add toolbar 
       content +='<div id="toolbar">'
		+'<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newEntry()">New </a>'
		+'<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editEntry()">Edit </a>'
		+'<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyEntry()">Delete </a>'
	+'</div>'


        
        
        //set div content to render result
        $("#gridrender").text(content);
        
        
    });
    
    </script>
      
</body>
</html>