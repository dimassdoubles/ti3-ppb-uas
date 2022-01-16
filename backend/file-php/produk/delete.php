<?php 

include 'connection.php';

$id_produk = $_POST['kode_barang'];

$delete_produk = mysqli_query($connection, "DELETE from produk WHERE id_produk = '$id_produk'");
if ($delete_barang) {
    $response['status'] = 'Data berhasil dihapus';
} else {
    $response['status'] = 'Data gagal dihapus';
}

echo json_encode($response);

// tutup koneksi
mysqli_close($connection);
 
?>