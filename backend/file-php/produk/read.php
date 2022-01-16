<?php 

include 'connection.php';

$read_produk = mysqli_query($connection, "SELECT * FROM produk ORDER BY nama_produk ASC");

while ($row = mysqli_fetch_assoc($read_produk))
    $output[] = $row;
    print(json_encode($output));
    print("\n");

    mysqli_close($connection);

 ?>