
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
    $nama = isset($_POST['txtNamaTindakan'])?$_POST['txtNamaTindakan']:'';
    $ket = isset($_POST['txtBiaya'])?$_POST['txtBiaya']:'';
    $page = $_GET['page'];
    if(isset($_POST['btnSubmit'])){
      $simpan = mysqli_query($koneksi,"insert into tindakan values(0,'$nama',$ket)");
      if($simpan){
        header('location:../index.php?p=tindakan');
      }
    }
  }
  else if($_GET['aksi']=='ubah'){
    $id = $_GET['id'];
    $nama = isset($_POST['txtNamaTindakan'])?$_POST['txtNamaTindakan']:'';
    $bea = isset($_POST['txtBiaya'])?$_POST['txtBiaya']:'';
    if(isset($_POST['btnSubmit'])){
      $edit = mysqli_query($koneksi,
      "update tindakan
      set nama_tindakan = '$nama',
	    biaya = $bea
      where id_tindakan = $id");
      if($edit){
        header('location:../index.php?p=tindakan');
      };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $hapus = mysqli_query($koneksi,"delete from tindakan where id_tindakan='$_GET[id]'");
    if($hapus){
        header('location:../index.php?p=tindakan');
    }
  }
?>
