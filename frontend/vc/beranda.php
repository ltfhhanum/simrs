<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-8 col-md-12">
							<h1>
								Kita Peduli Dengan Kesehatan Anda
								Setiap Saat		
							</h1>
							<p class="pt-10 pb-10 text-white">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.
							</p>
						</div>										
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			<!-- Start appointment Area -->
			<section class="appointment-area">			
				<div class="container">
					<div class="row justify-content-between align-items-center pb-120 appointment-wrap">
						<div class="col-lg-5 col-md-6 appointment-left">
							<h1>
								Waktu Pelayanan
							</h1>
							<p>
								Kami melayani pasien 24 jam setiap harinya karena kenyamanan pasien adalah keutamaan.
							</p>
							<ul class="time-list">
								<li class="d-flex justify-content-between">
									<span>Senin-Minggu</span>
									<span>00.00 - 24.00 WIB</span>
								</li>													
							</ul>
						</div>
						<div class="col-lg-6 col-md-6 appointment-right pt-60 pb-60">
							<form class="form-wrap" method="post" action="../frontend/vc/aksi.php">
								<h3 class="pb-20 text-center mb-30">Daftar Sebagai Pasien RS</h3>		
								<input type="text" class="form-control" name="txtNamaPasien" placeholder="Nama Pasien" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Pasien'" >
								<input type="text" class="form-control" name="txtNoId" placeholder="No Identitas KTP/SIM " onfocus="this.placeholder = ''" onblur="this.placeholder = 'No Identitas'" >
								<input id="" name="txtLahir" class="dates form-control"  placeholder="Tanggal Lahir" type="date">
								<div class="form-select"  id="service-select">
									<select name="jk">
										<option data-display="">Jenis Kelamin</option>
										<option value="Laki-Laki">Laki-Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>	
								<input type="text" class="form-control" name="txtUmur" placeholder="Umur " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Umur'" >
								<input type="text" class="form-control" name="txtTelepon" placeholder="No Telepon " onfocus="this.placeholder = ''" onblur="this.placeholder = 'No Telepon'" >
								<textarea name="txtAlamat" class="" rows="5" placeholder="Alamat" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat'"></textarea>
								<button type="submit" name="btnSubmit" class="primary-btn text-uppercase">Konfirmasi</button>
							</form>
						</div>
					</div>
				</div>	
			</section>
			<!-- End appointment Area -->
			
			<!-- Start offered-service Area -->
			<section class="offered-service-area section-gap">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-8 offered-left">
							<h1 class="text-white">Pelayanan Kami</h1>
							<p>
								Banyak layanan yang kami sediakan untuk kesehatan Anda semua.
							</p>
							<div class="service-wrap row">
								<div class="col-lg-6 col-md-6">
									<div class="single-service">
										<div class="thumb">
											<img class="img-fluid" src="img/s1.jpg" alt="">		
										</div>
										<a href="#">
											<h4 class="text-white">Perawatan Jantung</h4>
										</a>	
										<p>
											
										</p>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="single-service">
										<div class="thumb">
											<img class="img-fluid" src="img/s2.jpg" alt="">		
										</div>
										<a href="#">
											<h4 class="text-white">Konsultasi Rutin</h4>
										</a>	
										<p>
											
										</p>
									</div>
								</div>								
							</div>
						</div>
						<div class="col-lg-4">
							<div class="offered-right relative">
								<div class="overlay overlay-bg"></div>
								<h3 class="relative text-white">Departemen/Poliklinik</h3>
								<ul class="relative dep-list">
									<?php
										$query_input="select * from poliklinik order by nama_poli desc";
										$hasil_input=mysqli_query($koneksi,$query_input);
									?>
									<ol type="1">
									<?php 
									while($outputan=mysqli_fetch_assoc($hasil_input)){
									?>
										 <?php echo "<li><div id='judul'>".$outputan['nama_poli']."</div></li>";  ?>
									<?php
									}
									?>
									</ol>
								</ul>
								<a class="viewall-btn" href="index.php?p=poliklinik">Lihat Semua Departemen/Poliklinik</a>			
							</div>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End offered-service Area -->
		
			<!-- Start team Area -->
			
		    <section class="team-area section-gap">
		        <div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-70 col-lg-7">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Dokter Kami</h1>
		                        <p>Kami mempunyai banyak dokter spesialis dengan keahlian yang sudah dapat dipercaya oleh siapapun  </p>
		                    </div>
		                </div>
		            </div>
		            
		            <div class="row justify-content-center d-flex align-items-center">
		            	<?php
							$data = mysqli_query($koneksi, "SELECT * FROM user, dokter where user.username = dokter.username order by nama_dokter asc limit 4");
							$no =1;
							while ($row = mysqli_fetch_array($data)){
						?>
						<div class="col-lg-3 col-md-6 single-team">
							<div class="thumb">
								<img class="img-fluid" src="../img/images/<?php echo $row['foto'] ?>" alt="">
					            <div class="align-items-end justify-content-center d-flex">		
					                <p>
					                   	Ahli <?php echo $row['spesialis'] ?>
					       	        </p>
					                <h4><?php echo $row['nama_dokter'] ?></h4>
					            </div>
					        </div>
						</div>
						<?php $no++;}?>
					</div>       		                
		            
		        </div>
		    </section>
		    
		    <!-- End team Area -->	