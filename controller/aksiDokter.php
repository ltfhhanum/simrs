
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
  	$id = isset($_POST['txtIdDokter'])?$_POST['txtIdDokter']:'';
    $nama = isset($_POST['txtNamaDokter'])?$_POST['txtNamaDokter']:'';
  	$spesialis = isset($_POST['txtSpesialis'])?$_POST['txtSpesialis']:'';
    $jk = isset($_POST['jk'])?$_POST['jk']:'';
  	$poli = isset($_POST['cmbPoli'])?$_POST['cmbPoli']:'';
  	$jasa = isset($_POST['txtJasa'])?$_POST['txtJasa']:'';
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into dokter values('$id','$nama','$jk','$spesialis','$poli','$jasa')");
        if($simpan){
          header('location:../index.php?p=dokter');
        }
      }
  }
  else if($_GET['aksi']=='ubah'){
	  $id = $_GET['id'];
    $nama = isset($_POST['txtNamaDokter'])?$_POST['txtNamaDokter']:'';
    $spesialis = isset($_POST['txtSpesialis'])?$_POST['txtSpesialis']:'';
    $jk = isset($_POST['jk'])?$_POST['jk']:'';
    $poli = isset($_POST['cmbPoli'])?$_POST['cmbPoli']:'';
    $jasa = isset($_POST['txtJasa'])?$_POST['txtJasa']:'';
    if(isset($_POST['btnSubmit'])){
        $edit = mysqli_query($koneksi,
        " update dokter set 
    		  nama_dokter = '$nama',
    		  spesialis = '$spesialis',
          jk = '$jk',
    		  id_poli = '$poli',
    		  jasa = '$jasa'
    		  where id_dokter = '$id'");
          if($edit){
            header('location:../index.php?p=dokter');
          };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi,"delete from dokter where id_dokter='$id'");
    if($hapus){
        header('location:../index.php?p=dokter');
    }
  }
?>

  