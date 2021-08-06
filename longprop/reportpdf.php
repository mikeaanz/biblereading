<?php include 'functions/db.php'?>
<?php include 'functions/session.php' ?>

<?php 
$idx = $_GET['id'];
$cont=" ";
$user_query = mysql_query("SELECT * FROM weekspropagation")or die(mysql_error());
							while($row = mysql_fetch_array($user_query)){
                                $cont.='<td style="border-right: 1px solid gray;height:30px;text-align:center;">'.$row['id_weekprop'].'</td>';
                           
?>






<?php

require_once 'dompdf/autoload.inc.php';
// $p1=$_GET['request_id'];
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml('
<html>

<body>

<div >


<table style="font-size:14px;font-family: Helvetica;border: 1px solid gray;width:100%" cellpadding="5">
<tr style="border: 1px solid black; border-collapse: collapse;">
<td colspan="7"> <p>
<img src="img/logo.png" width="90" height="90" style="float:left;margin-left:10px;">
<center>
<p style="font-family: Helvetica;font-size:24px;">Full Time Training in Malabon</p> 
<p style="font-family: Helvetica;font-size:12px;line-height: 5px;">47 Sisa St, Acacia, Malabon City,</p>
<p style="font-family: Helvetica;font-size:14px;line-height: 5px;"><b>Metro Manila, Philippines 1474</b></p>
<p style="font-family: Helvetica;font-size:12px;line-height: 5px;">Lord’s Recovery in the Philippines</p>
</center></p>
</td>
</tr>
</table>


<table style="font-size:12px;font-family: Helvetica;border: 1px solid gray;width:100%;padding-top:0px;" cellpadding="5">
<tr>

</tr>



<table style="font-family: Helvetica;width:100%" cellpadding="0">

<tr style="border: 1px solid black; border-collapse: collapse;border-color:gray;">
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Week No</td>
  <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Homes Knocked</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Homes Preached</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Person Contacted</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Persons who Received The Gospel</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Gospel Friends Open For Follow-up</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Baptism</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">New Home Meetings</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Home Meetings Held</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Persons Home Met</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Persons Visited But Not Home Met</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">New Small Group Meetings</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Small Group Meetings Held</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Total Local Saints Attending Small Group Meetings</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Local Saints Joining Propagation</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Total Man-Hours</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">LTM Attendance</td>
 <td style="font-size:11px;border: 1px solid black; border-collapse: collapse;border-color:gray;height:20px;font-weight:bold;text-align:center;width:7%;">Total Trainee Team-Hours</td>
 
</tr>
'.$cont.'
<tr style="border-right: 1px solid gray;">
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td tyle="border-right: 1px solid gray;"></td>
</tr>

<tr style="border-right: 1px solid gray;">
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td tyle="border-right: 1px solid gray;"></td>
</tr>

<tr style="border-right: 1px solid gray;">
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;font-size:12px;"><br /> &nbsp;Funds Available:<br /> <br /></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
</tr>

<tr style="border-right: 1px solid gray;">
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
</tr>

<tr>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;font-size:12px;text-align:center;">Budget Officer <br /></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
<td style="border-right: 1px solid gray;"></td>
</tr>

</table>


</body>
</html>
');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("purchase_request",array("Attachment"=>0));
?>
