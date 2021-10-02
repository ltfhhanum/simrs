<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
    $lokasifile = $_FILES['fileAp']['tmp_name'];
    $nama = isset($_POST['txtNamaUser'])?$_POST['txtNamaUser']:'';
	  $username = isset($_POST['txtUsername'])?$_POST['txtUsername']:'';
    $password = isset($_POST['txtPassword'])?md5($_POST['txtPassword']):'';
    $level = isset($_POST['txtLevel'])?$_POST['txtLevel']:'';
    $email = isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
    if(!empty($lokasifile)){
      $tipefile = $_FILES['fileAp']['type'];
      if($tipefile=="image/jpeg"){
        if(isset($_POST['btnSubmit'])){
          $namafile = $_FILES['fileAp']['name'];
          $dirapload = "../img/images/";
          $fileapload = $dirapload.$namafile;
          $simpan = mysqli_query($koneksi,"insert into user values('$username','$password','$nama','$level','$email','$namafile')");
          if($simpan){
            move_uploaded_file($lokasifile,$fileapload);
            header('location:../index.php?p=user');
          }
        }
      }
      else{
        echo "<script>alert('file harus berformat .jpg');history.go(-1);</script>";
      }
    }
    else{
      $lokasifile = '../img/';
      $namafile = 'avatar5.png';
      $dirapload = "../img/images/";
      $fileapload = $dirapload.$namafile;
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into user values('$username','$password','$nama','$level','$email','$namafile')");
        if($simpan){
          move_uploaded_file($lokasifile,$fileapload);
          header('location:../index.php?p=user');
        }
      }
    }
  }
  else if($_GET['aksi']=='ubah'){
    $lokasifile = $_FILES['fileAp']['tmp_name'];
    $tipefile = $_FILES['fileAp']['type'];
    $namafile = $_FILES['fileAp']['name'];
    $dirapload = "../img/images/";
    $fileapload = $dirapload.$namafile;
    $username = $_GET['username'];
    $password = isset($_POST['txtPassword'])?md5($_POST['txtPassword']):'';
    $level = isset($_POST['txtLevel'])?$_POST['txtLevel']:'';
    $nama = isset($_POST['txtNamaUser'])?$_POST['txtNamaUser']:'';
    $email = isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
    if(empty($namafile)){
      if(isset($_POST['btnSubmit'])){
        $edit = mysqli_query($koneksi,
        "update user
        set password = '$password',
        level = '$level',
        email = '$email',
        nama = '$nama',
		    foto = '$namafile' where username = '$username'");
        if($edit){
          // echo "<script>
          //     Swal.fire({
          //     title: 'Data User',
          //     text:'Berhasil Ditambahkan',
          //     type:'success'});
          //     </script>";
        }
      }
    }
    else{
      $queryselect = mysqli_query($koneksi,"select foto from user where username='$username'");
      $foto = mysqli_fetch_array($queryselect);
      unlink("../img/images/".$foto['foto']);
      $edit = mysqli_query($koneksi,
      "update user
      set password = '$password',
      level = '$level',
      email = '$email',
      nama = '$nama',
      foto = '$namafile' where username = '$username'");
      if($edit){
        move_uploaded_file($lokasifile,$fileapload);
        // echo "<script>
        //     Swal.fire({
        //     title: 'Data User',
        //     text:'Berhasil Ditambahkan',
        //     type:'success'});
        //     </script>";
    }
  }
  header('location:../index.php?p=user');
}
  else if($_GET['aksi']=='hapus'){
    $username = $_GET['username'];
    $queryselect = mysqli_query($koneksi,"select foto from user where username='$username'");
    $foto = mysqli_fetch_array($queryselect);
    unlink("../img/images/".$foto['foto']);
    $hapus = mysqli_query($koneksi,"delete from user where username='$username'");
    if($hapus){
        header('location:../index.php?p=user');
    }
  }
