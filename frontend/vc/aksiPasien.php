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
        $simpan = mysqli_query($koneksi,"insert into pasien (no_identitas,nama_pasien,tgl_lahir,jk,notelp,alamat) values('$id','$nama','$lahir',$jk','$telp','$alamat')");
        if($simpan){
          echo "<script>alert('Data Berhasil Disimpan');history.go(-1);</script>";
          header('location:../index.php?p=beranda');
        }
      }
  
?>