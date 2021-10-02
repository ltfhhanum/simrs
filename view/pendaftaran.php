<div class="site-content">
  <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <div class="panel-tools">
              <a href="#" class="tools-icon">
                <i class="zmdi zmdi-refresh"></i>
              </a>
              <a href="#" class="tools-icon">
                <i class="zmdi zmdi-close"></i>
              </a>
            </div>
            <h3 class="panel-title">Data Pendaftaran</h3>
            <div class="panel-subtitle">Informasi data pendaftaran disini</div>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
          <?php
            $page=isset($_GET['page'])?$_GET['page']:'list';
            switch ($page) {
            case 'list':
          ?>
      
          <p><a href="?p=pendaftaran&page=entri" type="button" class="btn btn-primary m-w-120"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Tambah Data </a></p>
                <!--<p><button type="button" class="btn btn-primary m-w-120" data-toggle="modal" data-target="#otherModal1">+Tambah Data</button></p>-->
           
            <table class="table table-striped table-bordered dataTable" id="table-1">
              <thead>
                <tr>
                  <th>No Pendaftaran</th>
                  <th>Tanggal Pendaftaran</th>
                  <th>Pasien</th>
                  <!--<th>Jenis Layanan</th>-->
                  <th>Poli Tujuan</th>
                  <th>Dokter</th>
                  <th>Jasa Dokter</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $data = mysqli_query($koneksi,"select * from pendaftaran
                      INNER JOIN pasien ON pendaftaran.no_id = pasien.no_identitas
                      INNER JOIN dokter ON pendaftaran.id_dokter = dokter.id_dokter
                      INNER JOIN poliklinik ON pendaftaran.id_poli = poliklinik.id_poli");
                  $i =1;
                  while ($row=mysqli_fetch_array($data)) {
                ?>
                <tr>
                  <td><?php echo $row['no_pendaftaran']?></td>
                  <td><?php echo $row['tgl_pendaftaran']?></td>
                  <td><?php echo $row['nama_pasien']?></td>
                  <!--<td><?php echo $row['jenis_layanan']?></td>-->
                  <td><?php echo $row['nama_poli']?></td>
                  <td><?php echo $row['nama_dokter']?></td>
                  <td><?php echo number_format($row['jasa_dokter'],'0',',','.')?></td>
                  <td><a type="button" class="btn btn-success" href="?p=pendaftaran&page=update&id=<?php echo $row['no_pendaftaran']?>" >
                      <i class="zmdi zmdi-edit"></i>
                    </a>
                    <a class="btn btn-danger" href="Controller/aksiPendaftaran.php?aksi=hapus&id=<?php echo $row['no_pendaftaran']?>" 
                      onclick="return confirm('Yakin ingin menghapus?')">
                      <i class="zmdi zmdi-delete"></i>
                    </a>
                  </td>
                </tr>
                <?php $i++;}?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
        break;
        case 'entri':
        date_default_timezone_set('Asia/Jakarta');
        $tgl=date('Y-m-d h:i:s' );
        $dokter=mysqli_query($koneksi, "SELECT * FROM dokter");
        $jsArray = "var jasa = new Array();\n"; 
        
      ?>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8">        
            <form id="form1" name="form1" class="form-horizontal" method="post" action="Controller/aksiPendaftaran.php?aksi=tambah" enctype="multipart/form-data">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Tanggal Pendaftaran</label>
                <div class="fcol-sm-9">
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" name="txtTgl" class="form-control" id="form-control-6" placeholder="Tanggal Pendaftaran" value="<?= $tgl?>" readonly>
                      </div>
                    </div>
                  </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">No Identitas</label>
                <div class="col-sm-9">
                  <select name="txtNoId" class="form-control">
                    <option >Pilih Pasien
                      <?php
                        $datapoli = mysqli_query($koneksi,"SELECT * FROM pasien");
                        while($row=mysqli_fetch_array($datapoli)){
                      ?>
                        <option value="<?=$row['no_identitas'] ?>"><?=$row['nama_pasien'] ?></option>
                      <?php
                        }
                      ?>
                    </option>
                  </select>
                </div>
              </div>
              <!--<div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Jenis Layanan</label>
                <div class="col-sm-9">
                  <input type="radio" name="layanan" value="Umum"> Umum          
                  <input type="radio" name="layanan" value="BPJS"> BPJS
                </div>
              </div>-->
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Poli Tujuan</label>
                <div class="col-sm-9">
                  <select name="txtPoli" class="form-control">
                    <option >Pilih Poli
                      <?php
                        $datapoli = mysqli_query($koneksi,"SELECT * FROM poliklinik");
                        while($row=mysqli_fetch_array($datapoli)){
                      ?>
                        <option value="<?=$row['id_poli'] ?>"><?=$row['nama_poli'] ?></option>
                      <?php
                        }
                      ?>
                    </option>
                  </select>
                  <!--<select class="form-control" name="poli" id="poli" onchange="showDokter()">
                    <option value="">-- Pilih Poliklinik --</option>
                    <?php
                      $poli = mysqli_query($koneksi,"SELECT * FROM poliklinik");
                      while ($hasil = mysqli_fetch_array($poli)){
                      ?>
                        <option value="<?php echo $hasil['id_poli']?>"><?php echo $hasil['nama_poli'] ?></option>
                      <?php
                      }
                    ?>
                  </select>-->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Dokter</label>
                <div class="col-sm-9">
                  <select class="form-control" id="dokter" name="txtDokter" onchange="changeValue(this.value)" >
                    <option>Pilih Dokter</option>
                    <?php if(mysqli_num_rows($dokter)) {?>
                      <?php while($row_jasa= mysqli_fetch_array($dokter)) {?>
                        <option value="<?php echo $row_jasa["id_dokter"]?>"> <?php echo $row_jasa["nama_dokter"]?> </option>
                      <?php $jsArray .= "jasa['" . $row_jasa['id_dokter'] . "'] = {tarif:'" . addslashes($row_jasa['jasa']) . "'};\n"; } ?>
                    <?php } ?>
                  </select>
                  <!--<select class="form-control" name="dokter" id="dokter">
                    <option value="">-- Pilih Dokter --</option>
                  </select>-->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Jasa Dokter</label>
                <div class="col-sm-9">
                  <input class="form-control" type="number" name="txtJasa" id="tarif" readonly>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-9"></label>
                <div class="col-sm-9">
                  <button type="submit" name="btnSubmit" class="btn btn-primary m-w-120">Submit</button>
                  <button type="reset" name="btnReset" class="btn btn-danger m-w-120">Reset</button>
                </div>
              </div>
            </form>       
          </div>
        </div>
      </div>
      <?php
            break;
            case 'update':
            $ambil = mysqli_query($koneksi,"select * from pendaftaran where no_pendaftaran ='$_GET[id]'");
            $data = mysqli_fetch_array($ambil);
        ?>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8">        
            <form class="form-horizontal" method="post" action="Controller/aksiPendaftaran.php?aksi=ubah&id=<?php echo $data['no_pendaftaran']?>" enctype="multipart/form-data">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1"></label>
                <div class="fcol-sm-9">
                    <label for="form-control-5" class="control-label"></label>
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="form-control-5" placeholder="No Pendaftaran" value="<?= $data['no_pendaftaran']?>" readonly>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="form-control-6" placeholder="Tanggal Pendaftaran" value="<?= $data['tgl_pendaftaran']?>" readonly>
                      </div>
                    </div>
                  </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">No Identitas</label>
                <div class="col-sm-6">
                  <input class="form-control" type="text" name="txtNoId" value="<?= $data['no_id']?>">
                </div>
                <div class="col-sm-2">
                  <button type="button" name="btnCari" class="btn btn-primary m-w-120">Cari</button>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1"></label>
                <div class="col-sm-9">
                  <input class="form-control" type="text" name="txtNamaPasien" placeholder="Nama Pasien" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1"></label>
                <div class="col-sm-9">
                  <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#otherModal1">Pasien Baru</button>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Jenis Layanan</label>
                <div class="col-sm-9">
                  <?php
                  if($data['jenis_layanan'] == "Umum"){
                    echo "<input type='radio' name='layanan' value='Umum' checked='checked'> Umum &nbsp;&nbsp"; 
                    echo "<input type='radio' name='layanan' value='BPJS'> BPJS";
                  }else{
                    echo "<input type='radio' name='layanan' value='Umum'> Umum &nbsp;&nbsp";
                    echo "<input type='radio' name='layanan' value='BPJS' checked='checked'> BPJS";
                  }
                  ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Poli Tujuan</label>
                <div class="col-sm-9">
                  <select name="txtPoli" class="form-control">
                    <option >Pilih Poli
                      <?php
                        $datapoli = mysqli_query($koneksi,"SELECT * FROM poliklinik");
                        while($row=mysqli_fetch_array($datapoli)){
                      ?>
                        <option value="<?=$row['id_poli'] ?>"><?=$row['nama_poli'] ?></option>
                      <?php
                        }
                      ?>
                    </option>
                  </select>
                  <!--<select class="form-control" name="poli" id="poli" onchange="showDokter()">
                    <option value="">-- Pilih Poliklinik --</option>
                    <?php
                      $poli = mysqli_query($koneksi,"SELECT * FROM poliklinik");
                      while ($hasil = mysqli_fetch_array($poli)){
                      ?>
                        <option value="<?php echo $hasil['id_poli']?>"><?php echo $hasil['nama_poli'] ?></option>
                      <?php
                      }
                    ?>
                  </select>-->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Dokter</label>
                <div class="col-sm-9">
                  <select class="form-control" id="dokter" name="txtDokter" onchange="changeValue(this.value)" >
                    <option>Pilih Dokter</option>
                    <?php if(mysqli_num_rows($dokter)) {?>
                      <?php while($row_jasa= mysqli_fetch_array($dokter)) {?>
                        <option value="<?php echo $row_jasa["id_dokter"]?>"> <?php echo $row_jasa["nama_dokter"]?> </option>
                      <?php $jsArray .= "jasa['" . $row_jasa['id_dokter'] . "'] = {tarif:'" . addslashes($row_jasa['jasa']) . "'};\n"; } ?>
                    <?php } ?>
                  </select>
                  <!--<select class="form-control" name="dokter" id="dokter">
                    <option value="">-- Pilih Dokter --</option>
                  </select>-->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Jasa Dokter</label>
                <div class="col-sm-9">
                  <input class="form-control" type="number" name="txtNoId" value="<?= $data['jasa_dokter']?>" readonly>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-9"></label>
                <div class="col-sm-9">
                  <button type="submit" name="btnSubmit" class="btn btn-primary m-w-120">Update</button>
                  <button type="reset" name="btnReset" class="btn btn-danger m-w-120">Cancel</button>
                </div>
              </div>
            </form>       
          </div>
        </div>
      </div>
      <?php 
        break;
        } 
      ?>
    </div>
</div>

<div id="otherModal1" class="modal fade" tabindex="-1" role="dialog">
    <form method="post" action="Controller/aksiPendaftaran.php?aksi=tambahpasien">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">
                      <i class="zmdi zmdi-close"></i>
                  </span>
                </button>
                <h4 class="modal-title">Entri Data Pasien</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form-control-1" class="control-label">No Identitas</label>
                    <input type="text" name="txtNoId" class="form-control" id="form-control-1" placeholder="KTP/SIM/PASSPORT">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Nama</label>
                    <input type="text" name="txtNamaPasien" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Jenis Kelamin</label><br>
                    <input type="radio" name="jk" value="Laki-Laki"> Laki-Laki &nbsp           
                    <input type="radio" name="jk" value="Perempuan"> Perempuan
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Tanggal Lahir</label>
                    <input name="txtLahir" class="form-control" type="date" data-inputmask="'alias': 'dd-mm-yyyy'">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Umur</label>
                    <input type="number" name="txtUmur" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">No Telepon</label>
                    <input type="number" name="txtTelepon" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Alamat</label>
                    <textarea id="form-control-4" name="txtAlamat" class="form-control" rows="3" placeholder=""></textarea>
                </div>
              <div class="modal-footer text-center">
              <button type="submit" name="btnSubmit" class="btn btn-primary">Simpan</button>
              <button type="reset" data-dismiss="modal" class="btn btn-danger">Cancel</button>
          </div>
          </div>
      </div>
  </div>
  </form>
</div>
<script type="text/javascript">
    <?php echo $jsArray; ?>
    function changeValue(id_dokter) {
      document.getElementById("tarif").value = jasa[id_dokter].tarif;
    };
</script> 
<script>
   
    $("#poli").change(function(){
   
        // variabel dari nilai combo box provinsi
        var id_poli = $("#poli").val();
       
       
        // mengirim dan mengambil data
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "cari_dokter.php",
            data: "prov="+id_poli,
            success: function(msg){
               
                // jika tidak ada data
                if(msg == ''){
                    alert('Tidak ada data Dokter');
                }
               
                // jika dapat mengambil data,, tampilkan di combo box kota
                else{
                    $("#dokter").html(msg);                                                     
                }
               
                
            }
        });    
    });
</script>