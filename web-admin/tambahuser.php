<?php
include "koneksi_ip.php";

//proses input user
if (isset($_POST['Edit'])) {
	$user_id = $_POST['user_id'];
	$nama = addslashes (strip_tags ($_POST['nama']));
	$password = $_POST['password'];
	$hak_akses = $_POST['hak_akses'];
	

//insert user
$query = "INSERT INTO user(user_id,name,password,hak_akses)
 values('$user_id','$nama',MD5('$password'),'$hak_akses')";
$sql = mysqli_query ($conn,$query);
if ($sql) {
	echo "<h2><font color=blue>user telah berhasil ditambahkan</font></h2>";
} else {
	echo "<h2><font color=red>user gagal ditambahkan</font></h2>";
}
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displayuser'>";
}
if (isset($_POST['Reset'])) {
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displayuser'>";
}
?>
<html>
<head><title>Tambah User</title>
</head>
<body>
<FORM ACTION="" METHOD="POST" NAME="input">
<table cellpadding="0" cellspacing="0" border="0" width="700">
<tr>
<td align="center" colspan="2"><h2>Input User</h2></td>
</tr>
<tr>
<td width="200">User Id</td>
<td>: <input type="text" name="user_id" size="20" value=""></td>
</tr>
<tr>
<td>Nama</td>
<td>: <input type="text" name="nama" size="30" value=""></td>
</tr>
<tr>
<td>Password</td>
<td>: <input type="text" name="password" size="20" value=""></td>
</tr>
<tr>
<td>Hak Akses</td>
<td>:  <select>
  <option name="hak_akses" value="0">Administrator</option>
  <option name="hak_akses" value="1">Operator</option>
  
</select> </td>
</tr>
<tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;&nbsp;

<input type="submit" name="Edit" value="Tambah User">&nbsp;
<input type="submit" name="Reset" value="Cancel"></td>
</tr>
</table>
</FORM>
</body>
</html>