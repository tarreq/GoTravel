<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../themes/color.css">
	<link rel="stylesheet" type="text/css" href="../demo.css">
	<script type="text/javascript" src="../../jquery.min.js"></script>
	<script type="text/javascript" src="../../jquery.easyui.min.js"></script>
        
</head>

<!--Dynamically append Passengers based on Pax No. using sppenfElement function-->
<body>
<?php
require_once('mekrodb.php');


$flights = $_GET['fsid'];
//echo $flights;
//$flightid = $_GET['fid'];
$pax = $_GET['pax'];
$cbclass = $_GET['cbclass'];
//$username = $_SESSION['username'];



$results = DB::query("SELECT a.flightid,a.flightcode,a.flightdate, CONCAT(c.airportcode,f.citynamearabic) as origin, CONCAT(d.airportcode,g.citynamearabic) as destination, 
a.flighttime ,CONCAT(a.firstclassprice,'$') as firstclassprice
, CONCAT(a.secondclassprice,'$') as secondclassprice ,
h.firstclassseats - IFNULL(SUM(j.firstclassseats),0) as remainingfirst
,h.secondclassseats -IFNULL(SUM(j.secondclassseats),0) as remainingsecond
, e.flightstatuscode
FROM flight a inner join route b
on a.routeid = b.id inner join airport c
on b.originairportid = c.id inner join airport d
on b.destinationairportid = d.id inner join flightstatus e
on a.flightstatusid = e.flightstatusid inner join city f 
on c.cityid = f.cityid inner join city g
on d.cityid = g.cityid left join jet h
on a.jetid = h.jetid left join booking j
on a.flightid = j.flightid"
." where a.flightid in (".$_GET['fsid'].") group by a.flightid ;");

echo "<table id=\"flight\" class=\"table\">
    <tr>
        <th>رقم الرحلة</th>
        <th>التاريخ</th>
        <th>الوقت</th>
        <th>من</th>
        <th>الي</th>
        <th>سعر رجال أعمال</th>
        <th>سعر سياحية</th>
        <th>مقاعد د.اولي</th>
        <th>مقاعد د.ثانية</th>
        <th>الحالة</th>
        
    </tr>";
    
    foreach ($results as $row) {
    echo "<tr>
        <td>".$row['flightcode']."</td>
        <td>".$row['flightdate'] ."</td>
        <td>".$row['flighttime'] ."</td>
        <td>".$row['origin'] ."</td>
        <td>".$row['destination']."</td>
        <td>".$row['firstclassprice'] ."</td>
        <td>".$row['secondclassprice'] ."</td>
        <td>".$row['remainingfirst'] ."</td>
        <td>".$row['remainingsecond'] ."</td>
        <td>".$row['flightstatuscode'] ."</td>
        <td>pax:".$pax."</td>
            <td>cl:".$cbclass."</td>
         
    </tr>";
    };
    
    //sum first class price for selected flights
    $firstclassprices = 0;
    foreach ($results as $item) {
    $firstclassprices += $item['firstclassprice'];
    }
    
    echo $firstclassprices;
    //sum second class price for selected flights
    $secondclassprices = 0;
    foreach ($results as $item) {
    $secondclassprices += $item['secondclassprice'];
    }
    
    echo $secondclassprices;
    
//$firstclassprice = $results['firstclassprice'];
//$secondclassprice = $results['secondclassprice'];        
?>

    <form id="ff" action="x_proc.php" method="post">
        <table>
            <tr>
                 <td>
                <input type="hidden" name="flightsids" value="<?php echo $flights; ?>">
                </td>
                <td>
                <input type="hidden" name="cbclass" value="<?php echo $cbclass; ?>">
                </td>
                <td>
                <input type="hidden" name="pax" value="<?php echo $pax; ?>">
                </td>
                <td>
                <input type="hidden" name="firstclassprice" value="<?php echo $firstclassprices; ?>">
                </td>
                <td>
                <input type="hidden" name="secondclassprice" value="<?php echo $secondclassprices; ?>">
                </td>
            </tr>
