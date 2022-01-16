<?php 

include 'connection.php';

$nama_produk = $_POST['nama_produk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];

if (isset($nama_produk) && isset($deskripsi) && isset($harga)) {
    if (isset($gambar)) {
        $insert_produk = mysqli_query($connection, "INSERT INTO produk VALUES(NULL, '$nama_produk', '$deskripsi', '$harga', '$gambar')");
    } else {
        $insert_produk = mysqli_query($connection, "INSERT INTO produk VALUES(NULL, '$nama_produk', '$deskripsi', '$harga', NULL)");
    }
    
    if ($connection) {
        $status_koneksi = "Koneksi berhasil";
    } else {
        $status_koneksi = "Koneksi gagal";
    }

    if ($insert_produk) {
        $pesan = "Data berhasil disimpan";
    } else {
        $pesan = "Data gagal disimpan";
    };

    echo json_encode(array('status koneksi' => $status_koneksi, 'status' => $pesan));
}


 ?>