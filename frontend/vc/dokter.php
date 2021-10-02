<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Dokter		
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="index.php?p=dokter"> Dokter</a></p>
						</div>	
					</div>
				</div>
			</section>
<section>
	<div class="section-top-border">
		<?php
			$page=isset($_GET['page'])?$_GET['page']:'list';
			switch ($page) {
			case 'list':
		?>
		<div class="container">
			<div class="panel-body">
				<section class="team-area section-gap">
				    <div class="container">
						<div class="row justify-content-center d-flex align-items-center">
						<?php
							$data = mysqli_query($koneksi, "SELECT * FROM user, dokter where user.username = dokter.username");
							$no =1;
							while ($row = mysqli_fetch_array($data)){
						?>
						<div class="col-lg-3 col-md-6 single-team">
							<div class="thumb">
								<img class="img-fluid" src="../img/images/<?php echo $row['foto'] ?>" alt="">
					                <div class="align-items-end justify-content-center d-flex">		
					                    <p2><a href="?p=dokter&page=detail&id=<?php echo $row['id_dokter']?>" >Lihat Jadwal</a></p2>
					                    <p>
					                      	Ahli <?php echo $row['spesialis'] ?>
					           	        </p>
					                    <h4><?php echo $row['nama_dokter'] ?></h4>
					                </div>
					            </div>
					        </div>
					        <?php
					          	$no++;}
					        ?>
				        </div>
				    </div>
				</section>
			</div>
		</div>
			
			<?php
				break;
				case 'detail':
				//date_default_timezone_set('Asia/Jakarta');
				//$tgl=date('Y-m-d h:i:s' );
			?>
			<div class="container">
			<div class="panel-body">
				
				<h3 class="mb-30">Kode Dokter <?php echo $_GET['id'] ?></h3>
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
						<?php 
					$data1 = mysqli_query($koneksi,"select * from jadwal_dokter where id_dokter = '$_GET[id]'");
					$i =1;
					while ($row=mysqli_fetch_array($data1)) {
				?>
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
			
		</div>
		<?php 
				break;
				} 
			?>
</section>