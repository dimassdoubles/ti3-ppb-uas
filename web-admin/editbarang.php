<?php
include "koneksi_ip.php";
if (isset($_GET['id'])) {
$kode = $_GET['id'];
} else {
die ("Error. No Id Selected! ");
}
$query = "SELECT * FROM barang WHERE kd_brg='$kode'";
$sql = mysqli_query ($conn,$query);
$hasil = mysqli_fetch_array ($sql);
$kode = $hasil['kd_brg'];
$nama = stripslashes ($hasil['nm_brg']);
$satuan = stripslashes ($hasil['satuan']);
$harga = $hasil['harga'];
$hargabeli = $hasil['harga_beli'];
$stok= $hasil['stok'];
$stok_min = $hasil['stok_min'];

//proses edit barang
if (isset($_POST['Edit'])) {
	$kode = $_POST['hidbarang'];
	$nama = addslashes (strip_tags ($_POST['nama']));
	$satuan = $_POST['satuan'];
	$harga = $_POST['harga'];
	$hargabeli = $_POST['hargabeli'];
	$stok = $_POST['stok'];
	$stok_min = $_POST['stok_min'];

//update barang
$query = "UPDATE barang SET nm_brg='$nama',satuan='$satuan', harga='$harga', harga_beli='$hargabeli',stok='$stok',stok_min='$stok_min' WHERE kd_brg='$kode'";
$sql = mysqli_query ($conn,$query);
if ($sql) {
	echo "<h2><font color=blue>barang telah berhasil diedit</font></h2>";
} else {
	echo "<h2><font color=red>barang gagal diedit</font></h2>";
}
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displaybarang'>";
}
if (isset($_POST['Reset'])) {
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displaybarang'>";
}
?>
<html>
<head><title>Edit Barang</title>
</head>
<body>
<FORM ACTION="" METHOD="POST" NAME="input">
<table cellpadding="0" cellspacing="0" border="0" width="700">
<tr>
<td align="center" colspan="2"><h2>Update barang</h2></td>
</tr>
<tr>
<td width="200">Kode Barang</td>
<td>: <?php echo $kode ?></td>
</tr>
<tr>
<td>Nama barang</td>
<td>: <input type="text" name="nama" size="30" value="<?php echo $nama ?>"></td>
</tr>
<tr>
<td>Satuan</td>
<td>: <input type="text" name="satuan" size="10" value="<?php echo $satuan ?>"></td>
</tr>
<tr>
<td>Harga Jual</td>
<td>: <input type="text" name="harga" size="10" value="<?php echo $harga?>"></td>
</tr>
<tr>
<td>Harga Beli</td>
<td>: <input type="text" name="hargabeli" size="10" value="<?php echo $hargabeli?>"></td>
</tr>
<tr>
<td>Stok</td>
<td>: <input type="text" name="stok" size="10" value="<?php echo $stok?>"></td>
</tr>
<tr>
<td>Stok Minimal</td>
<td>: <input type="text" name="stok_min" size="10" value="<?php echo $stok_min?>"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;&nbsp;
<input type="hidden" name="hidbarang" value="<?=$kode?>">
<input type="submit" name="Edit" value="Edit Barang">&nbsp;
<input type="submit" name="Reset" value="Cancel"></td>
</tr>
</table>
</FORM>
</body>
</html>