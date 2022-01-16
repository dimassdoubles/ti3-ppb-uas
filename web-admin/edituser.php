<?php
include "koneksi_ip.php";
if (isset($_GET['id'])) {
$kode = $_GET['id'];
} else {
die ("Error. No Id Selected! ");
}
$query = "SELECT * FROM user WHERE id='$kode'";
$sql = mysqli_query ($conn,$query);
$hasil = mysqli_fetch_array ($sql);
$id = $hasil['id'];
$user_id = $hasil['user_id'];
$nama = stripslashes ($hasil['name']);
$password = stripslashes ($hasil['password']);
$hak_akses = $hasil['hak_akses'];

//proses edit user
if (isset($_POST['Edit'])) {
	$id = $_POST['hiduser'];
	$user_id = $_POST['user_id'];
	$nama = addslashes (strip_tags ($_POST['nama']));
	$password = $_POST['password'];
	$hak_akses = $_POST['hak_akses'];
	
//update user
$query = "UPDATE user SET user_id='$user_id',name='$nama', 
password=MD5('$password'), hak_akses='$hak_akses' WHERE id='$id'";
$sql = mysqli_query ($conn,$query);
if ($sql) {
	echo "<h2><font color=blue>user telah berhasil diedit</font></h2>";
} else {
	echo "<h2><font color=red>user gagal diedit</font></h2>";
}
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displayuser'>";
}
if (isset($_POST['Reset'])) {
echo "<meta http-equiv='refresh' content='0;URL=index_admin.php?page=displayuser'>";
}
?>
<html>
<head><title>Edit user</title>
</head>
<body>
<FORM ACTION="" METHOD="POST" NAME="input">
<table cellpadding="0" cellspacing="0" border="0" width="700">
<tr>
<td align="center" colspan="2"><h2>Update user</h2></td>
</tr>
<tr>
<td width="200">User Id</td>
<td>: <input type="text" name="user_id" size="30" value="<?php echo $user_id ?>"</td>
</tr>
<tr>
<td>Nama User</td>
<td>: <input type="text" name="nama" size="30" value="<?php echo $nama ?>"></td>
</tr>
<tr>
<td>Password</td>
<td>: <input type="text" name="satuan" size="32" value="<?php echo $password ?>"></td>
</tr>
<tr>
<td>Hak Akses</td>
<td>:  <select>
  <option name="hak_akses" value="0">Administrator</option>
  <option name="hak_akses" value="1">Operator</option>
  
</select> </td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;&nbsp;
<input type="hidden" name="hiduser" value="<?=$id?>">
<input type="submit" name="Edit" value="Edit user">&nbsp;
<input type="submit" name="Reset" value="Cancel"></td>
</tr>
</table>
</FORM>
</body>
</html>