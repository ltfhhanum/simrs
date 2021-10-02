<?php
    include "../koneksi.php";
   
    $sel = "select * from dokter where id_poli='".$_POST["poli"]."'";
    $q=mysqli_query($koneksi,$sel);
    while($data_dokter=mysqli_fetch_array($q)){
   
    ?>
        <option value="<?php echo $data_dokter["id_dokter"] ?>"><?php echo $data_dokter["nama_dokter"] ?></option><br>
   
    <?php
    }
?>