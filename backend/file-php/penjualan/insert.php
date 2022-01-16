<?php 

include 'connection.php';

$email_konsumen = $_POST['email_konsumen'];
$deskripsi_pesanan = $_POST['deskripsi_pesanan'];
$total_pesanan = $_POST['total_pesanan'];

if (isset($email_konsumen) && isset($deskripsi_pesanan) && isset($total_pesanan)) {
    $insert_pesanan = mysqli_query($connection, "INSERT INTO penjualan VALUES(NULL, '$email_konsumen', CURRENT_DATE, CURRENT_TIME, '$deskripsi_pesanan', '$total_pesanan')");

    if ($insert_pesanan) {
        $pesan = "Data berhasil disimpan";
    } else {
        $pesan = "Data gagal disimpan";
    };

    echo json_encode(array('status' => $pesan));
} else {
    echo "hai";
}
 ?>