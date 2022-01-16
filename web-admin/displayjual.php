<?php
date_default_timezone_set('Asia/Jakarta');
	include "koneksi_ip.php"
?>
<HTML>
<HEAD>
<TITLE>Menampilkan Daftar Penjualan</TITLE>

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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Transactions</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index_admin.php">Home</a></li>
						<li><i class="fa fa-laptop"></i>Penjualan</li>						  	
					</ol>
				</div>
			</div>              
			  <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Daftar Penjualan
                          </header>
                          <form name="cari" method="POST">
							Tanggal : <input type="date" name="tgl1" > s/d <input type="date" name="tgl2">
							<input type="submit" name="cari" value="cari">
						  </form>
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> No. Nota</th>
                                 <th><i class="icon_mail_alt"></i> Tgl. Jual</th>
                                 <th><i class="icon_pin_alt"></i> Id Agen</th>
                                 <th><i class="icon_mobile"></i> Nama Agen</th>
								 <th><i class="icon_calendar"></i> Kode Barang</th>
								 <th><i class="icon_calendar"></i> Nama Barang</th>
								 <th><i class="icon_calendar"></i> Harga</th>
								 <th><i class="icon_calendar"></i> Jumlah</th>
								 <th><i class="icon_calendar"></i> Total</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>



<?php
if(isset($_POST["cari"]))
{	//date('Y-m-d', strtotime($tanggal))
	$tgl1=date('Y-m-d',strtotime($_POST["tgl1"]));
	$tgl2=date('Y-m-d',strtotime($_POST["tgl2"]));
	//echo "$tgl1";
	$query = "SELECT * FROM vjual where date(tgl_jual)>=date('$tgl1') and date(tgl_jual)<=date('$tgl2') order by tgl_jual desc";
	if($tgl1=="1970-01-01")
	{
		$query = "SELECT * FROM vjual order by tgl_jual desc";
	}
}
	else
	{
    $query = "SELECT * FROM vjual order by tgl_jual desc";
	}
  $sql = mysqli_query ($conn,$query);
  //echo "<a href='tambahbarang.php'>Add</a>";
 	while ($hasil = mysqli_fetch_array ($sql)) {
		$kode = $hasil['no_nota'];
		$nama = stripslashes ($hasil['tgl_jual']);
		$satuan = stripslashes ($hasil['id_agen']);
		$harga = $hasil['nama_agen'];
		$hargabeli = $hasil['kd_brg'];
		$stok= $hasil['nm_brg'];
		$stok_min = $hasil['hrg_brg'];
		$jml_brg = $hasil['jml_brg'];
		$totjual = $hasil['totjual'];
	//tampilkan barang
		echo "<tr>
		<td align='center'>$kode</td>
		<td align='left' >$nama</td>
		<td align='left'>$satuan</td>
		<td align='right'>$harga</td>
		<td align='right'>$hargabeli</td>
		<td align='right'>$stok</td>
		<td align='right'>$stok_min</td>
		<td align='right'>$jml_brg</td>
		<td align='right'>$totjual</td>";
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
