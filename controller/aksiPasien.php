
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
  	$id = isset($_POST['txtNoId'])?$_POST['txtNoId']:'';
    $nama = isset($_POST['txtNamaPasien'])?$_POST['txtNamaPasien']:'';
  	$umur = isset($_POST['txtUmur'])?$_POST['txtUmur']:'';
    $jk = isset($_POST['jk'])?$_POST['jk']:'';
  	$lahir = isset($_POST['txtLahir'])?$_POST['txtLahir']:'';
  	$telp = isset($_POST['txtTelepon'])?$_POST['txtTelepon']:'';
    $alamat = isset($_POST['txtAlamat'])?$_POST['txtAlamat']:'';
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into pasien values('$id','$nama','$lahir','$umur','$jk','$telp','$alamat')");
        if($simpan){
          header('location:../index.php?p=pasien');
        }
      }
  }
  else if($_GET['aksi']=='ubah'){
	  $id = $_GET['id'];
    $nama = isset($_POST['txtNamaPasien'])?$_POST['txtNamaPasien']:'';
    $umur = isset($_POST['txtUmur'])?$_POST['txtUmur']:'';
    $jk = isset($_POST['jk'])?$_POST['jk']:'';
    $lahir = isset($_POST['txtLahir'])?$_POST['txtLahir']:'';
    $telp = isset($_POST['txtTelepon'])?$_POST['txtTelepon']:'';
    $alamat = isset($_POST['txtAlamat'])?$_POST['txtAlamat']:'';
    if(isset($_POST['btnSubmit'])){
        $edit = mysqli_query($koneksi,
        " update pasien set 
    		  nama_pasien = '$nama',
    		  tgl_lahir = '$lahir',
          umur = '$umur',
          jk = '$jk',
    		  notelp = '$telp',
    		  alamat = '$alamat'
    		  where no_identitas = $id");
          if($edit){
            header('location:../index.php?p=pasien');
          };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi,"delete from pasien where no_identitas ='$id'");
    if($hapus){
        header('location:../index.php?p=pasien');
    }
  }
?>

  