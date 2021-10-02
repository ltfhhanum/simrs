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
            <h3 class="panel-title">Data Resep</h3>
            <div class="panel-subtitle">Informasi data resep disini</div>
        </div>
        <div class="panel-body">
        <div class="table-responsive">
			<?php
				$page=isset($_GET['page'])?$_GET['page']:'list';
				switch ($page) {
				case 'list':
			?>
           	<p><a href="?p=resep&page=entri" type="button" class="btn btn-primary m-w-120"><i class="zmdi zmdi-plus zmdi-hc-fw"></i>Tambah Data </a></p>
            <table class="table table-striped table-bordered dataTable" id="table-1">
              <thead>
                <tr>
                  <th>No Resep</th>
                  <th>No Rekam Medis</th>
                  <th>Keluhan</th>
                  <th>Diagnosa</th>
                  <th>Obat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
					$data = mysqli_query($koneksi,"select * from resep, rm where resep.no_rm = rm.no_rm");
					$i =1;
					while ($row=mysqli_fetch_array($data)) {
				?>
				<tr>
					<td><?php echo $row['no_resep']?></td>
					<td><?php echo $row['no_rm']?></td>
					<td><?php echo $row['keluhan']?></td>
					<td><?php echo $row['diagnosa']?></td>
					<td><a type="button" class="btn btn-primary" href="?p=resep&page=update&faktur=<?php echo $row['no_resep']?>">Lihat Obat
						</a>
					</td>
					<td><a class="btn btn-danger" href="Controller/aksiResep.php?aksi=hapus&faktur=<?php echo $row['no_resep']?>" 
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
			$today = date('ymd');
			$cari_faktur = mysqli_query($koneksi,"select max(no_resep) as last from resep where no_resep like '$today%'");
			$data = mysqli_fetch_array($cari_faktur);
			if($data['last']){
			  $nomor = explode("-",$data['last'],2);
			  $faktur = $today.'-'.str_pad(($nomor[1]+1),3,'0',STR_PAD_LEFT);
			}else{
			  $faktur = $today.'-'.'001';
			}
			$t = mysqli_query($koneksi,"SELECT * FROM rm");
			$rsArray = "var kd = new Array();\n";
		?>
		<div class="panel-body">			
					<form class="form-horizontal" method="post" action="Controller/aksiResep.php?aksi=tambah" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" >No Resep</label>
							<div class="col-sm-2">
								<input class="form-control" type="text" name="txtNoFaktur"  id="txtNoFaktur" value="" readonly>
							</div>
							<label class="col-sm-3 control-label">No Rekam Medis</label>
							<div class="col-sm-4 ">
								<select class="form-control" id="txtNoRm" name="txtNoRm" onchange="changeValue(this.value)" >
				                    <option>Pilih No RM</option>
				                    <?php if(mysqli_num_rows($t)) {?>
				                      <?php while($row_t= mysqli_fetch_array($t)) {?>
				                        <option value="<?php echo $row_t["no_rm"]?>"> <?php echo $row_t["no_rm"]?> </option>
				                      <?php $rsArray .= "kd['" . $row_t['no_rm'] . "'] = {txtKeluhan:'" . addslashes($row_t['keluhan']) . "', txtDiagnosa:'" . addslashes($row_t['diagnosa']) . "'};\n"; } ?><?php } ?>
				                </select>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-control-1">Keluhan</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtKeluhan" id="txtKeluhan" readonly></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-control-1">Diagnosa</label>
							<div class="col-sm-9">
								<textarea class="form-control" type="text" name="txtDiagnosa" id="txtDiagnosa" readonly></textarea>
							</div>
						</div>		
						<hr>
						<div class="form-group">
							<label class="col-sm-1 control-label" ></label>
							<div class="col-lg-2 col-sm-4 col-xs-6 m-y-5">
								<a type="button" name="button" class="btn btn-primary m-w-120" data-toggle="modal" data-target="#otherModal1"> Tambah Obat</a>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-hover" id="table_detail">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Obat</th>
								  <th>Harga</th>
								  <th>Jumlah</th>
								  <th>Sub Total</th>
								  <th>Aksi</th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
									
									$data = mysqli_query($koneksi,"select detail_resep.id as 'id', obat.nama_obat as 'nama_obat',
									detail_resep.jumlah as 'jumlah', detail_resep.harga as'harga', detail_resep.sub_total as 'sub_total'
									from detail_resep
									INNER JOIN obat ON obat.id_obat = detail_resep.id_obat
									where detail_resep.no_resep = '$faktur';
										");
									$i =1;
									while ($row=mysqli_fetch_array($data)) {
								?>
								<tr>
									<td><?php echo $i?></td>
									<td><?php echo $row['nama_obat']?></td>									
									<td><?php echo number_format($row['harga'],'0',',','.')?></td>
									<td><?php echo $row['jumlah']?></td>
									<td><?php echo number_format($row['sub_total'],'0',',','.')?></td>
									<td><a href="Controller/aksiResep.php?aksi=hapusdetail&id=<?php echo $row['id']?>" 
											onclick="return confirm('Yakin ingin menghapus?')">
											<i class="zmdi zmdi-delete"></i>
										</a>
									</td>
								</tr>
								<?php $i++;}?>
							  </tbody>
							</table>
						</div>
						<div class="form-group">
				
						</div>
						<div class="form-group">
							
						</div>
						<div class="form-group">
							
						</div>
						<div class="form-group">
							
						</div>
						<div class="form-group" >
							<label class="col-sm-2 control-label" for="form-control-1">Total Harga</label>
							<div class="col-sm-3">
								<input class="form-control" type="number" name="txtTotal" id="txtTotal" readonly>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-control-9"></label>
							<div class="col-sm-3">
							  <button type="submit" name="btnSubmit" class="btn btn-primary m-w-120">Submit</button>
							  <button type="reset" name="btnReset" class="btn btn-danger m-w-120">Reset</button>
							</div>
						</div>
					</form>				
		</div>
		<?php
            break;
            case 'update':
            $ambil = mysqli_query($koneksi,"select * from resep where no_resep ='$_GET[faktur]'");
            $data = mysqli_fetch_array($ambil);
        ?>
		<div class="panel-body">
            <form class="form-horizontal" method="post" action="Controller/aksiResep.php?aksi=tambah" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" >No Resep</label>
							<div class="col-sm-2">
								<input class="form-control" type="text" name="txtNoFaktur"  id="txtNoFaktur" value="<?= $data['no_resep']?>" readonly>
							</div>
							<label class="col-sm-3 control-label">No Rekam Medis</label>
							<div class="col-sm-4 ">
								<input class="form-control" type="text" name="txtNoRm"  id="txtNoRm" value="<?= $data['no_rm']?>" readonly>
							</div>
						</div>	
						<hr>
						<div class="form-group">
							<label class="col-sm-1 control-label" ></label>
							<div class="col-lg-2 col-sm-4 col-xs-6 m-y-5">
								<a type="button" name="button" class="btn btn-primary m-w-120" data-toggle="modal" data-target="#otherModal1"> Tambah Obat</a>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-hover" id="table_detail">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Nama Obat</th>
								  <th>Harga</th>
								  <th>Jumlah</th>
								  <th>Sub Total</th>
								  <th>Aksi</th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
									$faktur = $_GET['faktur'];
									$data1 = mysqli_query($koneksi,"select detail_resep.id as 'id', obat.nama_obat as 'nama_obat',
									detail_resep.jumlah as 'jumlah', detail_resep.harga as'harga', detail_resep.sub_total as 'sub_total'
									from detail_resep
									INNER JOIN obat ON obat.id_obat = detail_resep.id_obat
									where detail_resep.no_resep = '$faktur';
										");
									$i =1;
									while ($row=mysqli_fetch_array($data1)) {
								?>
								<tr>
									<td><?php echo $i?></td>
									<td><?php echo $row['nama_obat']?></td>									
									<td><?php echo number_format($row['harga'],'0',',','.')?></td>
									<td><?php echo $row['jumlah']?></td>
									<td><?php echo number_format($row['sub_total'],'0',',','.')?></td>
									<td><a href="Controller/aksiResep.php?aksi=hapusdetail&id=<?php echo $row['id']?>" 
											onclick="return confirm('Yakin ingin menghapus?')">
											<i class="zmdi zmdi-delete"></i>
										</a>
									</td>
								</tr>
								<?php $i++;}?>
							  </tbody>
							</table>
						</div>
						<div class="form-group">
				
						</div>
						<div class="form-group">
							
						</div>
						<div class="form-group">
							
						</div>
						<div class="form-group">
							
						</div>
						<div class="form-group" >
							<label class="col-sm-2 control-label" for="form-control-1">Total Harga</label>
							<div class="col-sm-3">
								<input class="form-control" type="number" name="txtTotal" value="<?=$data['total_harga']?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="form-control-9"></label>
							<div class="col-sm-3">
							  <button type="submit" name="btnSubmit" class="btn btn-primary m-w-120">Update</button>
							  <button type="reset" name="btnReset" class="btn btn-danger m-w-120">Reset</button>
							</div>
						</div>
					</form>				
				</div>
			
		<?php 
			break;
			} 
		?>
    </div>
</div>

<div id="otherModal1" class="modal fade" tabindex="-1" role="dialog">
    <form method="post" action="Controller/aksiResep.php?aksi=tambahdetail&page=<?=$_GET['page']?>" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
						<i class="zmdi zmdi-close"></i>
                    </span>
                </button>
                <h4 class="modal-title">Pilih Obat</h4>
            </div>
			<?php 
				$obat=mysqli_query($koneksi, "SELECT * FROM obat");
				$jsArray = "var harga = new Array();\n"; ?>
            <div class="modal-body">
                    <div class="form-group">
						<label class="control-label" for="form-control-1"></label>
						<input class="form-control" type="text" name="noFakturDetail" id="noFakturDetail" style="display: none;">
					</div>
                    <div class="form-group">
                        <label for="form-control-1" class="control-label">Obat</label>
						<select class="form-control" name="cmbObat" onchange="getHarga(this.value)" >
							<option>- Pilih -</option>
								<?php if(mysqli_num_rows($obat)) {?>
								<?php while($row_harga= mysqli_fetch_array($obat)) {?>
							<option value="<?php echo $row_harga["id_obat"]?>"> <?php echo $row_harga["nama_obat"]?> </option>
								<?php $jsArray .= "harga['" . $row_harga['id_obat'] . "'] = {harga:'" . addslashes($row_harga['harga']) . "'};\n"; } ?>
								<?php } ?>
						</select>
                    </div>
					<div class="form-group">
						<label class="control-label" for="form-control-1">Harga</label>
						<input class="form-control" type="number" name="txtHarga" id="harga"  onkeyup="sum();" readonly>
					</div>
					<div class="form-group">
                        <label for="form-control" class="control-label">Jumlah</label>
                        <input type="number" class="form-control" placeholder="" name="txtJumlah" id="dosis"  onkeyup="sum();">
                    </div>
                    <div class="form-group">
                        <label for="form-control-2" class="control-label">Sub Total</label>
                        <input type="number" class="form-control" placeholder="" name="txtSubtotal" id="subtotal" readonly>
                    </div>
                    <div class="modal-footer text-center">
		                <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
						<button type="reset" name="btnReset" class="btn btn-danger">Reset</button>
            		</div>				
            </div>
       	</div>
    </div>
    </form>    
</div>
<script type="text/javascript">
    <?php echo $jsArray; ?>
    function getHarga(id_obat) {
      document.getElementById("harga").value = harga[id_obat].harga;
    };
</script>
<script>
	function sum() {
      var txtFirstNumberValue = document.getElementById('harga').value;
      var txtSecondNumberValue = document.getElementById('dosis').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('subtotal').value = result;
      }
	}
</script>
<script type="text/javascript">
    <?php echo $rsArray; ?>
    function changeValue(no_rm) {
      document.getElementById("txtKeluhan").value = kd[no_rm].txtKeluhan;
      document.getElementById("txtDiagnosa").value = kd[no_rm].txtDiagnosa;
    };
</script> 
<script>
  $(document).ready(function(){
    const faktur = $('#txtNoFaktur').val();
    console.log(faktur);
    if(faktur==""){
      $.ajax({
        url:'getNoFaktur.php?j=penjualan',
        success:function(data){
          $('#txtNoFaktur').val(data);
  		      panggilTotal(data);
  		      $('#noFakturDetail').val(data);
        }
      });
    }else{
      panggilTotal(faktur);
      $('#noFakturDetail').val(faktur);
    }

    function panggilTotal(nomorfaktur){
      $.ajax({
        url:'getTotal.php?j=penjualan',
        data:"nofaktur=" +nomorfaktur,
        success:function(data){
          $('#txtTotal').val(data);
        }
      });
    }
  });
</script>

