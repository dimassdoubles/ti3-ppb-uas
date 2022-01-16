<?php
	include "connection.php"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar User</title>
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
        <th>Email</th>
        <th>Nama</th>
      </tr>
      <?php 
        if ($connection) {
            $read_barang = mysqli_query($connection, "SELECT * FROM konsumen");
            if ($read_barang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($read_barang)) {
                    echo "<tr><td>". $row["email"]."</td><td>". $row["name"]."</td></tr>";
                }
                echo "</table>";
            }
        }
      ?>

    </table>

  </body>
</html>
