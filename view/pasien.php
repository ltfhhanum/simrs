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
            <h3 class="panel-title">Data Pasien</h3>
            <div class="panel-subtitle">Informasi data pasien disini</div>
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
                  <th>No Identitas</th>
                  <th>Nama</th>
                  <th>Tanggal Lahir</th>
                  <th>Umur</th>
                  <th>Jenis Kelamin</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from pasien");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $row['no_identitas']?></td>
					<td><?php echo $row['nama_pasien']?></td>
					<td><?php echo $row['tgl_lahir']?></td>
					<td><?php echo $row['umur']?></td>
					<td><?php echo $row['jk']?></td>
					<td>
						<a type="button" class="btn btn-success" href="?p=pasien&page=update&id=<?php echo $row['no_identitas']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>
						<a class="btn btn-danger" href="Controller/aksiPasien.php?aksi=hapus&id=<?php echo $row['no_identitas']?>" 
							onclick="return confirm('Yakin ingin menghapus?')">
							<i class="zmdi zmdi-delete"></i>
						</a>
					</td>
				</tr>
				<?php $i++;}?>
              </tbody>
            </table>
            <div id="otherModal2" class="modal fade" tabindex="-1" role="dialog"></div>
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
            $ambil = mysqli_query($koneksi,"select * from pasien where no_identitas ='$_GET[id]'");
            $data = mysqli_fetch_array($ambil);
        ?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiPasien.php?aksi=ubah&id=<?php echo $data['no_identitas']?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">No Identitas</label>
							<div class="col-sm-9">
								<input value="<?=$data['no_identitas']?>" class="form-control" type="text" name="txtNoId" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Nama Pasien</label>
							<div class="col-sm-9">
								<input value="<?=$data['nama_pasien']?>" class="form-control" type="text" name="txtNamaPasien" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Tanggal Lahir</label>
							<div class="col-sm-9">
								<input class="form-control" type="date" name="txtLahir" value="<?=$data['tgl_lahir']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Umur</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="txtUmur" value="<?=$data['umur']?>">
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
							<label class="col-sm-3 control-label" for="form-control-1">No Telepon</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="txtTelepon" value="<?=$data['notelp']?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">Alamat</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtAlamat"><?=$data['alamat']?></textarea>
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
    <form method="post" action="Controller/aksiPasien.php?aksi=tambah">
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
  $(document).ready(function(){
   $('a#detail_data').click(function(){
    var url = $(this).attr('href');
    $.ajax({
     url : url,
     success:function(response){
      $('#otherModal2').html(response);
     }
    });
   });
   
  });
 </script>
