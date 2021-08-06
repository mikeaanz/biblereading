<?php
  $id=$_GET['id'];
  $level=$_GET['level'];
    $batch=$_GET['batch'];
     $year=$_GET['year'];
          $month=$_GET['month'];

    
    require_once('../fttma/fpdf/fpdf.php'); 
    require_once 'functions/db.php';


$pdf = new FPDF('L','mm','A3');

$pdf->AddPage();

$pdf->Setfont('Times','B',15);
$pdf->Image('../Admin/img/logo.png',145,6,30);
$pdf->Image('../Admin/img/fttma.jpg',275,11,30);
$pdf->Cell(180);
$pdf->Cell(70,10,'FullTime Training in Malabon',0,39);


$pdf->Ln(1);



$pdf->Cell(170);
$pdf->Cell(1,1,'19 Liwayway St, Acacia, Malabon City',0,0);
$pdf->Ln(1);

$pdf->Cell(180);
$pdf->Cell(1,10,'Metro Manila, Philippines 1474',0,0);
$pdf->Ln(10);

$pdf->Setfont('Times','',15);
$pdf->Cell(170);
$pdf->Cell(1,10,'Term:____',0,0);

$pdf->Setfont('Times','',14);
$pdf->Cell(13);
$pdf->Cell(1,12,$batch,0,0);

$pdf->Cell(30);
$pdf->Cell(1,10,'Type of Assignment:________',0,0);

$pdf->Setfont('Times','',10);
$pdf->Cell(44);
$pdf->Cell(1,11,$level,0,0);


$pdf->Cell(1,23);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,10,'',0,0);
$pdf->Cell(55,5,'',0,0);
$pdf->Ln(15);
$pdf->Setfont('Times','',10);

     

$pdf->Cell(120,5,'',1,0);
$pdf->Cell(23,5,'Week 6',1,0,'C');
$pdf->Cell(23,5,'Week 7',1,0,'C');
$pdf->Cell(23,5,'Week 8',1,0,'C');
$pdf->Cell(23,5,'Week 9',1,0,'C');
$pdf->Cell(23,5,'Week 10',1,0,'C');
$pdf->Cell(23,5,'Week 11',1,0,'C');
$pdf->Cell(23,5,'Week 12',1,0,'C');
$pdf->Cell(23,5,'Week 13',1,0,'C');
$pdf->Cell(23,5,'Week 14',1,0,'C');
$pdf->Cell(23,5,'Week 15',1,0,'C');
$pdf->Cell(23,5,'Week 16',1,0,'C');
$pdf->Cell(23,5,'Week 17',1,0,'C');
$pdf->Ln();

// $pdf->Cell(120,5,'',1,0);
$pdf->Cell(38,5,'Name',1,0,'C');
$pdf->Cell(50,5,'Address',1,0,'C');
$pdf->Cell(32,5,'Contact No(s).',1,0,'C');
//counting week propagation

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');
//test

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');


$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');

$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');


$pdf->SetFillColor(140,145,155);
$pdf->Cell(5,5,'1',1,0,'C',TRUE);
$pdf->Cell(5,5,'2',1,0,'C',TRUE);
$pdf->Cell(5,5,'3',1,0,'C',TRUE);
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');


