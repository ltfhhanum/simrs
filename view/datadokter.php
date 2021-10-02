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
        <div class="panel-subtitle">Informasi data dokter</div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
			   	<div class="col-lg-2 col-sm-4 col-xs-6 m-y-5">
				  	<a type="button" href="./Laporan/laporanDokter.php" class="btn btn-success"><i class="zmdi zmdi-local-printshop zmdi-hc-fw"></i> Cetak</a>
				  </div>
          <table class="table table-bordered m-b-0">
            <thead>
              <tr>
						<th style="width: 32px"></th>
						<th>ID Dokter</th>
						<th>Nama Dokter</th>
  						<th>Spesialis</th>
  						<th>Poliklinik</th>
  						<th>Jasa</th>
              </tr>
            </thead>
            <tbody>
              <?php 
  						$data = mysqli_query($koneksi,"select * from dokter,poliklinik,user where dokter.id_poli = poliklinik.id_poli and dokter.username = user.username");
  						$i = 1 ;
  						while ($row=mysqli_fetch_array($data)) {
  					  ?>
  						<tr>
  							<td><img class="img-rounded" src="img/images/<?=$row['foto']?>" alt="" width="32" height="32"></td>
  							<td><?php echo $row['id_dokter']?></td>
							<td><?php echo $row['nama_dokter']?></td>
  							<td><?php echo $row['spesialis']?></td>
  							<td><?php echo $row['nama_poli']?></td>
  							<td><?php echo $row['jasa']?></td>
  						</tr>
  						<?php $i++;}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>   
</div>