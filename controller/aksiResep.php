<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambahdetail'){
    $obat = isset($_POST['cmbObat'])?$_POST['cmbObat']:'';
    $harga = isset($_POST['txtHarga'])?$_POST['txtHarga']:'';
    $jum = isset($_POST['txtJumlah'])?$_POST['txtJumlah']:'';
    $subtotal = isset($_POST['txtSubtotal'])?$_POST['txtSubtotal']:'';
    $id = isset($_POST['noFakturDetail'])?$_POST['noFakturDetail']:'';
    $page = $_GET['page'];
    if(isset($_POST['btnSubmit'])){

      $simpan = mysqli_query($koneksi,"insert into detail_resep(no_resep,id_obat,harga,jumlah,sub_total) values ('$id','$obat',$harga,$jum,$subtotal)");
      if($simpan){
        if($page=="update"){
          header('location:../index.php?p=resep&page=update&faktur='.$id);
        } else{
          header('location:../index.php?p=resep&page=entri');
        }
      }
    }
  }

  else if($_GET['aksi']=='tambah'){
    $noresep = isset($_POST['txtNoFaktur'])?$_POST['txtNoFaktur']:'';
    $norm = isset($_POST['txtNoRm'])?$_POST['txtNoRm']:'';
    $total = isset($_POST['txtTotal'])?$_POST['txtTotal']:'';
    session_start();
    $user = $_SESSION['user'];
    if(isset($_POST['btnSubmit'])){
      $simpan = mysqli_query($koneksi,"insert into resep (no_resep,no_rm,total_harga,apoteker) values ('$noresep', '$norm', $total,'$user')");
      if($simpan){
        header('location:../index.php?p=resep');
      }
    }
  }
  else if($_GET['aksi']=='ubah'){
    $noresep = $_GET['faktur'];
    $norm = isset($_POST['txtNoRm'])?$_POST['txtNoRm']:'';
    $total = isset($_POST['txtTotal'])?$_POST['txtTotal']:'';
    session_start();
    $user = $_SESSION['user'];
    if(isset($_POST['btnSubmit'])){
      $update = mysqli_query($koneksi,"
        update resep
        set 
        total_harga = $total,
        username = '$user'
        where no_resep = '$noresep'");
      if($update){
        header('location:../index.php?p=resep');
      }
    }
  }
  else if($_GET['aksi']=='hapus'){
    $hapus = mysqli_query($koneksi,"delete from resep where no_resep='$_GET[faktur]'");
    $hapusdetail = mysqli_query($koneksi,"delete from detail_resep where no_resep='$_GET[faktur]'");
    if($hapus&&$hapusdetail){
        header('location:../index.php?p=resep');
    }
  }
  else if($_GET['aksi']=='hapusdetail'){
    $hapus = mysqli_query($koneksi,"delete from detail_resep where id ='$_GET[id]'");
    $page = $_GET['page'];
    if($hapus){
        if($page=="update"){
          header('location:../index.php?p=resep&page=update&faktur='.$_GET['no_resep']);
        }else{
          header('location:../index.php?p=resep&page=entri');
        }
    }
  }
?>
