<?php
  include('koneksi.php');
  // if($_GET['j']=='penjualan'){
  //   $data = mysqli_query($koneksi,"select * from penjualan where tgl_penjualan = now()");
  // }elseif ($_GET['j']=='pembelian') {
  //   $data = mysqli_query($koneksi,"select * from pembelian where tgl_pembelian = now()");
  // }
  // $jumlahbaris = mysqli_num_rows($data) + 1;
  // echo date('dmy').'-'.str_pad($jumlahbaris,3,'0',STR_PAD_LEFT);
  $today = date('ymd');
  if($_GET['j']=='penjualan'){
    $cari_faktur = mysqli_query($koneksi,"select max(no_resep) as last from resep where no_resep like '$today%'");
  }
  else if($_GET['j']=='pembayaran'){
    $cari_faktur = mysqli_query($koneksi,"select max(faktur) as last from pembayaran where faktur like '$today%'");
  }
  $data = mysqli_fetch_array($cari_faktur);
  if($data['last']){
    $nomor = explode("-",$data['last'],2);
    $faktur = $today.'-'.str_pad(($nomor[1]+1),3,'0',STR_PAD_LEFT);
  }else{
    $faktur = $today.'-'.'001';
  }
  echo $faktur;
?>
