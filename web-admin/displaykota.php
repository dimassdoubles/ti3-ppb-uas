<?php
	include "koneksi_ip.php"
?>
<HTML>
<HEAD>
<TITLE>Menampilkan Daftar Kota</TITLE>

<script language="javascript">
function tanya() {
if (confirm ("Apakah Anda yakin akan menghapus kota ini ?")) {
	return true;
} else {
	return false;
}
}
</script>
</HEAD>
<BODY>
<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Masters</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index_admin.php">Home</a></li>
						<li><i class="fa fa-laptop"></i>Kota</li>						  	
					</ol>
				</div>
			</div>              
			  <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Daftar Kota
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> No</th>
								 <th><i class="icon_profile"></i> Id</th>
                                 <th><i class="icon_pin_alt"></i> Kota</th>             
								 <th><i class="icon_cogs"></i> Action</th>
                              </tr>



<?php
    $query = "SELECT * FROM kota order by id";
  $sql = mysqli_query ($conn,$query);
  //echo "<a href='tambahkota.php'>Add</a>";
  $no=0;
 	while ($hasil = mysqli_fetch_array ($sql)) {
		$kode = $hasil['id'];
		$nama = stripslashes ($hasil['kota']);
		$no++;
		echo "<tr>
		<td align='center'>$no</td>
		<td align='center'>$kode</td>
		<td align='left' >$nama</td>";
		?>
		<td>
		                          <div class="btn-group">
                                      <a class="btn btn-primary" href="<?php echo "index_admin.php?page=tambahkota"?>"><i class="icon_plus_alt2"></i></a>
                                      <a class="btn btn-success" href="<?php echo "index_admin.php?page=editkota&id=$kode"?>"><i class="icon_check_alt2"></i></a>
                                      <a class="btn btn-danger" onClick='return tanya()' href="<?php echo "index_admin.php?page=hapuskota&id=$kode"?>"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>
	        <?php } ?>
		</tbody>
                        </table>
                      </section>
                  </div>
              </div>
		
		
</BODY>
</HTML>
