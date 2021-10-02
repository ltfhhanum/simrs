<?php
  include('../koneksi.php');
  $hal = isset($_GET['p'])?$_GET['p']:'beranda';
  if($hal=="beranda"){
    include('../frontend/vc/beranda.php');
  }
  if($hal=="dokter"){
    include('../frontend/vc/dokter.php');
  }
  if($hal=="poliklinik"){
    include('../frontend/vc/poliklinik.php');
  }
  if($hal=="kontak"){
    include('../frontend/vc/kontak.php');
  }
  
 ?>
