
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
  	$id = isset($_POST['txtIdDokter'])?$_POST['txtIdDokter']:'';
    $tgl = isset($_POST['txtTgl'])?$_POST['txtTgl']:'';
  	$idpasien = isset($_POST['txtNoId'])?$_POST['txtNoId']:'';
    $layanan = isset($_POST['layanan'])?$_POST['layanan']:'';
  	$poli = isset($_POST['txtPoli'])?$_POST['txtPoli']:'';
    $dokter = isset($_POST['txtDokter'])?$_POST['txtDokter']:'';
  	$jasa = isset($_POST['txtJasa'])?$_POST['txtJasa']:'';
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into pendaftaran values(0,'$tgl','$idpasien','$layanan','$poli','$dokter','$jasa')");
        if($simpan){
          header('location:../index.php?p=pendaftaran');
        }
      }
  }
  else if($_GET['aksi']=='ubah'){
	  $id = $_GET['id'];
    $tgl = isset($_POST['txtTgl'])?$_POST['txtTgl']:'';
    $idpasien = isset($_POST['txtNoId'])?$_POST['txtNoId']:'';
    $layanan = isset($_POST['layanan'])?$_POST['layanan']:'';
    $poli = isset($_POST['txtPoli'])?$_POST['txtPoli']:'';
    $dokter = isset($_POST['txtDokter'])?$_POST['txtDokter']:'';
    $jasa = isset($_POST['txtJasa'])?$_POST['txtJasa']:'';
    if(isset($_POST['btnSubmit'])){
        $edit = mysqli_query($koneksi,
        " update pendaftaran set 
    		  no_id = '$idpasien',
    		  jenis_layanan = '$layanan',
          id_poli = '$poli',
    		  id_dokter = '$dokter',
    		  jasa_dokter = '$jasa'
    		  where no_pendaftaran = '$id'");
          if($edit){
            header('location:../index.php?p=pendaftaran');
          };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi,"delete from pendaftaran where no_pendaftaran='$id'");
    if($hapus){
        header('location:../index.php?p=pendaftaran');
    }
  }
  else if($_GET['aksi']=='tambahpasien'){
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
          header('location:../index.php?p=pendaftaran&page=entri');
        }
      }
  }
?>

  