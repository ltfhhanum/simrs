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
            <h3 class="panel-title">Data Dokter</h3>
            <div class="panel-subtitle">Informasi data dokter disini</div>
        </div>
        <div class="panel-body">
        <div class="table-responsive">
			<?php
				$page=isset($_GET['page'])?$_GET['page']:'list';
				switch ($page) {
				case 'list':
			?>
			
                <!--<p><a href="?p=poliklinik&page=entri" type="button" class="btn btn-primary m-w-120"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Tambah Data </a></p>-->
                <p><button type="button" class="btn btn-primary m-w-120" data-toggle="modal" data-target="#otherModal1">+Tambah Data</button></p>
           
            <table class="table table-striped table-bordered dataTable" id="table-1">
              <thead>
                <tr>
                  <th>ID Dokter</th>
                  <th>Nama</th>
                  <th>Departemen/Poli</th>
                  <th>Spesialis</th>
                  <th>Jasa</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from dokter, poliklinik where dokter.id_poli = poliklinik.id_poli");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $row['id_dokter']?></td>
					<td><?php echo $row['nama_dokter']?></td>
					<td><?php echo $row['nama_poli']?></td>
					<td><?php echo $row['spesialis']?></td>
					<td><?php echo number_format($row['jasa'],'0',',','.')?></td>
					<td><a type="button" class="btn btn-success" href="?p=dokter&page=update&id=<?php echo $row['id_dokter']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>
						<a class="btn btn-danger" href="Controller/aksiDokter.php?aksi=hapus&id=<?php echo $row['id_dokter']?>" 
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
		?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Nama Poli</label>
							<div class="col-sm-9">
								<input id="form-control-1" class="form-control" type="text" name="txtNamaPoli">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Keterangan</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtKet"></textarea>
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
            $ambil = mysqli_query($koneksi,"select * from dokter where id_dokter ='$_GET[id]'");
            $data = mysqli_fetch_array($ambil);
        ?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiDokter.php?aksi=ubah&id=<?php echo $data['id_dokter']?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">ID Dokter</label>
							<div class="col-sm-9">
								<input value="<?=$data['id_dokter']?>" class="form-control" type="text" name="txtIdDokter" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Nama</label>
							<div class="col-sm-9">
								<input value="<?=$data['nama_dokter']?>" class="form-control" type="text" name="txtNamaDokter" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Jenis Kelamin</label>
							<div class="custom-controls-stacked">
							<div class="col-sm-9">
								<?php
							    if($data['jk'] == "Laki-Laki"){
							      echo "<input type='radio' name='jk' value='Laki-Laki' checked='checked'> Laki-Laki &nbsp;&nbsp"; 
							      echo "<input type='radio' name='jk' value='Perempuan'> Perempuan";
							    }else{
							      echo "<input type='radio' name='jk' value='Laki-Laki'> Laki-Laki &nbsp;&nbsp";
							      echo "<input type='radio' name='jk' value='Perempuan' checked='checked'> Perempuan";
							    }
							    ?>
							</div>
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Spesialis</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="txtSpesialis" value="<?=$data['spesialis']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Departemen/Poli</label>
							<div class="col-sm-9">
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
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-9">Jasa</label>
							<div class="col-sm-9">
							  <input class="form-control" type="number" name="txtJasa" value="<?=$data['jasa']?>">
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