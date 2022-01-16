<?php
include "koneksi_ip.php";
if (isset($_GET['id'])) {
$kode = $_GET['id'];
} else {
die ("Error. NO Id Selected! ");
}
?>
<html>
<head><title>Delete Kota</title>
</head>
<body>

<?php
//proses delete kota
if (!empty($kode) && $kode != "") {
$query = "DELETE FROM kota WHERE id='$kode'";
$sql = mysqli_query ($conn,$query);
if ($sql) {
echo "<h2><font color=blue>kota telah berhasil dihapus</font></h2>";
} else {
echo "<h2><font color=red>kota gagal dihapus</font></h2>";
}
echo "Klik <a href='index_admin.php?page=displaykota'>di sini</a> untuk kembali ke halaman display kota";
} else {
die ("Access Denied");
}
?>
</body>
</html>