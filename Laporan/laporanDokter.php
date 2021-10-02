
<?php
  include('../koneksi.php');
  require('../FPDF/fpdf.php');
  $pdf = new FPDF();
  $pdf->addPage();
  $pdf->setFont('Arial','B',12);
  $pdf->Cell(180,30,'LAPORAN DATA DOKTER',0,1,'C');
  $pdf->Line(15, 45, 210-14, 45);
  $pdf->Cell(180,-20,'SIRS',0,1,'C');
  $pdf->Cell(180,30,'Jln. Pauh No.12',0,1,'C');
  $pdf->setFont('Arial','i',8);
  $pdf->Cell(180,-20,'No Telp. 0892312323445',0,1,'C');
  $yi = 100;
  $ya = 48;
  $pdf->setFont('Arial','',9);
  $pdf->setFillColor(222,222,222);
  $pdf->setXY(20,$ya);
  $pdf->CELL(6,6,'NO',1,0,'C',1);
  $pdf->CELL(35,6,'Nama Dokter',1,0,'C',1);
  $pdf->CELL(35,6,'Spesialis',1,0,'C',1);
  $pdf->CELL(60,6,'Departemen/Poli',1,0,'C',1);
  $pdf->CELL(30,6,'Jasa Konsultasi',1,0,'C',1);
  $pdf->setXY(20,$ya+5);
  $i=1;
  $up=5;
  $query = mysqli_query($koneksi, "select * from dokter,poliklinik where dokter.id_poli=poliklinik.id_poli");
  while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(6,6,$i,1,0,'C',1);
    $pdf->Cell(35,6,$row['nama_dokter'],1,0,'C',1);
    $pdf->Cell(35,6,$row['spesialis'],1,0,'C',1);
    $pdf->Cell(60,6,$row['nama_poli'],1,0,'C',1);
    $pdf->Cell(30,6,$row['jasa'],1,0,'C',1);
    $pdf->setXY(20,$ya+10+$up);
    $i++;
    $up=$up+5;
  }

  $pdf->Output("laporan_dokter.pdf","I");
?>
