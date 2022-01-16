<?php 

include 'connection.php';

$id_produk = $_GET['id_produk'];
$gambar = $_GET['gambar'];

$delete_barang = mysqli_query($connection, "DELETE from produk WHERE id_produk = '$id_produk'");

if ($gambar != "") {
    unlink("img/".$gambar);
}

// if ($delete_barang) {
//     echo 'Data berhasil dihapus';
// } else {
//     echo 'Data gagal dihapus';
// }

header("Location:tabel_produk.php");

 ?>