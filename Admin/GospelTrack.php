<?php
function fetch_data(){
	$query=mysql_query("CALL sp_PropAssign ('".$_GET['id']."')")or die(mysql_error());
	while($row=mysql_fetch_array($query)){
	}
}
    require_once('../fttma/tcpdf/tcpdf.php'); 
    ob_start();
    $custom_layout = array(216, 356);
    $pdf = new TCPDF('L', PDF_UNIT, $custom_layout, true, 'UTF-8', false);
    // TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("FTTMA Propagation Daily Monitoring Report");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));   
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(5, 5, 5);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
	// $pdf->SetAutoPageBreak(TRUE, 10);  
	$pdf->SetFont('Arial', '', "8.5");
	$pdf->AddPage();  

	// HTML
	$content .= 
	'
	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="UTF-8">
	<title>Page Title</title>
	</head>
	<body>
	<h2 style="text-align:center">FTTMA Propagation Daily Monitoring Report (Gospel Preaching Assignement)</h2>	<br>
	<label style="text-align:center; padding-right:10%">Term: <u>66th</u>&nbsp;&nbsp;&nbsp;&nbsp;</label>
	<label style="text-align:center;">Period of Propagation: <u>10/10/2019</u>&nbsp;&nbsp;&nbsp;&nbsp;</label>
	<label style="text-align:center;">Date of Reporting: <u>10/10/2019</u></label> 
	<br>
	<br>
	<table border="1" cellspacing="0" cellpadding="3"> 
	<tr>
		<th> GOALS: 
		<br>
		</th>
	</tr>
	</table>
	<br>
	<br>
	<table border="1" cellspacing="0" cellpadding="3"> 
		<tr>
			<th width="3%"> </th>
			<th width="25%" style="text-align:center;"><b>Name</b></th>
			<th width="12%" style="text-align:center;"><b>Week 1</b></th>
			<th width="12%" style="text-align:center;"><b>Week 2</b></th>
			<th width="12%" style="text-align:center;"><b>Week 3</b></th>
			<th width="12%" style="text-align:center;"><b>Week 4</b></th>
			<th width="12%" style="text-align:center;"><b>Week 5</b></th>
			<th width="12%" style="text-align:center;"><b>Total/Average:</b></th>
		</tr>
		<tr>
			<td style="text-align:center;">1</td>
			<td style="text-align:left;"><b>Home Knocked</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">2</td>
			<td style="text-align:left;"><b>Home Preached</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">3</td>
			<td style="text-align:left;"><b>Person Contacted</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">4</td>
			<td style="text-align:left;"><b>Person who Received the gospel/called</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">5</td>
			<td style="text-align:left;"><b>Gospel friends open for follow-up</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">6</td>
			<td style="text-align:left;"><b>Baptism</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">7</td>
			<td style="text-align:left;"><b>New home meetings started</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">8</td>
			<td style="text-align:left;"><b>Total home meetings held</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">9</td>
			<td style="text-align:left;"><b>Total persons home met</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">10</td>
			<td style="text-align:left;"><b>Persons Visited but not home met</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">11</td>
			<td style="text-align:left;"><b>New small group meetings established</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">12</td>
			<td style="text-align:left;"><b>Total small group meetings held</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">13</td>
			<td style="text-align:left;"><b>Total local saints attending small group meetings</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">14</td>
			<td style="text-align:left;"><b>Local saints joining propagation</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">15</td>
			<td style="text-align:left;"><b>Total man-hours of local saints joining propagation</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">16</td>
			<td style="text-align:left;"><b>LTM Attendance</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
		<tr>
			<td style="text-align:center;">17</td>
			<td style="text-align:left;"><b>Total Trainee team-hours (in hours)</b></td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:center;">0</td>
			<td style="text-align:left">TOTAL:</td>
		</tr>
	</table>
	<table border="1" cellspacing="0" cellpadding="3">
		<tr>
			<td width="28%">
			<b align="center">Gospel Team Members</b>
			<br>
			<br>
				<table> 
					<tr>
						<td style="width:10%"> </td>
						<td colspan="3" style="text-align:center;">NAME</td>
						<td colspan="2" style="text-align:center;">CLASS</td>
					</tr>
					<tr>
						<td>1</td>
						<td colspan="3">______________</td>
						<td colspan="2">______________</td>
					</tr>
					<tr>
						<td>2</td>
						<td colspan="3">______________</td>
						<td colspan="2">______________</td>
					</tr>
					<tr>
						<td>3</td>
						<td colspan="3">______________</td>
						<td colspan="2">______________</td>
					</tr>
					<tr>
						<td>4</td>
						<td colspan="3">______________</td>
						<td colspan="2">______________</td>
					</tr>
					<tr>
						<td>5</td>
						<td colspan="3">______________</td>
						<td colspan="2">______________</td>
					</tr>
					<tr>
						<td>6</td>
						<td colspan="3">______________</td>
						<td colspan="2">______________</td>
					</tr>
				</table>
			</td>
			<td width="72%">
				<table>
				<tr>
					<td>
						<b>Reminders:</b>
					</td>
				</tr>
				<tr>
					<td>
					  1  Total Trainee Team-hours (in hours) is the sum total of the 
					team-hours spent exclusively for GOW not including the team fellowship 
					and pursuance but including LTM time.
					</td>
				</tr>
				<tr>
					<td>
					  2  Homes preached is a part of Homes Knocked. Persons who receive the 
					gospel/called is part of Persons contacted.
					</td>
				</tr>
				<tr>
					<td>
					  3  New Home Meetings started are included in Total Home Meetings Held. 
					New Small Group Meetings established are included in Total Small Group Meetings held.
					</td>
				</tr>
				<tr>
					<td>
					  4  Make sure all data are relevant and consistent.
					</td>
				</tr>
				<tr>
					<td>
					  5  For uncertainties, do not hesitate to ask anyone from the FFTMa Propagation Monitoring Team.
					</td>
				</tr>
				</table>
				<br>
				<br>
				<table>
					<tr>
						<td>
							&nbsp;&nbsp;Signed by: __________________ 
						</td>
						<td >
							Confirmed by: ________________  
						</td>
						<td >
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Noted by: ________________
						</td>
						<td style="text-align:center">	
							________________________
						</td>
					</tr>
					<tr style="text-align:center">
						<td>
							Coordinator
						</td>
						<td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R.O. / Elder
						</td>
						<td style="text-align:center">
							Co-worker
						</td>
						<td>
							Contact No.
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</body>
	</html>
	';
	$pdf->writeHTML($content); 
    ob_end_clean();
    $pdf->Output('MonitoringReport.pdf', 'I');
	

?>