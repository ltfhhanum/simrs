
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
  	$id = isset($_POST['txtFaktur'])?$_POST['txtFaktur']:'';
    $tgl = isset($_POST['txtTgl'])?$_POST['txtTgl']:'';
    $nop = isset($_POST['txtNoPendaftaran'])?$_POST['txtNoPendaftaran']:'';
  	$rm = isset($_POST['txtRm'])?$_POST['txtRm']:'';
  	$nors = isset($_POST['txtNoResep'])?$_POST['txtNoResep']:'';
    $bea = isset($_POST['txtTotal'])?$_POST['txtTotal']:'';
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into pembay values('$id','$tgl','$nop','$rm','$nors','$bea')");
        if($simpan){
          header('location:../index.php?p=pembayaran');
        }
      }
  }
  else if($_GET['aksi']=='ubah'){
	  $id = $_GET['id'];
    $tgl = isset($_POST['txtTgl'])?$_POST['txtTgl']:'';
    $nop = isset($_POST['txtNoPendaftaran'])?$_POST['txtNoPendaftaran']:'';
    $rm = isset($_POST['txtRm'])?$_POST['txtRm']:'';
    $nors = isset($_POST['txtNoResep'])?$_POST['txtNoResep']:'';
    $bea = isset($_POST['txtTotal'])?$_POST['txtTotal']:'';
    if(isset($_POST['btnSubmit'])){
        $edit = mysqli_query($koneksi,
        " update pembay set 
    		  no_pendaftaran = '$nop',
    		  no_rm = '$rm',
          no_resep = '$no_rs',
          total_bayar = '$bea'
    		  where faktur = '$id'");
          if($edit){
            header('location:../index.php?p=pembayaran');
          };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi,"delete from pembay where faktur ='$id'");
    if($hapus){
        header('location:../index.php?p=pembayaran');
    }
  }
?>

  