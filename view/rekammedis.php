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
            <h3 class="panel-title">Data Rekam Medis</h3>
            <div class="panel-subtitle">Informasi data rekam medis disini</div>
        </div>
        <div class="panel-body">
        <div class="table-responsive">
			<?php
				$page=isset($_GET['page'])?$_GET['page']:'list';
				switch ($page) {
				case 'list':
			?>
			
                <p><a href="?p=rekammedis&page=entri" type="button" class="btn btn-primary m-w-120"><i class="zmdi zmdi-plus zmdi-hc-fw"></i>Tambah Data </a></p>
                
           
            <table class="table table-striped table-bordered dataTable" id="table-1">
              <thead>
                <tr>
                  <th>No Rekam Medis</th>
                  <th>No Pendaftaran</th>
                  <th>Keluhan</th>
                  <th>Diagnosa</th>
                  <th>Tindakan</th>
                  <th>Biaya</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from rm
                      INNER JOIN pendaftaran ON rm.no_pendaftaran = pendaftaran.no_pendaftaran
                      INNER JOIN tindakan ON rm.tindakan = tindakan.id_tindakan");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $row['no_rm']?></td>
					<td><?php echo $row['no_pendaftaran']?></td>
					<td><?php echo $row['keluhan']?></td>
					<td><?php echo $row['diagnosa']?></td>
					<td><?php echo $row['nama_tindakan']?></td>
					<td><?php echo number_format($row['biaya'],'0',',','.')?></td>
					<td><a type="button" class="btn btn-success" href="?p=rekammedis&page=update&id=<?php echo $row['no_rm']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>
						<a class="btn btn-danger" href="Controller/aksiRm.php?aksi=hapus&id=<?php echo $row['no_rm']?>" 
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
			//date_default_timezone_set('Asia/Jakarta');
			//$tgl=date('Y-m-d h:i:s' );
			$nop = mysqli_query($koneksi,"SELECT * FROM pendaftaran");
			$t = mysqli_query($koneksi,"SELECT * FROM tindakan");
			$jsArray = "var nama = new Array();\n";
			$rsArray = "var bea = new Array();\n";
			$rm = 'RM';
			$no_rm = mysqli_query($koneksi,"select max(no_rm) as last from rm where no_rm like '$rm%'");
			$data = mysqli_fetch_array($no_rm);
			if($data['last']){
			  $nomor = explode("-",$data['last'],2);
			  $koderm = $rm.'-'.str_pad(($nomor[1]+1),3,'0',STR_PAD_LEFT);
			}else{
			  $koderm = $rm.'-'.'001';
			}
		?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiRm.php?aksi=tambah" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" >No RM</label>
							<div class="col-sm-3">
								<input class="form-control" type="text" name="txtNoRm"  id="txtNoRm" value="<?php echo $koderm?>" readonly>
							</div>
							<label class="col-sm-2 control-label">No Pendaftaran</label>
							<div class="col-sm-4 ">
								<select name="txtNoPendaftaran" class="form-control">
									<option >Pilih No Pendaftaran
										<?php
											$datapoli = mysqli_query($koneksi,"SELECT * FROM pendaftaran");
											while($row=mysqli_fetch_array($datapoli)){
										?>
											<option value="<?=$row['no_pendaftaran'] ?>"><?=$row['no_pendaftaran'] ?></option>
										<?php
											}
										?>
									</option>
								</select>
							</div>
							
						</div>	
						<div class="form-group">
							
						</div>
						<hr>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Keluhan</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtKeluhan"></textarea>
							</div>
						</div>		
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Diagnosa</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtDiagnosa"></textarea>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Tindakan</label>
							<div class="col-sm-9">
								<select class="form-control" id="txtTindakan" name="txtTindakan" onchange="changeValue(this.value)" >
				                    <option>Pilih Tindakan</option>
				                    <?php if(mysqli_num_rows($t)) {?>
				                      <?php while($row_t= mysqli_fetch_array($t)) {?>
				                        <option value="<?php echo $row_t["id_tindakan"]?>"> <?php echo $row_t["nama_tindakan"]?> </option>
				                      <?php $rsArray .= "bea['" . $row_t['id_tindakan'] . "'] = {txtBiaya:'" . addslashes($row_t['biaya']) . "'};\n"; } ?><?php } ?>
				                </select>
							</div>
						</div>		
						<div class="form-group">
							<label class="col-sm-3 control-label" >Biaya</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="txtBiaya"  id="txtBiaya" readonly>
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
            $ambil = mysqli_query($koneksi,"select * from rm where no_rm ='$_GET[id]'");
            $data = mysqli_fetch_array($ambil);
            $t = mysqli_query($koneksi,"SELECT * FROM tindakan");
			$jsArray = "var nama = new Array();\n";
        ?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiRm.php?aksi=ubah&id=<?php echo $data['no_rm']?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" >No RM</label>
							<div class="col-sm-3">
								<input class="form-control" type="text" name="txtNoRm"  id="txtNoRm" value="<?= $data['no_rm']?>" readonly>
							</div>
							<label class="col-sm-2 control-label">No Pendaftaran</label>
							<div class="col-sm-3">
								<input class="form-control" type="text" name="txtNoPendaftaran"  id="txtNoPendaftaran" value="<?= $data['no_pendaftaran']?>" readonly>
							</div>
						</div>	
						<div class="form-group">
							
						</div>
						<hr>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Keluhan</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtKeluhan"><?= $data['keluhan']?></textarea>
							</div>
						</div>		
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Diagnosa</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtDiagnosa"><?= $data['diagnosa']?></textarea>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Tindakan</label>
							<div class="col-sm-9">
								<select class="form-control" id="txtTindakan" name="txtTindakan" onchange="changeValue(this.value)" >
				                    <option>Pilih Tindakan</option>
				                    <?php if(mysqli_num_rows($t)) {?>
				                      <?php while($row_t= mysqli_fetch_array($t)) {?>
				                        <option value="<?php echo $row_t["id_tindakan"]?>"> <?php echo $row_t["nama_tindakan"]?> </option>
				                      <?php $rsArray .= "bea['" . $row_t['id_tindakan'] . "'] = {txtBiaya:'" . addslashes($row_t['biaya']) . "'};\n"; } ?><?php } ?>
				                </select>
							</div>
						</div>		
						<div class="form-group">
							<label class="col-sm-3 control-label" >Biaya</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="txtBiaya"  id="txtBiaya" value="<?= $data['biaya']?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-9"></label>
							<div class="col-sm-9">
							  <button type="submit" name="btnSubmit" class="btn btn-primary m-w-120">Update</button>
							  <button type="reset" name="btnReset" class="btn btn-danger m-w-120">Reset</button>
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
	<?php 
		$dr = 'DR';
		$id_dokter = mysqli_query($koneksi,"select max(id_dokter) as last from dokter where id_dokter like '$dr%'");
		$data = mysqli_fetch_array($id_dokter);
		if($data['last']){
		  $nomor = explode("-",$data['last'],2);
		  $kodedr = $dr.'-'.str_pad(($nomor[1]+1),3,'0',STR_PAD_LEFT);
		}else{
		  $kodedr = $dr.'-'.'001';
		}
	?>
    <form method="post" action="Controller/aksiDokter.php?aksi=tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	            <span aria-hidden="true">
        	            <i class="zmdi zmdi-close"></i>
            	    </span>
                </button>
                <h4 class="modal-title">Entri Data Dokter</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form-control-1" class="control-label">ID Dokter</label>
                    <input type="text" name="txtIdDokter" class="form-control" id="form-control-1" value="<?= $kodedr ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Nama</label>
                    <input type="text" name="txtNamaDokter" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Jenis Kelamin</label><br>
                    <input type="radio" name="jk" value="Laki-Laki"> Laki-Laki           
                    <input type="radio" name="jk" value="Perempuan"> Perempuan
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Spesialis</label>
                    <input type="text" name="txtSpesialis" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Departemen/Poli</label>
                    <select name="cmbPoli" class="form-control">
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
                </div>
                <div class="form-group">
					<label for="form-control-1" class="control-label">Jasa</label>
					<input type="number" name="txtJasa" class="form-control" id="form-control-1" placeholder="0">
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
    function changeValue(no_pendaftaran) {
      document.getElementById("txtPasien").value = nama[no_pendaftaran].txtPasien;
    };
</script> 
<script type="text/javascript">
    <?php echo $rsArray;?>
    function changeValue(id_tindakan) {
      document.getElementById("txtBiaya").value = bea[id_tindakan].txtBiaya;
    };
</script> 
