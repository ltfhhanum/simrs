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
            <h3 class="panel-title">Data Obat</h3>
            <div class="panel-subtitle">Informasi data obat disini</div>
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
                  <th>ID Obat</th>
                  <th>Nama Obat</th>
                  <th>Satuan</th>
                  <th>Expire Date</th>
                  <th>Harga</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from obat");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $row['id_obat']?></td>
					<td><?php echo $row['nama_obat']?></td>
					<td><?php echo $row['satuan']?></td>
					<td><?php echo $row['exp']?></td>
					<td><?php echo number_format($row['harga'],'0',',','.')?></td>
					<td><?php echo $row['keterangan']?></td>
					<td><a type="button" class="btn btn-success" href="?p=obat&page=update&id=<?php echo $row['id_obat']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>
						<a class="btn btn-danger" href="Controller/aksiObat.php?aksi=hapus&id=<?php echo $row['id_obat']?>" 
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
            $ambil = mysqli_query($koneksi,"select * from obat where id_obat ='$_GET[id]'");
            $data = mysqli_fetch_array($ambil);
        ?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiObat.php?aksi=ubah&id=<?php echo $data['id_obat']?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">ID Obat</label>
							<div class="col-sm-9">
								<input value="<?=$data['id_obat']?>" class="form-control" type="text" name="txtIdObat" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Nama Obat</label>
							<div class="col-sm-9">
								<input value="<?=$data['nama_obat']?>" class="form-control" type="text" name="txtNamaObat" >
							</div>
						</div>
						<div class="form-group">
							<!--<label class="col-sm-3 control-label" for="form-control-1">Satuan</label>-->
							<label class="col-sm-3 control-label" for="form-control-1">Satuan</label>
			                <div class="col-sm-9">
			                  <select id="form-control-1" name="txtSatuan" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }">
			                    <option >Botol</option>
			                    <option >Strip</option>
			                  </select>
			                </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Expire Date</label>
							<div class="col-sm-9">
							  <input class="form-control" type="date" name="txtExp" value="<?=$data['exp']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-9">Harga</label>
							<div class="col-sm-9">
							  <input class="form-control" type="number" name="txtHarga" value="<?=$data['harga']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Keterangan</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtKet"><?=$data['keterangan']?></textarea>
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
		$dr = 'MDC';
		$id_obat = mysqli_query($koneksi,"select max(id_obat) as last from obat where id_obat like '$dr%'");
		$data = mysqli_fetch_array($id_obat);
		if($data['last']){
		  $nomor = explode("-",$data['last'],2);
		  $kodedr = $dr.'-'.str_pad(($nomor[1]+1),3,'0',STR_PAD_LEFT);
		}else{
		  $kodedr = $dr.'-'.'001';
		}
	?>
    <form method="post" action="Controller/aksiObat.php?aksi=tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	            <span aria-hidden="true">
        	            <i class="zmdi zmdi-close"></i>
            	    </span>
                </button>
                <h4 class="modal-title">Entri Data Obat</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form-control-1" class="control-label">ID Obat</label>
                    <input type="text" name="txtIdObat" class="form-control" id="form-control-1" value="<?= $kodedr ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Nama Obat</label>
                    <input type="text" name="txtNamaObat" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Satuan</label><br>
                    <select id="form-control-1" name="txtSatuan" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }">
			            <option value="option1">Botol</option>
			            <option value="option2">Strip</option>
			        </select>
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Expire Date</label>
                    <input type="date" name="txtExp" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
					<label for="form-control-1" class="control-label">Harga</label>
					<input type="number" name="txtHarga" class="form-control" id="form-control-1" placeholder="0">
				</div>
				<div class="form-group">
					<label for="form-control-1" class="control-label">Keterangan</label>
                    <textarea id="form-control-4" name="txtKet" class="form-control" rows="3" placeholder=""></textarea>
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