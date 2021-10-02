<div class="site-content">
	<div class="">
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
                <div class="panel-subtitle">Informasi data pasien</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
				<div class="col-lg-2 col-sm-4 col-xs-6 m-y-5">
					<a type="button" href="./Laporan/laporanPasien.php" class="btn btn-success"><i class="zmdi zmdi-local-printshop zmdi-hc-fw"></i> Cetak</a>
				</div>
                  <table class="table table-bordered m-b-0">
                    <thead>
                      <tr>
                        <th>No</th>
						<th>No Identitas</th>
						<th>Nama</th>
						<th>Lahir</th>
						<th>Telepon</th>
						<th>Alamat</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
						$data = mysqli_query($koneksi,"select * from pasien");
						$i = 1 ;
						while ($row=mysqli_fetch_array($data)) {
					  ?>
						<tr>
							<td><?php echo $i?></td>
							<td><?php echo $row['no_identitas']?></td>
							<td><?php echo $row['nama_pasien']?></td>
							<td><?php echo $row['tgl_lahir']?></td>
							<td><?php echo $row['notelp']?></td>
							<td><?php echo $row['alamat']?></td>
						</tr>
						<?php $i++;}?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>    
</div>