<?php 
 // $pdf= new multipdf();
 // $pdf->AddPage('L','A4',0);
 // $pdf->Setfont('Arial','',14);
// $sql=mysql_select_db('dbmonitoring',mysql_connect('localhost','root',''))or die(mysql_error());
//     require_once('../fttma/FPDF  f/fpdf.php'); 
$sql=mysql_select_db('dbmonitoring',mysql_connect('localhost','root',''))or die(mysql_error());

    require_once('../fttma/fpdf/fpdf.php'); 

     class myPDF extends FPDF{
            function header(){

      $this->Image('../Admin/img/logo.png',70,6,25);
      $this->setfont('Arial','B', 14);


                           $this->Ln(3);
              $this->Cell(94);
      $this->Cell(276,5,'FTTMA - FullTime Training in Malabon');
      $this->Ln();
      $this->setfont('Times','',12);
      $this->Cell(270,10,'19 St,Acacia, Malabon City',0,0,'C');
          $this->Ln();
        $this->Cell(270,10,$_GET['locality'],0,0,'C');
      $this->Ln();
      $this->setfont('Arial','',8);
      $this->Cell(-43);
      $this->Cell(270,10,'Term:_____',0,0,'C');


       $this->Cell(-183);
       $this->Cell(270,10,'Type of Assignment:____________________',0,0,'C');



       $this->Cell(-257);
       $this->Cell(270,10,'LONG PROPAGATION',0,0,'C');

       $this->Cell(-367);
       $this->Cell(270,10,$_GET['TermNumber'],0,0,'C');
       $this->Ln();


       $this->setfont('Times','B',12);

       $this->Cell(-1);
       $this->Cell(279,20,'',1,0,'C');


      $this->Cell(-405);
      $this->Cell(271,10,'GOALS :',0,0,'C');

      $this->Ln();

      $this->Ln();

      $this->Ln(3);
   $this->setfont('Arial','', 6);
  $this->Setwidths(Array(15,14,14,15,16,14,15,15,15,15,15,15,19,19,15,17,15,15));
 $this->setAligns(Array('C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
 $this->SetLineHeight(5);
 $this->Row(Array('Week type','Home Knocked','Home Preached','Person Contacted','Person who Received the gospel/called','Gospel friends open for follow-up','Baptism','New home meetings started','Total home meetings held','Total persons home met','Persons Visited but not home met','New small group meetings established','Total small group meetings held','Total local saints attending small group meetings','Local saints joining propagation','Total man-hours of local saints joining propagation','LTM Attendance','Total Trainee team-hours (in hours)'));
          }
               function footer(){

    
              $this->sety(-15);
              $this->setfont('Arial','',8);
              $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');


          }




          function headertables($sql){

             $query = mysql_query("SELECT COUNT(*) as bap from baptism_rpt inner join historyfeedback on baptism_rpt.curteam_id=historyfeedback.id inner join month on month.id=historyfeedback.MONTH inner join year on year.id=historyfeedback.YEAR inner join batch on batch.id=historyfeedback.BATCH inner join week on week.id=historyfeedback.WEEK inner join userlevel on userlevel.id=historyfeedback.acc_id inner join status on status.id=historyfeedback.status_id

               where  baptism_rpt.acc_id='".$_GET['SessionId']."'  and  batch.BATCH='".$_GET['TermNumber']."'
                        Group by curteam_id order by baptism_rpt.acc_id

               
                     
                                ")or die(mysql_error());
                             // $data=mysql_fetch_assoc($query);

                         

                 while($data = mysql_fetch_array($query)){
                              

       

}

        $user_query = mysql_query("Select
  HOMESKNOCK,
  HOMESPREACH,
  PCONTACTED,
  RECEIVEDGOSPEL, 
  GOPENFOLLOW,
  SISBAPTISM + BROBAPTISM AS BAPTISM,
  NEWHOMESMTG,
  TOTALHOMESMTG,  
  TOTALPERSONHMTG,  
  PVISITEDNOTHMEET, 
  NSMALLGMTG,
  SMALLGMTGHELD,  
  LOCALATTSMLMTG, 
  LOCALSAINTSJOINPROP,  
  MANHOURS,
  LTM,
  TEAMHOURS,
  week.`week` AS WeekType

from weekspropagation

inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id

inner join month on month.id=historyfeedback.MONTH
inner join year on year.id=historyfeedback.YEAR 
inner join batch on batch.id=historyfeedback.BATCH 
inner join week on week.id=historyfeedback.WEEK
inner join userlevel on userlevel.id=historyfeedback.acc_id 
inner join status on status.id=historyfeedback.status_id 






where   accounts_id='".$_GET['SessionId']."' and  batch.BATCH='".$_GET['TermNumber']."'


")or die(mysql_error());
                              while($row = mysql_fetch_array($user_query)){


                     $this->Row(Array($row['WeekType'],$row['HOMESKNOCK'],$row['HOMESPREACH'],$row['PCONTACTED'],$row['RECEIVEDGOSPEL'],$row['GOPENFOLLOW'],$row['BAPTISM'],
                      $row['NEWHOMESMTG'],$row['TOTALHOMESMTG'],$row['TOTALPERSONHMTG'],$row['PVISITEDNOTHMEET'],$row['NSMALLGMTG'],$row['SMALLGMTGHELD'],$row['LOCALATTSMLMTG'],$row['LOCALSAINTSJOINPROP'],$row['MANHOURS'],$row['LTM'],$row['TEAMHOURS']));            

               }
         }




          


// variable to store widths and aligns of cells, and line height
var $widths;
var $aligns;
var $lineHeight;

//Set the array of column widths
function SetWidths($w){
    $this->widths=$w;
}

//Set the array of column alignments
function SetAligns($a){
    $this->aligns=$a;
}

//Set line height
function SetLineHeight($h){
    $this->lineHeight=$h;
}

//Calculate the height of the row
function Row($data)
{
    // number of line
    $nb=0;

    // loop each data to find out greatest line number in a row.
    for($i=0;$i<count($data);$i++){
        // NbLines will calculate how many lines needed to display text wrapped in specified width.
        // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    }
    
    //multiply number of line with line height. This will be the height of current row
    $h=$this->lineHeight * $nb;

    //Issue a page break first if needed
    $this->CheckPageBreak($h);

    //Draw the cells of current row
    for($i=0;$i<count($data);$i++)
    {
        // width of the current col
        $w=$this->widths[$i];
        // alignment of the current col. if unset, make it left.
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

//calculate name of trainee
function Rows($data)
{
    // number of line
    $nb=0;

    // loop each data to find out greatest line number in a row.
    for($i=0;$i<count($data);$i++){
        // NbLines will calculate how many lines needed to display text wrapped in specified width.
        // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    }
    
    //multiply number of line with line height. This will be the height of current row
    $h=$this->lineHeight * $nb;

    //Issue a page break first if needed
    $this->CheckPageBreak($h);

    //Draw the cells of current row
    for($i=0;$i<count($data);$i++)
    {
        // width of the current col
        $w=$this->widths[$i];
        // alignment of the current col. if unset, make it left.
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        //$this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //calculate the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}


       

                      



$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTables($sql);

        $pdf->Row(Array('TOTAL/AVG','TOTAL','TOTAL','TOTAL','TOTAL','TOTAL','TOTAL','TOTAL','AVERAGE','AVERAGE','AVERAGE','TOTAL','AVERAGE','AVERAGE','AVERAGE','AVERAGE','AVERAGE','AVERAGE')); 

$avg='AVG';


    $query = mysql_query("SELECT * from baptism_rpt
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on baptism_rpt.curteam_id=historyfeedback.id 
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                  where  baptism_rpt.acc_id='".$_GET['SessionId']."' and batch.BATCH='".$_GET['TermNumber']."'
               
                                ")or die(mysql_error());
                                $countrecordbaptize = mysql_num_rows($query);

   $user_query = mysql_query("Select
SUM(HOMESKNOCK) as HOMESKNOCK    ,
SUM(HOMESPREACH) as HOMESPREACH,
SUM(PCONTACTED) as PCONTACTED,
SUM(RECEIVEDGOSPEL) as RECEIVEDGOSPEL, 
SUM(GOPENFOLLOW) as GOPENFOLLOW,
SISBAPTISM + BROBAPTISM AS BAPTISM,
SUM(SISBAPTISM + BROBAPTISM) as btz,
SUM(NEWHOMESMTG) as NEWHOMESMTG,
ROUND(AVG(TOTALHOMESMTG)) as TOTALHOMESMTG,  
ROUND(AVG(TOTALPERSONHMTG)) as TOTALPERSONHMTG,  
ROUND(AVG(PVISITEDNOTHMEET)) as PVISITEDNOTHMEET , 
SUM(NSMALLGMTG) as NSMALLGMTG ,
ROUND(AVG(SMALLGMTGHELD)) as SMALLGMTGHELD,  
ROUND(AVG(LOCALATTSMLMTG)) as LOCALATTSMLMTG, 
ROUND(AVG(LOCALSAINTSJOINPROP)) as LOCALSAINTSJOINPROP,  
ROUND(AVG(MANHOURS)) as MANHOURS ,
ROUND(AVG(LTM)) as LTM,
ROUND(AVG(TEAMHOURS)) as aa,
week.`week` AS WeekType

from weekspropagation
inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
inner join month on month.id=historyfeedback.MONTH
inner join year on year.id=historyfeedback.YEAR 
inner join batch on batch.id=historyfeedback.BATCH 
inner join week on week.id=historyfeedback.WEEK
inner join userlevel on userlevel.id=historyfeedback.acc_id 
inner join status on status.id=historyfeedback.status_id 


where   accounts_id='".$_GET['SessionId']."' and  batch.BATCH='".$_GET['TermNumber']."'


")or die(mysql_error());
                              while($row = mysql_fetch_array($user_query)){
// downward footer header

        $pdf->Row(Array('TOTAL/AVG',$row['HOMESKNOCK'],$row['HOMESPREACH'],$row['PCONTACTED'],$row['RECEIVEDGOSPEL'],$row['GOPENFOLLOW'],$row['btz'],$row['NEWHOMESMTG'],
          $row['TOTALHOMESMTG'],$row['TOTALPERSONHMTG'],$row['PVISITEDNOTHMEET'],$row['NSMALLGMTG'],$row['SMALLGMTGHELD'],$row['LOCALATTSMLMTG'],$row['LOCALSAINTSJOINPROP'],$row['MANHOURS'],$row['LTM'],$row['aa']));    

        $pdf->Cell(278,40,' ',1,0,'C');
$pdf->Cell(-278);
$pdf->Cell(70,40,'',1,0,'C');

      }



$pdf->Ln(-10);
$pdf->Cell(-1.2);
$pdf->Cell(70  ,30,'Gospel Team Members',0,0,'C');
$pdf->Ln(4);
$pdf->Cell(-12);
$pdf->Cell(70,30,'Name',0,0,'C');

$pdf->Cell(-46);
$pdf->Cell(70,30,'Class',0,0,'C');
$pdf->Ln();




$pdf->setfont('Arial','', 6);
$pdf->Setwidths(Array(36,14));
$pdf->setAligns(Array('L','L'));
$pdf->SetLineHeight(5);





$pdf->Ln(-37);
$pdf->Cell(43);
$pdf->SetFont('Times','',8);
$pdf->Cell(70,30,'Reminders',0,0,'C');

$pdf->Ln(15);
$pdf->Cell(70);
$pdf->MultiCell(275,7,' 1 Total Trainee Team-hours (in hours) is the sum total of the team-hours spent exclusively for GOW not including the team fellowship and pursuance but including LTM time.',0,'L',false);
$pdf->Ln(-4);
$pdf->Cell(70);
$pdf->MultiCell(275,7,' 2 Homes preached is a part of Homes Knocked. Persons who receive the gospel/called is part of Persons contacted.',0,'L',false);

$pdf->Ln(-4);
$pdf->Cell(70);
$pdf->MultiCell(275,7,' 3 New Home Meetings started are included in Total Home Meetings Held. New Small Group Meetings established are included in Total Small Group Meetings held.',0,'L',false);

$pdf->Ln(-4);
$pdf->Cell(70);
$pdf->MultiCell(275,7,' 4 Make sure all data are relevant and consistent.',0,'L',false);

$pdf->Ln(-4);
$pdf->Cell(70);
$pdf->MultiCell(275,7,' 5 For uncertainties, do not hesitate to ask anyone from the FFTMa Propagation Monitoring Team.',0,'L',false);


$pdf->Cell(70);

$pdf->Write(15,'Region:_____________________');

$pdf->Ln(3);
$pdf->Cell(86);

$pdf->Write(15,'Coordinator');

$pdf->Ln(-3);
$pdf->Cell(115);

$pdf->Write(15,'Confirmed by:______________________');
$pdf->Ln(3);
$pdf->Cell(140);

$pdf->Write(15,'R.O/Elder');

$pdf->Ln(-3);
$pdf->Cell(170);
$pdf->Write(15,'Noted by:____________________________');
$pdf->Ln(3);
$pdf->Cell(188);

$pdf->Write(15,'Co-Worker');


$pdf->Ln(-3);
$pdf->Cell(227);
$pdf->Write(15,'________________________________');
$pdf->Ln(3);
$pdf->Cell(245);

$pdf->Write(15,'Contact No');


$pdf->Ln(-10);




$pdf->Ln();



// $pdf->Setwidths(Array(15,15,15,17,16,16,17,17,17,17,22,19,19,22,17,18));
//  $pdf->setAligns(Array('C','C','C','C','L','C','C','C','C','C','C','C','L'));
//  $pdf->SetLineHeight(5);
//  $pdf->Row(Array('Week type','Home Preached','Person Contacted','Person who Received the gospel/called','Gospel friends open for follow-up','Baptism','New home meetings started','Total home meetings held','Total persons home met','Persons Visited but not home met','New small group meetings established','Total small group meetings held','Local saints joining propagation','Total man-hours of local saints joining propagation','LTM Attendance','Total Trainee team-hours (in hours)'));

$pdf->Ln(-19);

   $user_query = mysql_query("select DISTINCT CONCAT(First_Name, ' ',Last_Name) AS Trainee,FT  
from weekspropagation AS wkprop
INNER JOIN historyfeedback on historyfeedback.id=wkprop.historyfeedback_id
inner join month on month.id=historyfeedback.MONTH
inner join year on year.id=historyfeedback.YEAR 
INNER JOIN batch on batch.id=historyfeedback.BATCH 
INNER JOIN accounts AS acct ON acct.id = wkprop.accounts_id
INNER JOIN locality AS lcty ON acct.locality = lcty.ID
INNER JOIN current_teamdata AS ct ON ct.userlevel_id = acct.USER_LEVEL
INNER JOIN teammate AS team ON ct.c_team_id = team.currentteam_id AND team.locality_id = lcty.ID
INNER JOIN trainee_info AS trainee ON team.trainee_id = trainee.trainee_id
INNER JOIN class ON class.ID = trainee.Term

where   accounts_id='".$_GET['SessionId']."' and  batch.BATCH='".$_GET['TermNumber']."'

")or die(mysql_error());
                              while($row = mysql_fetch_array($user_query)){

                             
                    $pdf->Cell(14);
                    $pdf->Rows(Array($row['Trainee'],$row['FT']));    
        


 }




//  // $pdf->viewTable();
// // $pdf->weekone($sql);
// $pdf->homespreach();
// // $pdf->week();

 $pdf->Output();
?>