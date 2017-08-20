

<html>
    
    <head>
        <meta charset="UTF-8">
	<title>Charter Booking System - V1.0</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../themes/color.css">
	<link rel="stylesheet" type="text/css" href="../demo.css">
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="LTE/AdminLTE.min.css">
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
        <script src="LTE/adminlte.min.js"></script>
        
    </head>
    
    <body>
    
        <h2>Settings</h2>    
    <table id="settings_table">
    <tr>
        <td width="70px">
            Language : 
        </td>
        <td width="150px">
            <input id="langcb" class="easyui-combobox" name="langcb"
                data-options="valueField:'id',textField:'airport',url:'data_get/get_origin_airports.php'">
        </td>
    </tr>
    
    </table>
    </body>

</html>



