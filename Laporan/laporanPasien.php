
<?php
  include('../koneksi.php');
  require('../FPDF/fpdf.php');
  $pdf = new FPDF();
  $pdf->addPage();
  $pdf->setFont('Arial','B',12);
  $pdf->Cell(180,30,'LAPORAN DATA PASIEN',0,1,'C');
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
  $pdf->CELL(35,6,'Nama Pasien',1,0,'C',1);
  $pdf->CELL(60,6,'Alamat',1,0,'C',1);
  $pdf->CELL(25,6,'Jenis Kelamin',1,0,'C',1);
  $pdf->CELL(20,6,'Umur',1,0,'C',1);
  $pdf->CELL(30,6,'Telp',1,0,'C',1);
  $pdf->setXY(20,$ya+5);
  $i=1;
  $up=5;
  $query = mysqli_query($koneksi, "select * from pasien");
  while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(6,6,$i,1,0,'C',1);
    $pdf->Cell(35,6,$row['nama_pasien'],1,0,'C',1);
    $pdf->Cell(60,6,$row['alamat'],1,0,'C',1);
    $pdf->Cell(25,6,$row['jk'],1,0,'C',1);
    $pdf->Cell(20,6,$row['umur'],1,0,'C',1);
    $pdf->Cell(30,6,$row['telepon'],1,0,'C',1);
    $pdf->setXY(20,$ya+10+$up);
    $i++;
    $up=$up+5;
  }

  $pdf->Output("laporan_pasien.pdf","I");
?>
