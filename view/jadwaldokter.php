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
            <h3 class="panel-title">Data Jadwal Dokter</h3>
            <div class="panel-subtitle">Informasi jadwal dokter disini</div>
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
                  <th>No</th>
                  <th>ID Dokter</th>
                  <th>Nama Dokter</th>
                  <th>Hari</th>
                  <th>Jam Kerja</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select jadwal_dokter.id_dokter as id, dokter.nama_dokter, jadwal_dokter.hari, jadwal_dokter.jam_mulai, jadwal_dokter.jam_akhir from jadwal_dokter, dokter where jadwal_dokter.id_dokter = dokter.id_dokter order by nama_dokter asc");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $i?></td>
					<td><?php echo $row['id']?></td>
					<td><?php echo $row['nama_dokter']?></td>
					<td><?php echo $row['hari']?></td>
					<td><?php echo $row['jam_mulai'] . ' - ' . $row['jam_akhir']?></td>
					<td><!--<a type="button" class="btn btn-success" href="?p=dokter&page=update&id=<?php echo $row['id_jadwal']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>-->
						<a class="btn btn-danger" href="Controller/aksiJadwal.php?aksi=hapus&id=<?php echo $row['id_jadwal']?>" 
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
		$t = mysqli_query($koneksi,"SELECT * FROM dokter");
		$rsArray = "var nama = new Array();\n";

	?>
    <form method="post" action="Controller/aksiJadwal.php?aksi=tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	            <span aria-hidden="true">
        	            <i class="zmdi zmdi-close"></i>
            	    </span>
                </button>
                <h4 class="modal-title">Entri Jadwal Dokter</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form-control-1" class="control-label">ID Dokter</label>
                    <select class="form-control" id="txtIdDokter" name="txtIdDokter" onchange="changeValue(this.value)" >
				        <option>Pilih Dokter</option>
			            <?php if(mysqli_num_rows($t)) {?>
				            <?php while($row_t= mysqli_fetch_array($t)) {?>
				             <option value="<?php echo $row_t["id_dokter"]?>"> <?php echo $row_t["id_dokter"]?> </option>
				                <?php $rsArray .= "nama['" . $row_t['id_dokter'] . "'] = {txtNamaDokter:'" . addslashes($row_t['nama_dokter']) . "'};\n"; } ?><?php } ?>
			       </select>
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Nama Dokter</label>
                    <input type="text" name="txtNamaDokter" class="form-control" id="txtNamaDokter" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Jenis Kelamin</label><br>
                    <select name="txtHari" class="form-control">
						<option >Pilih Hari</option>
						<option value="Senin">Senin</option>
						<option value="Selasa">Selasa</option>
						<option value="Rabu">Rabu</option>
						<option value="Kamis">Kamis</option>
						<option value="Jum'at">Jum'at</option>
						<option value="Sabtu">Sabtu</option>
						<option value="Minggu">Minggu</option>
					</select>
                </div>
                <div class="form-group">
                    <label for="form-control-5" class="control-label">Jam Dokter</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select name="txtMulai" class="form-control">
								<option >Pilih Jam Mulai</option>
								<option value="01.00">01.00</option>
								<option value="02.00">02.00</option>
								<option value="03.00">03.00</option>
								<option value="04.00">04.00</option>
								<option value="05.00">05.00</option>
								<option value="06.00">06.00</option>
								<option value="07.00">07.00</option>
								<option value="08.00">08.00</option>
								<option value="09.00">09.00</option>
								<option value="10.00">10.00</option>
								<option value="11.00">11.00</option>
								<option value="12.00">12.00</option>
								<option value="13.00">13.00</option>
								<option value="14.00">14.00</option>
								<option value="15.00">15.00</option>
								<option value="16.00">16.00</option>
								<option value="17.00">17.00</option>
								<option value="18.00">18.00</option>
								<option value="19.00">19.00</option>
								<option value="20.00">20.00</option>
								<option value="21.00">21.00</option>
								<option value="22.00">22.00</option>
								<option value="23.00">23.00</option>
							</select>
                    	</div>
	                    <div class="col-sm-6">
	                        <select name="txtAkhir" class="form-control">
								<option >Pilih Jam Akhir</option>
								<option value="01.00">01.00</option>
								<option value="02.00">02.00</option>
								<option value="03.00">03.00</option>
								<option value="04.00">04.00</option>
								<option value="05.00">05.00</option>
								<option value="06.00">06.00</option>
								<option value="07.00">07.00</option>
								<option value="08.00">08.00</option>
								<option value="09.00">09.00</option>
								<option value="10.00">10.00</option>
								<option value="11.00">11.00</option>
								<option value="12.00">12.00</option>
								<option value="13.00">13.00</option>
								<option value="14.00">14.00</option>
								<option value="15.00">15.00</option>
								<option value="16.00">16.00</option>
								<option value="17.00">17.00</option>
								<option value="18.00">18.00</option>
								<option value="19.00">19.00</option>
								<option value="20.00">20.00</option>
								<option value="21.00">21.00</option>
								<option value="22.00">22.00</option>
								<option value="23.00">23.00</option>
							</select>
	                    </div>
                	</div>
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
    <?php echo $rsArray;?>
    function changeValue(id_dokter) {
      document.getElementById("txtNamaDokter").value = nama[id_dokter].txtNamaDokter;
    };
</script> 