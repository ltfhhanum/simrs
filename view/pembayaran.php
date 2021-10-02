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
            <h3 class="panel-title">Data Pembayaran</h3>
            <div class="panel-subtitle">Informasi data pembayaran disini</div>
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
                <p><a type="button" class="btn btn-default" href="./Laporan/cetak_pembayaran.php">
							<i class="zmdi zmdi-local-printshop zmdi-hc-fw"></i>Cetak
						</a></p>-->
           
            <table class="table table-striped table-bordered dataTable" id="table-1">
              <thead>
                <tr>
                  <th>No Faktur</th>
                  <th>Tanggal Pembayaran</th>
                  <th>No Pendaftaran</th>
                  <th>No RM</th>
                  <th>Total Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from pembay
							INNER JOIN pendaftaran ON pembay.no_pendaftaran = pendaftaran.no_pendaftaran
							INNER JOIN rm ON pembay.no_rm = rm.no_rm
							INNER JOIN resep ON pembay.no_resep = resep.no_resep");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $row['faktur']?></td>
					<td><?php echo $row['tgl_pembayaran']?></td>
					<td><?php echo $row['no_pendaftaran']?></td>
					<td><?php echo $row['no_rm']?></td>
					<td><?php echo number_format($row['total_bayar'],'0',',','.')?></td>
					<td><a type="button" class="btn btn-success" href="?p=pembayaran&page=update&id=<?php echo $row['faktur']?>" >
							<i class="zmdi zmdi-edit"></i>
						</a>
						<a class="btn btn-danger" href="Controller/aksiPembayaran.php?aksi=hapus&id=<?php echo $row['faktur']?>" 
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
            $ambil = mysqli_query($koneksi,"select * from pembay where faktur ='$_GET[id]'");
            $data = mysqli_fetch_array($ambil);
        ?>
		<div class="panel-body">
            <div class="row">
				<div class="col-md-8">				
					<form class="form-horizontal" method="post" action="Controller/aksiPembayaran.php?aksi=ubah&id=<?php echo $data['faktur']?>" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-control-1">No Faktur</label>
							<div class="col-sm-9">
								<input value="<?=$data['faktur']?>" class="form-control" type="text" name="txtIdDokter" readonly>
							</div>
						</div>
						<div class="form-group">
                    <label for="form-control-5" class="control-label">Jasa Dokter</label>
                    <div class="row">
                        <div class="col-sm-7">
                            <select class="form-control" id="txtNoPendaftaran" name="txtNoPendaftaran" onchange="changeValue(this.value)" >
				                <option>Pilih No Id</option>
				                <?php if(mysqli_num_rows($p)) {?>
				                <?php while($row_t= mysqli_fetch_array($p)) {?>
				                <option value="<?php echo $row_t["no_pendaftaran"]?>"> <?php echo $row_t["no_id"]?> </option>
				                <?php $jsArray .= "jasa['" . $row_t['no_pendaftaran'] . "'] = {txtJasa:'" . addslashes($row_t['jasa_dokter']) . "'};\n"; } ?><?php } ?>
				            </select>
                    	</div>
	                    <div class="col-sm-5">
	                        <input type="text" name="txtJasa" class="form-control" id="txtJasa" value="">
	                    </div>
                	</div>
                </div>
                <div class="form-group">
                    <label for="form-control-5" class="control-label">Biaya Tindakan</label>
                    <div class="row">
                        <div class="col-sm-7">
                            <select class="form-control" id="txtNoRm" name="txtNoRm" onchange="getBeaTindakan(this.value)" >
				                <option>Pilih No RM</option>
				                <?php if(mysqli_num_rows($rm)) {?>
				                <?php while($row_rm= mysqli_fetch_array($rm)) {?>
				                <option value="<?php echo $row_rm["no_rm"]?>"> <?php echo $row_rm["no_rm"]?> </option>
				                <?php $rsArray .= "tindakan['" . $row_rm['no_rm'] . "'] = {txtTindakan:'" . addslashes($row_rm['biaya']) . "'};\n"; } ?><?php } ?>
				            </select>
                    	</div>
	                    <div class="col-sm-5">
	                        <input type="text" name="txtTindakan" class="form-control" id="txtTindakan" >
	                    </div>
                	</div>
                </div>
                <div class="form-group">
                    <label for="form-control-5" class="control-label">Biaya Obat</label>
                    <div class="row">
                        <div class="col-sm-7">
                            <select class="form-control" id="txtNoResep" name="txtNoResep" onchange="getBeaObat(this.value)" >
				                <option>Pilih No Resep</option>
				                <?php if(mysqli_num_rows($rs)) {?>
				                <?php while($row_rs= mysqli_fetch_array($rs)) {?>
				                <option value="<?php echo $row_rs["no_resep"]?>"> <?php echo $row_rs["no_resep"]?> </option>
				                <?php $ksArray .= "obat['" . $row_rs['no_resep'] . "'] = {txtObat:'" . addslashes($row_rs['total_harga']) . "'};\n"; } ?><?php } ?>
				            </select>
                    	</div>
	                    <div class="col-sm-5">
	                        <input type="text" name="txtObat" class="form-control" id="txtObat" >
	                    </div>
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
		date_default_timezone_set('Asia/Jakarta');
		$tgl=date('Y-m-d h:i:s' );
		$dr = date('ymd');
		$id_dokter = mysqli_query($koneksi,"select max(faktur) as last from pembay where faktur like '$dr%'");
		$data = mysqli_fetch_array($id_dokter);
		if($data['last']){
		  $nomor = explode("-",$data['last'],2);
		  $kodedr = $dr.'-'.str_pad(($nomor[1]+1),3,'0',STR_PAD_LEFT);
		}else{
		  $kodedr = $dr.'-'.'001';
		}
		$p = mysqli_query($koneksi,"SELECT * FROM pendaftaran");
		$jsArray = "var jasa = new Array();\n";
		$rm = mysqli_query($koneksi,"SELECT * FROM rm");
		$rsArray = "var tindakan = new Array();\n";
		$rs = mysqli_query($koneksi,"SELECT * FROM resep");
		$ksArray = "var obat = new Array();\n";
	?>
    <form method="post" action="Controller/aksiPembayaran.php?aksi=tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	            <span aria-hidden="true">
        	            <i class="zmdi zmdi-close"></i>
            	    </span>
                </button>
                <h4 class="modal-title">Entri Pembayaran</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form-control-5" class="control-label">No Faktur</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="txtFaktur" class="form-control" id="form-control-1" value="<?=$kodedr?>">
                    	</div>
	                    <div class="col-sm-6">
	                        <input type="text" name="txtTgl" class="form-control" id="form-control-1" value="<?=$tgl?>">
	                    </div>
                	</div>
                </div>
                <div class="form-group">
                    <label for="form-control-5" class="control-label">Jasa Dokter</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" id="txtNoPendaftaran" name="txtNoPendaftaran" onchange="changeValue(this.value)" >
				                <option>Pilih No Id</option>
				                <?php if(mysqli_num_rows($p)) {?>
				                <?php while($row_t= mysqli_fetch_array($p)) {?>
				                <option value="<?php echo $row_t["no_pendaftaran"]?>"> <?php echo $row_t["no_id"]?> </option>
				                <?php $jsArray .= "jasa['" . $row_t['no_pendaftaran'] . "'] = {txtJasa:'" . addslashes($row_t['jasa_dokter']) . "'};\n"; } ?><?php } ?>
				            </select>
                    	</div>
	                    <div class="col-sm-6">
	                        <input type="text" name="txtJasa" class="form-control" id="txtJasa" onkeyup="sum();">
	                    </div>
                	</div>
                </div>
                <div class="form-group">
                    <label for="form-control-5" class="control-label">Biaya Tindakan</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" id="txtNoRm" name="txtNoRm" onchange="getBeaTindakan(this.value)" >
				                <option>Pilih No RM</option>
				                <?php if(mysqli_num_rows($rm)) {?>
				                <?php while($row_rm= mysqli_fetch_array($rm)) {?>
				                <option value="<?php echo $row_rm["no_rm"]?>"> <?php echo $row_rm["no_rm"]?> </option>
				                <?php $rsArray .= "tindakan['" . $row_rm['no_rm'] . "'] = {txtTindakan:'" . addslashes($row_rm['biaya']) . "'};\n"; } ?><?php } ?>
				            </select>
                    	</div>
	                    <div class="col-sm-6">
	                        <input type="text" name="txtTindakan" class="form-control" id="txtTindakan" onkeyup="sum();">
	                    </div>
                	</div>
                </div>
                <div class="form-group">
                    <label for="form-control-5" class="control-label">Biaya Obat</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" id="txtNoResep" name="txtNoResep" onchange="getBeaObat(this.value)" >
				                <option>Pilih No Resep</option>
				                <?php if(mysqli_num_rows($rs)) {?>
				                <?php while($row_rs= mysqli_fetch_array($rs)) {?>
				                <option value="<?php echo $row_rs["no_resep"]?>"> <?php echo $row_rs["no_resep"]?> </option>
				                <?php $ksArray .= "obat['" . $row_rs['no_resep'] . "'] = {txtObat:'" . addslashes($row_rs['total_harga']) . "'};\n"; } ?><?php } ?>
				            </select>
                    	</div>
	                    <div class="col-sm-6">
	                        <input type="text" name="txtObat" class="form-control" id="txtObat" onkeyup="sum();">
	                    </div>
                	</div>
                </div>
                <div class="form-group">
					<label for="form-control-1" class="control-label">Total Bayar</label>
					<input type="number" name="txtTotal" class="form-control" id="txtTotal" placeholder="0">
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
      document.getElementById("txtJasa").value = jasa[no_pendaftaran].txtJasa;
    };
</script> 
<script type="text/javascript">
    <?php echo $rsArray; ?>
    function getBeaTindakan(no_rm) {
      document.getElementById("txtTindakan").value = tindakan[no_rm].txtTindakan;
    };
</script> 
<script type="text/javascript">
    <?php echo $ksArray; ?>
    function getBeaObat(no_resep) {
      document.getElementById("txtObat").value = obat[no_resep].txtObat;
    };
</script>
<script>
	function sum() {
      var txtFirstNumberValue = document.getElementById('txtJasa').value;
      var txtSecondNumberValue = document.getElementById('txtTindakan').value;
      var txtThirdNumberValue = document.getElementById('txtObat').value;
      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue);
      if (!isNaN(result)) {
         document.getElementById('txtTotal').value = result;
      }
	}
</script>