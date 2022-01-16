<?php
	include "koneksi_ip.php"
?>
<HTML>
<HEAD>
<TITLE>Menampilkan Daftar Barang</TITLE>

<script language="javascript">
function tanya() {
if (confirm ("Apakah Anda yakin akan menghapus barang ini ?")) {
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
						<li><i class="fa fa-laptop"></i>Barang</li>						  	
					</ol>
				</div>
			</div>              
			  <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Daftar Barang
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> Kode</th>
                                 <th><i class="icon_mail_alt"></i> Nama Barang</th>
                                 <th><i class="icon_pin_alt"></i> Satuan</th>
                                 <th><i class="icon_mobile"></i> Harga Jual</th>
								 <th><i class="icon_calendar"></i> Harga Beli</th>
								 <th><i class="icon_calendar"></i> Stok</th>
								 <th><i class="icon_calendar"></i> Stok Min</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>



<?php
    $query = "SELECT * FROM barang order by kd_brg";
  $sql = mysqli_query ($conn,$query);
  //echo "<a href='tambahbarang.php'>Add</a>";
 	while ($hasil = mysqli_fetch_array ($sql)) {
		$kode = $hasil['kd_brg'];
		$nama = stripslashes ($hasil['nm_brg']);
		$satuan = stripslashes ($hasil['satuan']);
		$harga = $hasil['harga'];
		$hargabeli = $hasil['harga_beli'];
		$stok= $hasil['stok'];
		$stok_min = $hasil['stok_min'];
	//tampilkan barang
		echo "<tr>
		<td align='center'>$kode</td>
		<td align='left' >$nama</td>
		<td align='left'>$satuan</td>
		<td align='right'>$harga</td>
		<td align='right'>$hargabeli</td>
		<td align='right'>$stok</td>
		<td align='right'>$stok_min</td>";
		?>
		<td>
		                          <div class="btn-group">
                                      <a class="btn btn-primary" href="<?php echo "index_admin.php?page=tambahbarang"?>"><i class="icon_plus_alt2"></i></a>
                                      <a class="btn btn-success" href="<?php echo "index_admin.php?page=editbarang&id=$kode"?>"><i class="icon_check_alt2"></i></a>
                                      <a class="btn btn-danger" onClick='return tanya()' href="<?php echo "index_admin.php?page=hapusbarang&id=$kode"?>"><i class="icon_close_alt2"></i></a>
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
