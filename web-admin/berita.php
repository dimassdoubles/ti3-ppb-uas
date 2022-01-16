<!-- Section: news -->
<?php  
include "mysqli_koneksi.php";  
?>
    

        <div class="heading-about marginbot-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">

                        <div class="section-heading">
                            <h2>Today News</h2>
                            <p>Berita Hari ini.... monggo disimak</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
			<?php
  $sql = mysqli_query($con,"SELECT * FROM berita ORDER BY id_berita DESC");    
  while($hasil = mysqli_fetch_array($sql)) {     	
  $judul  = stripslashes($hasil['judul']);  
 	$hl = stripslashes($hasil['headline']);  
  ?>
                <div class="col-sm-3 col-md-3">

                    <div class="service-box">
                        <div class="service-icon">
                            <i class="fa fa-code fa-3x"></i>
                        </div>
                        <div class="service-desc">
                            <h5><?php echo $judul;?></h5>
                            <p><?php echo $hl;?></p>
                        </div>
                    </div>

                </div>
  <?php } ?>   
            </div>
        </div>
  