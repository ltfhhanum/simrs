
<?php
  include('../koneksi.php');
  require('../FPDF/fpdf.php');
  $pdf = new FPDF();
  $pdf->addPage();
  $pdf->setFont('Arial','B',12);
  $pdf->Cell(180,30,'LAPORAN DATA PEMBAYARAN',0,1,'C');
  $pdf->Line(15, 45, 210-14, 45);
  $pdf->Cell(180,-20,'SIRS',0,1,'C');
  $pdf->Cell(180,30,'Jln. Pauh No.12',0,1,'C');
  $pdf->setFont('Arial','i',8);
  $pdf->Cell(180,-20,'No Telp. 085263775112',0,1,'C');
  $yi = 100;
  $ya = 48;
  $pdf->setFont('Arial','',9);
  $pdf->setFillColor(222,222,222);
  $pdf->setXY(20,$ya);
  $pdf->CELL(6,6,'NO',1,0,'C',1);
  $pdf->CELL(35,6,'No Faktur',1,0,'C',1);
  $pdf->CELL(35,6,'No Pendaftaran',1,0,'C',1);
  $pdf->CELL(35,6,'No RM',1,0,'C',1);
  $pdf->CELL(30,6,'Total Bayar',1,0,'C',1);
  $pdf->setXY(20,$ya+5);
  $i=1;
  $up=5;
  $query = mysqli_query($koneksi, "select * from pembay");
  while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(6,6,$i,1,0,'C',1);
    $pdf->Cell(35,6,$row['faktur'],1,0,'C',1);
    $pdf->Cell(35,6,$row['no_pendaftaran'],1,0,'C',1);
    $pdf->Cell(35,6,$row['no_rm'],1,0,'C',1);
    $pdf->Cell(30,6,$row['total_bayar'],1,0,'C',1);
    $pdf->setXY(20,$ya+10+$up);
    $i++;
    $up=$up+5;
  }

  $pdf->Output();
?>
