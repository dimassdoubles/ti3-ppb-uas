<?php 

include 'connection.php';

$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];

if (isset($id_produk) && isset($nama_produk) && isset($deskripsi) && isset($harga)) {
    if ($gambar == "") {
        $update_produk = mysqli_query($connection, "UPDATE produk set nama_produk = '$nama_produk', deskripsi = '$deskripsi', harga = '$harga', gambar = NULL WHERE id_produk = '$id_produk'");
    } else {
        $update_produk = mysqli_query($connection, "UPDATE produk set nama_produk = '$nama_produk', deskripsi = '$deskripsi', harga = '$harga', gambar = '$gambar' WHERE id_produk = '$id_produk'");
    }

    if ($update_produk) {
        $pesan = "Berhasil update data";
    } else {
        $pesan = "Gagal update data";
    }

    echo json_encode(array(
        'status' => $pesan
    ));
}

?>