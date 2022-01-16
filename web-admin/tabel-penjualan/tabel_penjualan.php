<?php
	include "connection.php";

    if (isset($_POST['submit'])) {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=laporan.xls");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar User</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jsPDF/jspdf.umd.min.js"></script>
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
    <a href="../index.html">Home</a>
    <table>
      <tr>
        <th>ID</th>
        <th>Email Konsumen</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Deskripsi</th>
        <th>Total Penjualan</th>
      </tr>
      <?php 
        if ($connection) {
            $read_barang = mysqli_query($connection, "SELECT * FROM penjualan");
            if ($read_barang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($read_barang)) {
                    echo "<tr><td>". $row["id_penjualan"]."</td><td>". $row["email_konsumen"]."</td><td>". $row["tanggal"]."</td><td>". $row["waktu"]."</td><td>". $row["deskripsi"]."</td><td>".$row["total_penjualan"]."</td></tr>";
                }
                echo "</table>";
            }
        }
      ?>

    </table>

    <form action="" method="POST">
        <button style="width: 100%" type="submit">Cetak</button>
    </form>

  </body>
</html>
