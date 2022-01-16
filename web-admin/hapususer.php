<?php
include "koneksi_ip.php";
if (isset($_GET['id'])) {
$kode = $_GET['id'];
} else {
die ("Error. NO Id Selected! ");
}
?>
<html>
<head><title>Delete User</title>
</head>
<body>

<?php
//proses delete User
if (!empty($kode) && $kode != "") {
$query = "DELETE FROM user WHERE id='$kode'";
$sql = mysqli_query ($conn,$query);
if ($sql) {
echo "<h2><font color=blue>User telah berhasil dihapus</font></h2>";
} else {
echo "<h2><font color=red>User gagal dihapus</font></h2>";
}
echo "Klik <a href='index_admin.php?page=displayuser'>di sini</a> untuk kembali ke halaman display User";
} else {
die ("Access Denied");
}
?>
</body>
</html>