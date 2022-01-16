<?php
include "koneksi_ip.php";
if (isset($_GET['id'])) {
$kode = $_GET['id'];
} else {
die ("Error. No Id Selected! ");
}
$query = "SELECT * FROM kota WHERE id='$kode'";
$sql = mysqli_query ($conn,$query);
$hasil = mysqli_fetch_array ($sql);
$id = $hasil['id'];
$kota = $hasil['kota'];

//proses edit kota
if (isset($_POST['Edit'])) {
	$id = $_POST['hidkota'];
	$kota = $_POST['kota'];
	
//update kota
$query = "UPDATE kota SET kota='$kota' WHERE id='$id'";
$sql = mysqli_query ($conn,$query);
if ($sql) {
	echo "<h2><font color=blue>kota telah berhasil diedit</font></h2>";
} else {
	echo "<h2><font color=red>kota gagal diedit</font></h2>";
}
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displaykota'>";
}
if (isset($_POST['Reset'])) {
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displaykota'>";
}
?>
<html>
<head><title>Edit Kota</title>
</head>
<body>
<FORM ACTION="" METHOD="POST" NAME="input">
<table cellpadding="0" cellspacing="0" border="0" width="700">
<tr>
<td align="center" colspan="2"><h2>Update Kota</h2></td>
</tr>
<tr>
<td width="200">Kota</td>
<td>: <input type="text" name="kota" size="30" value="<?php echo $kota ?>"</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;&nbsp;
<input type="hidden" name="hidkota" value="<?=$id?>">
<input type="submit" name="Edit" value="Edit kota">&nbsp;
<input type="submit" name="Reset" value="Cancel"></td>
</tr>
</table>
</FORM>
</body>
</html>