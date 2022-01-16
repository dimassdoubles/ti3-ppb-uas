<?php
	include "koneksi_ip.php"
?>
<HTML>
<HEAD>
<TITLE>Menampilkan Daftar User</TITLE>

<script language="javascript">
function tanya() {
if (confirm ("Apakah Anda yakin akan menghapus User ini ?")) {
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
						<li><i class="fa fa-laptop"></i>Pengguna</li>						  	
					</ol>
				</div>
			</div>              
			  <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Daftar Pengguna
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> Id</th>
                                 <th><i class="icon_mail_alt"></i> User Id</th>
                                 <th><i class="icon_pin_alt"></i> Nama</th>
                                 <th><i class="icon_mobile"></i> Password</th>
								 <th><i class="icon_calendar"></i> Hak Kases</th>
								 <th><i class="icon_cogs"></i> Action</th>
                              </tr>



<?php
    $query = "SELECT * FROM user order by id";
  $sql = mysqli_query ($conn,$query);
  //echo "<a href='tambahUser.php'>Add</a>";
 	while ($hasil = mysqli_fetch_array ($sql)) {
		$kode = $hasil['id'];
		$user_id = stripslashes ($hasil['user_id']);
		$nama = stripslashes ($hasil['name']);
		$password = $hasil['password'];
		$hak = $hasil['hak_akses'];
		
		echo "<tr>
		<td align='center'>$kode</td>
		<td align='left' >$user_id</td>
		<td align='left'>$nama</td>
		<td align='right'>$password</td>
		<td align='right'>$hak</td>";
		?>
		<td>
		                          <div class="btn-group">
                                      <a class="btn btn-primary" href="<?php echo "index_admin.php?page=tambahuser"?>"><i class="icon_plus_alt2"></i></a>
                                      <a class="btn btn-success" href="<?php echo "index_admin.php?page=edituser&id=$kode"?>"><i class="icon_check_alt2"></i></a>
                                      <a class="btn btn-danger" onClick='return tanya()' href="<?php echo "index_admin.php?page=hapususer&id=$kode"?>"><i class="icon_close_alt2"></i></a>
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
