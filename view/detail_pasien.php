<?php
        include '../koneksi.php';
        $id_pasien = $_GET['id'];
        $sql = "SELECT * FROM pasien WHERE no_identitas ='$id_pasien'";
        $hasil  =mysql_query($sql);
        $no=1;
?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">
          <i class="zmdi zmdi-close"></i>
        </span>
        </button>
        <h4 class="modal-title">Modal with form</h4>
      </div>
      <div class="modal-body">
        <?php
        include '../koneksi.php';
          $id_pasien = isset($_GET['id'])?$_GET['id']*1:0;
          $sql = "SELECT * FROM pasien WHERE no_identitas ='$id_pasien'";
          $hasil  =mysql_query($sql);
          $no=1;
        ?>
        <div class="form-group">
          <label for="form-control-1" class="control-label">No Identitas</label>
          <input type="text" name="txtNoId" class="form-control" id="form-control-1" value="<?php=$hasil['no_identitas']?>">
        </div>
        <div class="form-group">
          <label for="form-control-1" class="control-label">Nama</label>
          <input type="text" name="txtNamaPasien" class="form-control" id="form-control-1" value="<?php=$hasil['nama_pasien']?>">
        </div>
        <div class="form-group">
          <label for="form-control-1" class="control-label">Jenis Kelamin</label><br>
          <input type="radio" name="jk" value="Laki-Laki"> Laki-Laki &nbsp           
          <input type="radio" name="jk" value="Perempuan"> Perempuan
        </div>
        <div class="form-group">
          <label for="form-control-1" class="control-label">Tanggal Lahir</label>
          <input name="txtLahir" class="form-control" type="date" data-inputmask="'alias': 'dd-mm-yyyy'" value="<?php=$hasil['tgl_lahir']?>">
        </div>
        <div class="form-group">
          <label for="form-control-1" class="control-label">Umur</label>
          <input type="number" name="txtUmur" class="form-control" id="form-control-1" value="<?php=$hasil['umur']?>">
        </div>
        <div class="form-group">
          <label for="form-control-1" class="control-label">No Telepon</label>
          <input type="number" name="txtTelepon" class="form-control" id="form-control-1" value="<?php=$hasil['notelp']?>">
        </div>
        <div class="form-group">
          <label for="form-control-1" class="control-label">Alamat</label>
          <textarea id="form-control-4" name="txtAlamat" class="form-control" rows="3" placeholder=""><?php=$hasil['alamat']?></textarea>
        </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
      </div>
    </div>
  </div>
