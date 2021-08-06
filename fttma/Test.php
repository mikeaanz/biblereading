<?php
$link = mysql_connect('localhost', 'root', '');
mysql_select_db('dbmonitoring',mysql_connect('localhost','root',''))or die(mysql_error());
function fetch_data(){
  $qwery= mysql_query("select PLACES,USER_LEVEL from accounts AS accnt INNER JOIN locality AS lc ON lc.ID = accnt.locality WHERE accnt.id = '".$_GET['SessionId']."'")or die(mysql_error());
  $rowz = mysql_fetch_array($qwery);
  $check= $rowz['PLACES'];//connect to querys
  $locality = $rowz['USER_LEVEL'];

    $Output = '
    <h1 style="text-align:center;">FTTM Propagation Daily Monitoring Report</h1>
    <h4 style="text-align:center;" > Term: <u>'.$_GET["TermNumber"].'</u> Period of Propagation:__________________________   Type of Assignment: (check one)  Weekend__  5-Day__   </h4>
    <table border="1" cellspacing="0" cellpadding="3">  
    <tr>  
      <th colspan="4" width="22%">
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 6
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 7
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 8
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 9
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 10
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 11
      </th>
       <th align="center" colspan="5" width="6.5%">
        Wk 12
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 13
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 14
      </th>
       <th align="center" colspan="5" width="6.5%">
        Wk 15
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 16
      </th>
      <th align="center" colspan="5" width="6.5%">
        Wk 17
      </th>
    </tr>
    <tr>
      <th width="2.5%">
      </th>
      <th align="center" width="6.5%" style="font-size:5;">Name
      </th>
      <th align="center" width="6.5%">Address
      </th>
      <th align="center" width="6.5%">Contact No(s).
      </th>

          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
  


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>

   
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
 

          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>

      
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>

      
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
        </tr>


    <tr>
      <th align="center">1
      </th>
      <th>Name
      </th>
      <th>Address
      </th>
      <th>Contact No(s).
      </th>

          <th>A BP</th>
          <th>V F S P</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
  


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>

   
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
 

          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>

      
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>

      
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>


          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
        </tr>


      </table>
      </th>
    </tr>
    </table>
    ';
    // echo "CALL sp_GetPropagationRecord ('".$_GET['SessionId']."','" .$_GET['TermNumber']."','" .$_GET['TermMonth']."','" .$_GET['TermYear']."')";
      // $query=mysql_query("CALL sp_GetPropagationRecord ('".$_GET['SessionId']."','" .$_GET['TermNumber']."','" .$_GET['TermMonth']."','" .$_GET['TermYear']."','" .$locality. "');")or die(mysql_error());
      // while($row=mysql_fetch_array($query))
      // {
        // $Output .= '
        // <tr>
            // <td>' .$row["WeekType"]. '</td>
            // <td>' .$row["HOMESKNOCK"]. '</td>
            // <td>' .$row["HOMESPREACH"]. '</td>
            // <td>' .$row["PCONTACTED"]. '</td>
            // <td>' .$row["RECEIVEDGOSPEL"]. '</td>
            // <td>' .$row["GOPENFOLLOW"]. '</td>
            // <td>' .$row["BAPTISM"]. '</td>
            // <td>' .$row["NEWHOMESMTG"]. '</td>
            // <td>' .$row["TOTALHOMESMTG"]. '</td>
            // <td>' .$row["TOTALPERSONHMTG"]. '</td>
            // <td>' .$row["PVISITEDNOTHMEET"]. '</td>
            // <td>' .$row["NSMALLGMTG"]. '</td>
            // <td>' .$row["SMALLGMTGHELD"]. '</td>
            // <td>' .$row["LOCALATTSMLMTG"]. '</td>
            // <td>' .$row["LOCALSAINTSJOINPROP"]. '</td>
            // <td>' .$row["MANHOURS"]. '</td>
            // <td>' .$row["LTM"]. '</td>
            // <td>' .$row["TEAMHOURS"]. '</td>
          // </tr>';
        // }
        // $Output .= 
        // '</table>
        // <table border="1" cellspacing="0" cellpadding="3" width="100%">
        // <tr>
        // <td width="21.1%">
        // <table>
        // <tr>
        // <td>Gospel Team</td>
        // </tr>
        // <tr>
        // <td>
        // <br/>
        // </td>
        // </tr>
        // ';
        // mysql_close($link);
        // mysql_connect('localhost', 'root', '','dbmonitoring');
        // mysql_select_db('dbmonitoring',mysql_connect('localhost','root',''))or die(mysql_error());
        // $QR=mysql_query("CALL spGetTeamPropagation ('".$_GET['SessionId']."','" .$_GET['TermNumber']."','" .$_GET['TermMonth']."','" .$_GET['TermYear']."','" .$locality. "');")or die(mysql_error());
        // while($rw=mysql_fetch_array($QR))
        // {
          // $Output .= '
          // <tr>
          // <td>
          // '
          // .$rw["Trainee"].
          // ' '
          // .$rw["FT"].
           // '</td>
          // </tr>
          // ';
        // };
        // $Output .= '
        // </table>
        // </td>
        // <td  width="83.7%">
          // <table>
          // <tr>
          // <td colspan="4"><br/></td>
          // </tr>
          // <tr>
          // <td colspan="4">
          // <br/>
          // </td>
          // </tr>
          // <tr>
          // <td>
          // Signed by: __________________
          // </td>
          // <td >
          // Confirmed by: __________________
          // </td>
          // <td>
          // Noted by: __________________
          // </td>
          // <td >
          // ______________________
          // </td>
          // </tr>
          // <tr>
          // <td>
          // Contact #:&nbsp;__________________</td>
          // <td align="center">
          // &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          // R.O. / Elder
          // </td>          
          // <td>
          // &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          // &nbsp;&nbsp;&nbsp;
          // Co-worker
          // </td>
          // <td>
          // &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          // Training Assistant
          // </td>
          // </tr>
          // <tr>
          // <td>
          // &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          // Coordinator</td>
          // <td colspan="3">
          // </td>
          // </tr>
          // </table>
        // </td>
        // </tr>
        // </table>
        // ';
        return $Output;
    }
    require_once('../fttma/tcpdf/tcpdf.php'); 


    ob_start();
    $custom_layout = array(216, 356);
    $pdf = new TCPDF('L', PDF_UNIT, $custom_layout, true, 'UTF-8', false);
header('Content-type: application/download;filename="pdfweekend.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
    // TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Weekend Propagation Report");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(5, 5, 5);  
    
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('arial', '', '3.5');  

    $pdf->AddPage();    
    $content .= fetch_data();
    // $content .= '</table>';
    $pdf->writeHTML($content);  
    ob_end_clean();

    $pdf->Output('pdfweekend.pdf', 'D');
	

?>