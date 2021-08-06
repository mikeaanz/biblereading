<?php 

 $sql=mysql_select_db('dbmonitoring',mysql_connect('localhost','root',''))or die(mysql_error());
    require_once('../fttma/fpdf/fpdf.php'); 

    class myPDF extends FPDF{
      function myCell($w,$h,$x,$t){

        $heigh=$h/3;
        $first = $heigh+2;
        $second=$heigh+$heigh+$heigh+3;
        $len = strlen($t);
        if($len>15){
          $txt=str_split($t,15);
          $this->set($x);
          $this->Cell($w,$first,$txt[0],'','','');


        }
      }





      function header(){

      $this->Image('../Admin/img/logo.png',70,6,30);
      $this->setfont('Arial','B', 14);

        $this->Ln();
              $this->Ln();
              $this->Cell(97);
      $this->Cell(276,5,'FTTMA - FullTime Training in Malabon');
      $this->Ln();
      $this->setfont('Times','',12);
      $this->Cell(270,10,'47 Sisa St, Acacia, Malabon City',0,0,'C');
      $this->Ln(20);
          }


          function footer(){
              $this->sety(-15);
              $this->setfont('Arial','',8);
              $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

          }

          function headerTable(){

            $this->Setfont('Times','B',12);
            $this->Cell(20,10,'Homes Knock',1,0,'C');
            $this->Cell(40,10,'ID',1,0,'C');
            $this->Cell(60,10,'ID',1,0,'C');
               $this->Cell(60,10,'ID',1,0,'C');
                  $this->Cell(60,10,'ID',1,0,'C');
                     $this->Cell(60,10,'ID',1,0,'C');
                        $this->Cell(60,10,'ID',1,0,'C');
                           $this->Cell(60,10,'ID',1,0,'C');
                              $this->Cell(60,10,'ID',1,0,'C');
                                 $this->Cell(60,10,'ID',1,0,'C');
            $this->Ln();

          }

          function viewTable(){
         
         
  


          }
          }
$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable();
$pdf->myCell();
$pdf->Output();
?>