$pdf->Ln();



 $user_query = mysql_query("SELECT * from weekendrpt
  LEFT join contatcdetails on contatcdetails.contact_id=weekendrpt.contact_id
   LEFT join historyfeedback on historyfeedback.id=weekendrpt.historyfeedback_id
    LEFT join month on month.id=historyfeedback.MONTH 
    LEFT join year on year.id=historyfeedback.YEAR
     LEFT join batch on batch.id=historyfeedback.BATCH 
     LEFT join week on week.id=historyfeedback.WEEK 
     LEFT join userlevel on userlevel.id=historyfeedback.acc_id
                           where  weekendrpt.acc_id='$id' and month.MONTH='$month' and year.YR='$year' and batch.BATCH='$batch'
ORDER BY `weekendrpt`.`weekendrpt_id` ASC

                           ")or die(mysql_error());
                                                    while($row = mysql_fetch_array($user_query)){

                                                           $Name = $row['FullName'];
                                                            $Address = $row['address'];
                                                             $Contact = $row['ContactNumber'];
                                                             $six = $row['week_six'];
                                                          
                                                                 $seven = $row['week_seven'];
                                                                  $eight = $row['week_eight'];
                                                                   $nine = $row['week_nine'];
                                                                    $ten = $row['week_ten'];
                                                                     $eleven = $row['week_eleven'];
                                                                      $twelve = $row['week_twelve'];
                                                                       $thirteen = $row['week_thirteen'];
                                                                        $fourteen = $row['week_fourteen'];
                                                                         $fifthteen = $row['week_fifthteen'];
                                                                          $sixteen = $row['week_sixteen'];
                                                                                 $seventeen = $row['week_seventeen'];


//Data address Name
  $pdf->SetTextColor(20,34,59);                                                                               
 $pdf->SetFont('Times','B',8);
$pdf->Cell(38,7,$Name,1,0);
$pdf->Cell(50 ,7,$Address,1,0);
$pdf->Cell(32,7,$Contact,1,0,'C');


$pdf->SetFont('Times','B',6);
$pdf->SetFillColor(140,145,155);
$pdf->Cell(23,7,$six,1,0);
$pdf->Cell(23,7,$seven,1,0);
$pdf->Cell(23,7,$eight,1,0);
$pdf->Cell(23,7,$nine,1,0);
$pdf->Cell(23,7,$ten,1,0);
$pdf->Cell(23,7,$eleven,1,0);
$pdf->Cell(23,7,$twelve,1,0);
$pdf->Cell(23,7,$thirteen,1,0);
$pdf->Cell(23,7,$fourteen,1,0);
$pdf->Cell(23,7,$fifthteen,1,0);
$pdf->Cell(23,7,$sixteen,1,0);
$pdf->Cell(23,7,$seventeen,1,0);
    $pdf->Ln();




// $pdf->Cell(50,10,$Name,1,0);
// $pdf->Cell(35,10,$Address,1,0);
// $pdf->Cell(35,10,$Contact,1,0);
}

// $pdf->Cell(23,10,$six,1,0,'j');






$pdf->Cell(396,45,'',1,0,'C');
$pdf->SetTextColor(20,34,59);
$pdf->SetFont('Times','',12);
$pdf->Ln(5);

$pdf->Write(5,'Gospel Team Members ');
$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(6,'Name / Class ');
$pdf->Ln(5);
$pdf->Write(6,'1._______________________');
$pdf->Ln(5);
$pdf->Write(6,'2._______________________');
$pdf->Ln(5);
$pdf->Write(6,'3._______________________');
$pdf->Ln(5);
$pdf->Write(6,'4._______________________');
$pdf->Ln(5);
$pdf->Write(6,'5._______________________');
$pdf->Ln();



$pdf->SetTextColor(20,34,59);
$pdf->SetFont('Times','',12);
$pdf->Ln(-36);
$pdf->Cell(60);
$pdf->Write(5,'Area(s) of Assignment');
$pdf->Ln(5);
$pdf->Cell(58);
$pdf->Write(6,'Locality /ies:(Enumerate All)');
$pdf->Cell(190);
$pdf->Ln(5);
$pdf->Cell(58);
$pdf->Write(6,'_______________________');
$pdf->Cell(-49);
$pdf->Write(15,'_______________________');
$pdf->Ln(6);
$pdf->Cell(58);
$pdf->Write(15,'Province:_______________');
$pdf->Ln(6);
$pdf->Cell(58);

$pdf->Write(15,'Region:________________');
// Then put a blue underlined link

$pdf->Ln(-24);
$pdf->Cell(120);

$pdf->SetFont('Times','',12);
$pdf->Write(15,'CO-Contact  ');
$pdf->Write(15,'BP-Baptized ');
$pdf->Write(15,'V-Visit ');
$pdf->Write(15,'O-Out/Unavailable ');
$pdf->Write(15,'F-Fellowship  ');
$pdf->Write(15,'P-Prayer ');
$pdf->Write(15,'S-Sharing');
$pdf->Write(15,'MR-Morning Revival ');
$pdf->Write(15,'BR-Bible Reading ');
$pdf->Ln(-4);
$pdf->Cell(120);
$pdf->Write(15,'HS-Hymn Singing ');
$pdf->Write(15,'LTM-Lord table Meetings ');
$pdf->Write(15,'SG-Small Group Mtg ');
$pdf->Write(15,'Pm-Prayer Mtg ');

$pdf->Ln(10);
$pdf->Cell(120);
$pdf->Write(15,'NB#-New Believer Series ');
$pdf->Write(15,'LL#-Life Lesson ');
$pdf->Write(15,'IS$-Intensified Shepherding ');
$pdf->Write(15,'HG#-High Gospel ');
$pdf->Write(15,'AB#-After Being Saved ');
$pdf->Ln(4);
$pdf->Cell(120);
$pdf->Write(15,'TO#-Trust and Obey ');
$pdf->Write(15,'SL#-Spirit and Life ');
$pdf->Write(15,'KT#-Knowing the Truth ');


$pdf->Ln(6);
$pdf->Cell(120);
$pdf->Write(15,'Signed By:______________________ ');
$pdf->Ln(7);
$pdf->Cell(120);
$pdf->Write(15,'Contact #:_______________________ ');

$pdf->Ln(-6);
$pdf->Cell(194);
$pdf->Write(15,'Confirmed by:_______________________ ');

$pdf->Ln(5);
$pdf->Cell(230);
$pdf->Write(15,'R.O / Elder');

$pdf->Ln(-6);
$pdf->Cell(280);
$pdf->Write(15,'Noted by:_____________________ ');
$pdf->Ln(6);
$pdf->Cell(304);
$pdf->Write(15,'Co-worker');


$pdf->Ln(-6);
$pdf->Cell(349);
$pdf->Write(15,'_____________________ ');
$pdf->Ln(6);
$pdf->Cell(357);
$pdf->Write(15,'Training Assistant');

$pdf->SetFont('','U');
$pdf->Write(5,'');








$pdf->Output();


    // Go to 1.5 cm from bottom
    $pdf->SetY(-15);
    // Select Arial italic 8
    $pdf->SetFont('Arial','I',8);
    // Print current and total page numbers
    $pdf->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->Output();
?>