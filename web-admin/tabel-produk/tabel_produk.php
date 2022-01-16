<?php
	include "connection.php"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Produk</title>
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        text-align: center;
      }
      th {
        background-color: #588c7e;
        color: white;
      }
      td {
        max-width: 10rem;
      }
      tr:nth-child(even) {
        background-color: #C3DBD5;
      }
    </style>
  </head>
  <body>
    <table>
      <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Deskripsi Produk</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
      <?php 
        $conn = mysqli_connect("localhost", "root", "", "uas_ppb");
        if ($conn) {
            $read_barang = mysqli_query($conn, "SELECT * FROM produk");
            if ($read_barang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($read_barang)) {
                    echo "<tr><td style='width: 3rem'>". $row["id_produk"]."</td><td>". $row["nama_produk"]."</td><td>". $row["deskripsi"]."</td><td>". $row["harga"]."</td><td>". $row["gambar"]."</td>";
                    $id_produk = $row["id_produk"];
                    $gambar = $row["gambar"];
                    echo "<td><a href='delete.php?id_produk=$id_produk?gambar=$gambar' target='blank'>Hapus</a>/<a href='update.php?id_produk=$id_produk' target='blank'>Edit</a></td></tr>";
                }
                echo "</table>";
            }
        }
      ?>

    </table>
    <form action="insert.php">
      <button style="margin-top: 16px; width: 100%" type="submit">
        Tambah Produk Baru
      </button>
    </form>

  </body>
</html>
