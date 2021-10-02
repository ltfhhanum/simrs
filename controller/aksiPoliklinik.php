
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
    $nama = isset($_POST['txtNamaPoli'])?$_POST['txtNamaPoli']:'';
    $ket = isset($_POST['txtKeterangan'])?$_POST['txtKeterangan']:'';
    $page = $_GET['page'];
    if(isset($_POST['btnSubmit'])){
      $simpan = mysqli_query($koneksi,"insert into poliklinik values(0,'$nama','$ket')");
      if($simpan){
        header('location:../index.php?p=poliklinik');
      }
    }
  }
  else if($_GET['aksi']=='ubah'){
    $id = $_GET['id'];
    $nama = isset($_POST['txtNamaPoli'])?$_POST['txtNamaPoli']:'';
    $gedung = isset($_POST['txtKeterangan'])?$_POST['txtKeterangan']:'';
    if(isset($_POST['btnSubmit'])){
      $edit = mysqli_query($koneksi,
      "update poliklinik
      set nama_poli = '$nama',
	  keterangan = '$gedung'
      where id_poli = $id");
      if($edit){
        header('location:../index.php?p=poliklinik');
      };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $hapus = mysqli_query($koneksi,"delete from poliklinik where id_poli='$_GET[id]'");
    if($hapus){
        header('location:../index.php?p=poliklinik');
    }
  }
?>
