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
            <h3 class="panel-title">Data Tindakan</h3>
            <div class="panel-subtitle">Informasi data tindakan disini</div>
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
                  <th>Nama Tindakan</th>
                  <th>Biaya Tindakan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from tindakan");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $i?></td>
					<td><?php echo $row['nama_tindakan']?></td>
					<td><?php echo number_format($row['biaya'],'0',',','.')?></td>
					<td><a type="button" class="btn btn-success" href="?p=tindakan&page=update&id=<?php echo $row['id_tindakan']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>
						<a class="btn btn-danger" href="Controller/aksiTindakan.php?aksi=hapus&id=<?php echo $row['id_tindakan']?>" 
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
            $ambil = mysqli_query($koneksi,"select * from tindakan where id_tindakan='$_GET[id]'");
            $data = mysqli_fetch_array($ambil);
        ?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiTindakan.php?aksi=ubah&id=<?php echo $data['id_tindakan']?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Nama Tindakan</label>
							<div class="col-sm-9">
								<input value="<?=$data['nama_tindakan']?>" class="form-control" type="text" name="txtNamaTindakan">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Biaya</label>
							<div class="col-sm-9">
								<input class="form-control" type="number" name="txtBiaya" value="<?=$data['biaya']?>">
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
    <form method="post" action="Controller/aksiTindakan.php?aksi=tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	            <span aria-hidden="true">
        	            <i class="zmdi zmdi-close"></i>
            	    </span>
                </button>
                <h4 class="modal-title">Entri Data Tindakan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Nama Tindakan</label>
                    <input type="text" name="txtNamaTindakan" class="form-control" id="form-control-1" placeholder="Tindakan">
                </div>
                <div class="form-group">
                    <label for="form-control-4" class="control-label">Keterangan</label>
                    <input type="number" id="form-control-4" name="txtBiaya" class="form-control" rows="3" placeholder="0">
                </div>
            	<div class="modal-footer text-center">
			        <button type="submit" name="btnSubmit" class="btn btn-primary">Simpan</button>
			        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
			    </div>
        	</div>
    	</div>
	</div>
	</form>
</div>