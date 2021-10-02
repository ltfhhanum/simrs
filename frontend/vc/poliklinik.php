<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Poliklinik		
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="elements.html"> Poliklinik</a></p>
						</div>	
					</div>
				</div>
			</section>
<section>
	<div class="section-top-border">
		<div class="container">
			<div class="panel-body">
				
				<div class="table-responsive">
				
				<?php
					$page=isset($_GET['page'])?$_GET['page']:'list';
					switch ($page) {
					case 'list':
				?>
					<h3 class="mb-30">Daftar Poliklinik</h3>
					<table class="table table-striped table-bordered dataTable" id="table-1">
						<thead>
						<tr>
						  <th>No</th>
						  <th>Nama Poliklinik</th>
						  <th>Deskripsi</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$data = mysqli_query($koneksi,"select * from poliklinik");
							$i =1;
							while ($row=mysqli_fetch_array($data)) {
						?>
						<tr>
							<td><?php echo $i?></td>
							<td><?php echo $row['nama_poli']?></td>
							<td><?php echo $row['keterangan']?></td>
						</tr>
						<?php $i++;}?>
					  </tbody>
					</table>
				</div>
			</div>
			<?php
				break;
				case 'update':
				//date_default_timezone_set('Asia/Jakarta');
				//$tgl=date('Y-m-d h:i:s' );
			?>
			<div class="panel-body">
				<?php 
							
							$data1 = mysqli_query($koneksi,"select * from jadwal_dokter where id_dokter = '$_GET[id]'");
							$i =1;
							while ($row=mysqli_fetch_array($data1)) {
						?>
				<h3 class="mb-30">Jadwal dr. <?php echo $_GET['id'] ?></h3>
				<div class="table-responsive">
					<table class="table table-striped table-bordered dataTable" id="table-1">
						<thead>
						<tr>
						  <th>No</th>
						  <th>Hari </th>
						  <th>Jam Kerja</th>
						</tr>
						</thead>
						<tbody>
						
						<tr>
							<td><?php echo $i?></td>
							<td><?php echo $row['hari']?></td>
							<td><?php echo $row['jam_mulai'] . ' - ' . $row['jam_akhir']?></td>
						</tr>
						<?php $i++;}?>
					  </tbody>
					</table>
				</div>
			</div>
			<?php 
				break;
				} 
			?>
		</div>
	</div>
</section>