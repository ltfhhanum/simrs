<?php
    include('../koneksi.php');
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
          echo "<script>alert('Anda Telah Mendaftarkan Diri Sebagai Pasien');window.location='../index.php?p=beranda'</script>";
          //header('location:../index.php?p=beranda');
        }
      }
  
?>