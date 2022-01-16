<?php
include "koneksi_ip.php";

//proses input Kota
if (isset($_POST['Edit'])) {
	$Kota = $_POST['Kota'];
	
//insert Kota
$query = "INSERT INTO kota(kota)
 values('$Kota')";
$sql = mysqli_query ($conn,$query);
if ($sql) {
	echo "<h2><font color=blue>Kota telah berhasil ditambahkan</font></h2>";
} else {
	echo "<h2><font color=red>Kota gagal ditambahkan</font></h2>";
}
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displaykota'>";
}
if (isset($_POST['Reset'])) {
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displaykota'>";
}
?>
<html>
<head><title>Tambah Kota</title>
</head>
<body>
<FORM ACTION="" METHOD="POST" NAME="input">
<table cellpadding="0" cellspacing="0" border="0" width="700">
<tr>
<td align="center" colspan="2"><h2>Input Kota</h2></td>
</tr>
<tr>
<td width="200">Kota</td>
<td>: <input type="text" name="Kota" size="30" value=""></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;&nbsp;

<input type="submit" name="Edit" value="Tambah Kota">&nbsp;
<input type="submit" name="Reset" value="Cancel"></td>
</tr>
</table>
</FORM>
</body>
</html>