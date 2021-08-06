<?php

    require_once('../fttma/fpdf/fpdf.php'); 
    require_once 'functions/db.php';


$pdf = new FPDF('L','mm','A3');

$pdf->AddPage();

$pdf->Setfont('Times','B',15);
$pdf->Image('../Admin/img/logo.png',150,6,30);
$pdf->Image('../Admin/img/fttma.jpg',270,11,30);
$pdf->Cell(180);
$pdf->Cell(70,10,'FullTime Training in Malabon',0,39);


$pdf->Ln(1);



$pdf->Cell(170);
$pdf->Cell(1,1,'19 Liwayway St, Acacia, Malabon City',0,0);
$pdf->Ln(1);

$pdf->Cell(180);
$pdf->Cell(1,10,'Metro Manila, Philippines 1474',0,0);
$pdf->Ln(7);

$pdf->Setfont('Times','',15);
$pdf->Cell(170);
$pdf->Cell(1,10,'Term:____',0,0);

$pdf->Cell(30);
$pdf->Cell(1,10,'type of Assignment:____',0,0);


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
//counting week propagation
      $user_query = mysql_query("SELECT FullName, address,ContactNumber,week.week,shp.shepcode,ax.shepcode,ar.shepcode FROM monitored_contact INNER JOIN contatcdetails ON contatcdetails.contact_id = monitored_contact.contact_id INNER join shepherd_code as shp on shp.shep_id=monitored_contact.day_one INNER JOIN shepherd_code as ax on ax.shep_id=monitored_contact.day_two INNER JOIN shepherd_code as ar on ar.shep_id=monitored_contact.day_three INNER JOIN historyfeedback ON historyfeedback.id = monitored_contact.historyfeedback INNER JOIN month on historyfeedback.MONTH=month.ID INNER JOIN year on historyfeedback.YEAR=year.ID INNER JOIN batch on historyfeedback.BATCH=batch.ID INNER JOIN week on historyfeedback.WEEK=week.ID INNER JOIN userlevel on historyfeedback.acc_id=userlevel.ID ")or die(mysql_error());
                                                    while($row = mysql_fetch_array($user_query)){

                                                           $week = $row['week'];


$pdf->Cell(23,5,$week,1,0,'C');
//test
// $pdf->Cell(23,5,$week,1,0,'C');
// $pdf->Cell(23,5,$week,1,0,'C');
// $pdf->Cell(23,5,$week,1,0,'C');
// $pdf->Cell(23,5,$week,1,0,'C');
// $pdf->Cell(23,5,$week,1,0,'C');

}
$pdf->Ln();
//cell name 
$pdf->Cell(50,5,'Name',1,0,'C');
$pdf->Cell(35,5,'Address',1,0,'C');
$pdf->Cell(35,5,'Contact No(s).',1,0,'C');
      $user_query = mysql_query("SELECT FullName, address,ContactNumber,week.week,shp.shepcode,ax.shepcode,ar.shepcode FROM monitored_contact INNER JOIN contatcdetails ON contatcdetails.contact_id = monitored_contact.contact_id INNER join shepherd_code as shp on shp.shep_id=monitored_contact.day_one INNER JOIN shepherd_code as ax on ax.shep_id=monitored_contact.day_two INNER JOIN shepherd_code as ar on ar.shep_id=monitored_contact.day_three INNER JOIN historyfeedback ON historyfeedback.id = monitored_contact.historyfeedback INNER JOIN month on historyfeedback.MONTH=month.ID INNER JOIN year on historyfeedback.YEAR=year.ID INNER JOIN batch on historyfeedback.BATCH=batch.ID INNER JOIN week on historyfeedback.WEEK=week.ID INNER JOIN userlevel on historyfeedback.acc_id=userlevel.ID ")or die(mysql_error());
                                                    while($row = mysql_fetch_array($user_query)){

                                                           $week = $row['week'];

// $pdf->Cell(60,10,'Metro Manila, Philippines 1474',0,30);

$pdf->Cell(5,5,'1',1,0,'C');
$pdf->Cell(5,5,'2',1,0,'C');
$pdf->Cell(5,5,'3',1,0,'C');
$pdf->Cell(4,5,'4',1,0,'C');
$pdf->Cell(4,5,'5',1,0,'C');
//test

// $pdf->Cell(5,5,'1',1,0,'C');
// $pdf->Cell(5,5,'2',1,0,'C');
// $pdf->Cell(5,5,'3',1,0,'C');
// $pdf->Cell(4,5,'4',1,0,'C');
// $pdf->Cell(4,5,'5',1,0,'C');

// $pdf->Cell(5,5,'1',1,0,'C');
// $pdf->Cell(5,5,'2',1,0,'C');
// $pdf->Cell(5,5,'3',1,0,'C');
// $pdf->Cell(4,5,'4',1,0,'C');
// $pdf->Cell(4,5,'5',1,0,'C');

// $pdf->Cell(5,5,'1',1,0,'C');
// $pdf->Cell(5,5,'2',1,0,'C');
// $pdf->Cell(5,5,'3',1,0,'C');
// $pdf->Cell(4,5,'4',1,0,'C');
// $pdf->Cell(4,5,'5',1,0,'C');


// $pdf->Cell(5,5,'1',1,0,'C');
// $pdf->Cell(5,5,'2',1,0,'C');
// $pdf->Cell(5,5,'3',1,0,'C');
// $pdf->Cell(4,5,'4',1,0,'C');
// $pdf->Cell(4,5,'5',1,0,'C');

// $pdf->Cell(5,5,'1',1,0,'C');
// $pdf->Cell(5,5,'2',1,0,'C');
// $pdf->Cell(5,5,'3',1,0,'C');
// $pdf->Cell(4,5,'4',1,0,'C');
// $pdf->Cell(4,5,'5',1,0,'C');




}
$pdf->Ln();

 $user_query = mysql_query("SELECT FullName, address,ContactNumber,week.week,shp.shepcode,ax.shepcode,ar.shepcode FROM monitored_contact INNER JOIN contatcdetails ON contatcdetails.contact_id = monitored_contact.contact_id INNER join shepherd_code as shp on shp.shep_id=monitored_contact.day_one INNER JOIN shepherd_code as ax on ax.shep_id=monitored_contact.day_two INNER JOIN shepherd_code as ar on ar.shep_id=monitored_contact.day_three INNER JOIN historyfeedback ON historyfeedback.id = monitored_contact.historyfeedback INNER JOIN month on historyfeedback.MONTH=month.ID INNER JOIN year on historyfeedback.YEAR=year.ID INNER JOIN batch on historyfeedback.BATCH=batch.ID INNER JOIN week on historyfeedback.WEEK=week.ID INNER JOIN userlevel on historyfeedback.acc_id=userlevel.ID GROUP BY FullName ORDER BY address , ContactNumber,week.week")or die(mysql_error());
                                                    while($row = mysql_fetch_array($user_query)){

                                                           $Name = $row['FullName'];
                                                            $Address = $row['address'];
                                                             $Contact = $row['ContactNumber'];
                                                               $week = $row['week'];

//Data address Name
$pdf->Cell(50,10,$Name,1,0);
$pdf->Cell(35,10,$Address,1,0);
$pdf->Cell(35,10,$Contact,1,0);


}

    $user_query = mysql_query("SELECT FullName, address,ContactNumber,week.week,shp.shepcode as one,ax.shepcode as two ,ar.shepcode as three FROM monitored_contact 
        INNER JOIN contatcdetails ON contatcdetails.contact_id = monitored_contact.contact_id 
        INNER join shepherd_code as shp on shp.shep_id=monitored_contact.day_one
         INNER JOIN shepherd_code as ax on ax.shep_id=monitored_contact.day_two
          INNER JOIN shepherd_code as ar on ar.shep_id=monitored_contact.day_three
           INNER JOIN historyfeedback ON historyfeedback.id = monitored_contact.historyfeedback
            INNER JOIN month on historyfeedback.MONTH=month.ID
             INNER JOIN year on historyfeedback.YEAR=year.ID 
             INNER JOIN batch on historyfeedback.BATCH=batch.ID 
             INNER JOIN week on historyfeedback.WEEK=week.ID
              INNER JOIN userlevel on historyfeedback.acc_id=userlevel.ID
            
               ")or die(mysql_error());
                                                    while($row = mysql_fetch_array($user_query)){

                                                           $shp = $row['one'] ;

                                                           $ax = $row['two'] ;

                                                           $ar = $row['three'] ;


                                                       

                                           

$pdf->Setfont('Arial','B',6);
$pdf->setTextColor(54, 113, 214);
$pdf->Cell(5,10,$shp,1,0,'C');
$pdf->Cell(5,10,$ax,1,0,'C');
$pdf->Cell(5,10,$ar,1,0,'C');
$pdf->Cell(4,10,'',1,0,'C');
$pdf->Cell(4,10,'',1,0,'C');



//test

// $pdf->Setfont('Arial','B',6);
// $pdf->setTextColor(54, 113, 214);
// $pdf->Cell(5,10,$shp,1,0,'C');
// $pdf->Cell(5,10,$ax,1,0,'C');
// $pdf->Cell(5,10,$ar,1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');

// $pdf->Setfont('Arial','B',6);
// $pdf->setTextColor(54, 113, 214);
// $pdf->Cell(5,10,$shp,1,0,'C');
// $pdf->Cell(5,10,$ax,1,0,'C');
// $pdf->Cell(5,10,$ar,1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');

// $pdf->Setfont('Arial','B',6);
// $pdf->setTextColor(54, 113, 214);
// $pdf->Cell(5,10,$shp,1,0,'C');
// $pdf->Cell(5,10,$ax,1,0,'C');
// $pdf->Cell(5,10,$ar,1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');


// $pdf->Setfont('Arial','B',6);
// $pdf->setTextColor(54, 113, 214);
// $pdf->Cell(5,10,$shp,1,0,'C');
// $pdf->Cell(5,10,$ax,1,0,'C');
// $pdf->Cell(5,10,$ar,1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');

// $pdf->Setfont('arial','B',6);
// $pdf->setTextColor(54, 113, 214);
// $pdf->Cell(5,10,$shp,1,0,'C');
// $pdf->Cell(5,10,$ax,1,0,'C');
// $pdf->Cell(5,10,$ar,1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');
// $pdf->Cell(4,10,'',1,0,'C');




}
$pdf->Ln();

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
$pdf->Write(5,'Gospel Team Members ');
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
$pdf->Cell(350);
$pdf->Write(15,'_____________________ ');
$pdf->Ln(6);
$pdf->Cell(357);
$pdf->Write(15,'Training Assistant');

$pdf->SetFont('','U');
$pdf->Write(5,'');








$pdf->Output();
?>