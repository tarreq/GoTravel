<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Flight reports</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../css/all-themes.css">
        <link rel="stylesheet" type="text/css" href="../css/custom_style.css">
        <link rel="stylesheet" type="text/css" href="../css/waves.css">
        <link rel="stylesheet" type="text/css" href="../css/animate.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrapc.css">
        

        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../../themes/material/easyui.css">
	    <link rel="stylesheet" type="text/css" href="../../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../../themes/color.css">
	    <link rel="stylesheet" type="text/css" href="../../demo.css">
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../LTE/AdminLTE.min.css">
        <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">
        <script src="../LTE/adminlte.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
<!--	<script type="text/javascript" src="../../jquery.min.js"></script>-->
	<script type="text/javascript" src="../../../jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../helperq.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
</head>
<body>
	<?php 
        require_once('../helper.php');
        ?>
        <h3>Flight: <?php echo getCurrentFlightCode(); ?> </h3>
	
        
        <table id="dashtable" >
                                        <tr>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-red">
                                                    <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Total Payment</span>
                                                        <span class="info-box-number"> <?php echo getCurrentFlightTotalPayment()." USD"; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Total users credit 
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-green">
                                                    <span class="info-box-icon"><i class="fa fa-plane"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Last Flight Seats</span>
                                                        <span class="info-box-number"><?php echo getLastFlightSeats()['remainingsecond']."/".getLastFlightSeats()['secondclassseats']." - ".getLastFlightSeats()['remainingfirst']."/".getLastFlightSeats()['firstclassseats']; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            <?php echo getLastFlightSeats()['flightcode']; ?>
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-yellow">
                                                    <span class="info-box-icon"><i class="fa fa-usd"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Last Payment</span>
                                                        <span class="info-box-number"><?php echo getLastPayment()['paymentusdamount']; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            <?php echo getLastPayment()['username']; ?>
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                            <td width="300px" style="padding-left: 30px;">
                                                <div class="info-box bg-blue">
                                                    <span class="info-box-icon"><i class="fa fa-usd"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Last Payment</span>
                                                        <span class="info-box-number"><?php echo getLastPayment()['paymentusdamount']; ?></span>
                                                        <!-- The progress section is optional -->
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            <?php echo getLastPayment()['username']; ?>
                                                        </span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                            </td>
                                        </tr>
        </table>
	
	
	
	<script type="text/javascript">
		
               
</script>
	<style type="text/css">
	
	</style>
</body>
</html>