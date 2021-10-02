
<?php
include('../koneksi.php');
  if($_GET['aksi']=='tambah'){
  	$id = isset($_POST['txtIdObat'])?$_POST['txtIdObat']:'';
    $nama = isset($_POST['txtNamaObat'])?$_POST['txtNamaObat']:'';
  	$satuan = isset($_POST['txtSatuan'])?$_POST['txtSatuan']:'';
    $exp = isset($_POST['txtExp'])?$_POST['txtExp']:'';
  	$harga = isset($_POST['txtHarga'])?$_POST['txtHarga']:'';
  	$ket = isset($_POST['txtKet'])?$_POST['txtKet']:'';
      if(isset($_POST['btnSubmit'])){
        $simpan = mysqli_query($koneksi,"insert into obat values('$id','$nama','$satuan','$exp',$harga,'$ket')");
        if($simpan){
          header('location:../index.php?p=obat');
        }
      }
  }
  else if($_GET['aksi']=='ubah'){
	  $id = $_GET['id'];
    $nama = isset($_POST['txtNamaObat'])?$_POST['txtNamaObat']:'';
    $satuan = isset($_POST['txtSatuan'])?$_POST['txtSatuan']:'';
    $exp = isset($_POST['txtExp'])?$_POST['txtExp']:'';
    $harga = isset($_POST['txtHarga'])?$_POST['txtHarga']:'';
    $ket = isset($_POST['txtKet'])?$_POST['txtKet']:'';
    if(isset($_POST['btnSubmit'])){
        $edit = mysqli_query($koneksi,
        " update obat set 
    		  nama_obat = '$nama',
    		  satuan = '$satuan',
          exp = '$exp',
    		  harga = '$harga',
    		  keterangan = '$ket'
    		  where id_obat = '$id'");
          if($edit){
            header('location:../index.php?p=obat');
          };
    }
  }
  else if($_GET['aksi']=='hapus'){
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi,"delete from obat where id_obat='$id'");
    if($hapus){
        header('location:../index.php?p=obat');
    }
  }
?>