<!--            <div id="container">

            </div>-->
            <?php 

            
                $pax= $_GET['pax'];

                
                #Start drawing passengers inputs
                for ($i= 1 ; $i<= $pax ; $i++)
                {
                    
                    echo "<tr><td>Passenger No.: ".$i."</td></tr>"
                    ."<tr><td width=100px>First Name:</td><td> <input type=\"text\" class=\"easyui-validatebox\" required=\"true\" validType=\"string\" name=\"fname[]\"></td></tr>"
                    . "<tr><td width=100px>Last Name:</td><td>  <input type=\"text\" class=\"easyui-validatebox\" required=\"true\" validType=\"string\" name=\"lname[]\"></td></tr>"
                    . "<tr><td width=100px>Phone:</td><td> <input type=\"text\" class=\"easyui-validatebox\" required=\"true\" validType=\"string\" name=\"phone[]\"></td></tr>"
                    . "<tr><td width=100px>E-mail:</td><td> <input type=\"text\" class=\"easyui-validatebox\" required=\"true\" validType='email' name=\"email[]\"></td></tr>"
                    . "<tr><td>Birttdate:</td><td> "

                ."Day: <select name=\"birthday[]\" >
                <option value=\"1\">1</option>
                <option value=\"2\">2</option>
                <option value=\"3\">3</option>
                <option value=\"4\">4</option>
                <option value=\"5\">5</option>
                <option value=\"6\">6</option>
                <option value=\"7\">7</option>
                <option value=\"8\">8</option>
                <option value=\"9\">9</option>
                <option value=\"10\">10</option>
                <option value=\"11\">11</option>
                <option value=\"12\">12</option>
                <option value=\"13\">13</option>
                <option value=\"14\">14</option>
                <option value=\"15\">15</option>
                <option value=\"16\">16</option>
                <option value=\"17\">17</option>
                <option value=\"18\">18</option>
                <option value=\"19\">19</option>
                <option value=\"20\">20</option>
                <option value=\"21\">21</option>
                <option value=\"22\">22</option>
                <option value=\"23\">23</option>
                <option value=\"24\">24</option>
                <option value=\"25\">25</option>
                <option value=\"26\">26</option>
                <option value=\"27\">27</option>
                <option value=\"28\">28</option>
                <option value=\"29\">29</option>
                <option value=\"30\">30</option>
                <option value=\"31\">31</option>
                </select>"
                
               ."Month: "

                ."<select name=\"birthmonth[]\" >
                <option value=\"1\">1</option>
                <option value=\"2\">2</option>
                <option value=\"3\">3</option>
                <option value=\"4\">4</option>
                <option value=\"5\">5</option>
                <option value=\"6\">6</option>
                <option value=\"7\">7</option>
                <option value=\"8\">8</option>
                <option value=\"9\">9</option>
                <option value=\"10\">10</option>
                <option value=\"11\">11</option>
                <option value=\"12\">12</option>
                </select>"
                
               
                ."Year :<input type=\"text\" class=\"easyui-validatebox\" required=\"true\" validType=\"string\" name=\"birthyear[]\"></td>"
                            
                . "</tr>"
                    . "<tr><td width=100px>Nationality:</td><td> <select name=\"nationality[]\">"
                    . "<option value=\"1\">السعودية</option>"
                    . "<option value=\"2\">تركيا</option></select></td></tr>"
                    ."<tr><td><hr></td><td><hr></td></tr>"
                    
                    
                    ;
                }
                ?>

           
            
            <tr>
                                <td>
<!--                    <input type="submit" value="Book"></input>-->
                    <input type="submit" value="Book">
                   
                </td>
            </tr>
        </table>
        
        <br><br><br>
    </form>
<!--</div>-->
<!--        <div style="text-align:center;padding:5px 0">
            <a href="#" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
        </div>-->
 <script>
        function submitForm(){
            $('#ff').form('submit');
        }
        function clearForm(){
            $('#ff').form('clear');
        }
    </script>

<script type="text/javascript">
 
//var counter = $_GET['pax'];
//function appendElements(counter){
// 
// for (i = 1; i <= counter; i++)
// 
// $('#container').append(
// 
////            '<strong>Hobby No. ' + counter + '</strong><br />'
//            + '<input id="field_' + counter + '" name="dynfields[]' + '" type="text" /><br />' +
//            '<tr><td>Title: </td><td><select id="cbtitle_'+i+'" name="cbtitle[]">'+
//            '<option value="1">Mr</option><option value="2">Mrs-Ms.</option></select></td></tr>'+
//            
//            '<tr><td>Passenger Name:</td><td><input id="fname_'+i+'"type="text" name="fname[]"></td>'+
//            
//            '</tr><tr><td>Sur Name:</td><td><input id="surname_'+i+'" name="surname[]" class="easyui-validatebox" ></input></td>'+
//            
//            '</tr><tr><td>Passenger Phone:</td>'+
//            '<td><input id="phone_'+i+'" name="phone[]" type="text" class="easyui-validatebox" required="true" validType="string"></input></td></tr>'+
//            
//            '<tr><td>Passenger Email:</td>'+
//            '<td><input class="easyui-validatebox" type="text" id="email_'+i+'" name="email[]" required="true" validType="email"></input></input></td>'+
//            
//            '</tr><tr><td>Country :</td><td> <select id="cbcountry_'+i+'" name="cbcountry[]"><option value="1">Saudi Arabia</option>'+
//            '<option value="2">Turkey</option></select></td></tr><tr><td><hr></td>td><hr></td></tr>'
//            
//            );
//
// 
//};

function appendElements(counter){
    
    
 
 for (i = 1; i <= counter; i++){
 
 $('#container').append(
             '<tr><td>Passenger Name:</td><td><input id="fname_'+i+'"type="text" name="fname[]"></td></tr>'
            );

 
}

};
</script>
</body>
    
    </html>