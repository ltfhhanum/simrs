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
            <h3 class="panel-title">Data User</h3>
            <div class="panel-subtitle">Informasi data user disini</div>
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
				  <th style="width: 32px"></th>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th>Hak Akses</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from user");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><img class="img-circle" src="img/images/<?=$row['foto']?>" alt="" width="32" height="32"></td>
					<td><?php echo $row['nama']?></td>
					<td><?php echo $row['username']?></td>
					<td><?php echo $row['level']?></td>
					<td><?php echo $row['email']?></td>
					<td><a type="button" class="btn btn-success" href="?p=user&page=update&username=<?php echo $row['username']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>
						<a class="btn btn-danger" href="Controller/aksiUser.php?aksi=hapus&username=<?php echo $row['username']?>" 
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
            $ambil = mysqli_query($koneksi,"select * from user where username='$_GET[username]'");
            $data = mysqli_fetch_array($ambil);
        ?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiUser.php?aksi=ubah&username=<?php echo $data['username']?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Username</label>
							<div class="col-sm-9">
								<input value="<?=$data['username']?>" class="form-control" type="text" name="txtUsername" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Password</label>
							<div class="col-sm-9">
								<input value="<?=$data['password']?>" class="form-control" type="password" name="txtPassword" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Nama User</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="txtNamaUser" value="<?=$data['nama']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Email</label>
							<div class="col-sm-9">
								<input class="form-control" type="email" name="txtEmail" value="<?=$data['email']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Level</label>
							<div class="col-sm-9">
								<select id="form-control-9" class="form-control" name="txtLevel">
									<option>Administrasi</option>
									<option>Apoteker</option>
									<option>Dokter</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-9">Foto</label>
							<div class="col-sm-9">
							  <input type="file" name="fileAp" class="form-control">
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
    <form method="post" action="Controller/aksiUser.php?aksi=tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	            <span aria-hidden="true">
        	            <i class="zmdi zmdi-close"></i>
            	    </span>
                </button>
                <h4 class="modal-title">Entri Data User</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Nama</label>
                    <input type="text" name="txtNamaUser" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Username</label>
                    <input type="text" name="txtUsername" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Password</label>
                    <input type="password" name="txtPassword" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Email</label>
                    <input type="email" name="txtEmail" class="form-control" id="form-control-1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="form-control-1" class="control-label">Level</label>
                    <select id="form-control-9" class="form-control" name="txtLevel">
						<option>Administrasi</option>
						<option>Apoteker</option>
						<option>Dokter</option>
					</select>
                </div>
                <div class="form-group">
					<label for="form-control-1" class="control-label">Foto</label>
					<input type="file" name="fileAp" class="form-control">
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