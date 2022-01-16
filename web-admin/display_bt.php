<?php  
include "mysqli_koneksi.php";  ?>
<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Masters</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-laptop"></i>Buku Tamu</li>						  	
					</ol>
				</div>
			</div>              
			  <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Buku Tamu
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> Nama</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_pin_alt"></i> Situs</th>
                                 <th><i class="icon_mobile"></i> Pesan</th>
								 <th><i class="icon_calendar"></i> Date</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
					<?php  
  $sql = mysqli_query($con,"SELECT * FROM bukutamu ORDER BY id DESC");    
  while($hasil = mysqli_fetch_array($sql)) {     	
  $nama  = stripslashes($hasil['nama']);  
 	$email = stripslashes($hasil['email']);  
 	$situs = stripslashes($hasil['situs']);  
 	$pesan = stripslashes($hasil['pesan']);  
 $time  = $hasil['waktu'];   
  ?>		  
							<tr>
							<td>
							<?php echo $nama;?>
							</td>
							<td>
							<?php echo $email;?>
							</td>
							<td>
							<?php echo $situs;?>
							</td>
							<td>
							<?php echo $pesan;?>
							</td>
							<td>
								<?php echo $time;?>
							</td>
							<td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="#"><i class="icon_plus_alt2"></i></a>
                                      <a class="btn btn-success" href="#"><i class="icon_check_alt2"></i></a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>
	        <?php } ?>
		</tbody>
                        </table>
                      </section>
                  </div>
              </div>