<?php
  include('koneksi.php');
  $nofaktur = isset($_GET['nofaktur'])?$_GET['nofaktur']:'';
  if($_GET['j']=='penjualan'){
    $data = mysqli_query($koneksi,"select sum(sub_total) as 'total' from detail_resep where no_resep = '$nofaktur'");
  }//elseif($_GET['j']=='penjualan'){
    //$data = mysqli_query($koneksi,"select sum(sub_total) as 'sub_total' from detail_penjualan where faktur = '$nofaktur'");
  //}
  $row=mysqli_fetch_array($data);
  echo $row['total'];
  //echo number_format($row['total'],'0',',','.');
?>
