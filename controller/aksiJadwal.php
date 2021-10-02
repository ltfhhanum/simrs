
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
  	$id = isset($_POST['txtIdDokter'])?$_POST['txtIdDokter']:'';
    $hari = isset($_POST['txtHari'])?$_POST['txtHari']:'';
    $m = isset($_POST['txtMulai'])?$_POST['txtMulai']:'';
  	$a = isset($_POST['txtAkhir'])?$_POST['txtAkhir']:'';
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into jadwal_dokter values(0,'$id','$hari','$m','$a')");
        if($simpan){
          header('location:../index.php?p=jadwaldokter');
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
    $hapus = mysqli_query($koneksi,"delete from jadwal_dokter where id_jadwal ='$id'");
    if($hapus){
        header('location:../index.php?p=jadwaldokter');
    }
  }
?>

  