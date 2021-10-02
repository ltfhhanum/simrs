
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
  	$id = isset($_POST['txtNoRm'])?$_POST['txtNoRm']:'';
    $nop = isset($_POST['txtNoPendaftaran'])?$_POST['txtNoPendaftaran']:'';
    $keluhan = isset($_POST['txtKeluhan'])?$_POST['txtKeluhan']:'';
  	$diagnosa = isset($_POST['txtDiagnosa'])?$_POST['txtDiagnosa']:'';
  	$tindakan = isset($_POST['txtTindakan'])?$_POST['txtTindakan']:'';
    $bea = isset($_POST['txtBiaya'])?$_POST['txtBiaya']:'';
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into rm values('$id','$nop','$keluhan','$diagnosa','$tindakan','$bea')");
        if($simpan){
          header('location:../index.php?p=rekammedis');
        }
      }
  }
  else if($_GET['aksi']=='ubah'){
	  $id = $_GET['id'];
    $nop = isset($_POST['txtNoPendaftaran'])?$_POST['txtNoPendaftaran']:'';
    $keluhan = isset($_POST['txtKeluhan'])?$_POST['txtKeluhan']:'';
    $diagnosa = isset($_POST['txtDiagnosa'])?$_POST['txtDiagnosa']:'';
    $tindakan = isset($_POST['txtTindakan'])?$_POST['txtTindakan']:'';
    $bea = isset($_POST['txtBiaya'])?$_POST['txtBiaya']:'';
    if(isset($_POST['btnSubmit'])){
        $edit = mysqli_query($koneksi,
        " update rm set 
    		  keluhan = '$keluhan',
    		  diagnosa = '$diagnosa',
          tindakan = '$tindakan',
          biaya = '$bea'
    		  where no_rm = $id");
          if($edit){
            header('location:../index.php?p=rekammedis');
          };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi,"delete from rm where no_rm ='$id'");
    if($hapus){
        header('location:../index.php?p=rekammedis');
    }
  }
?>

  