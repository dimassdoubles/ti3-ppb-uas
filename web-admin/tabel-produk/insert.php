<?php 

    include 'connection.php';

    if (isset($_POST['submit'])) {
        if (isset($_POST['nama_produk']) && isset($_POST['deskripsi_produk']) && isset($_POST['harga'])) {
            $nama_produk = $_POST['nama_produk'];
            $deskripsi_produk = $_POST['deskripsi_produk'];
            $harga = $_POST['harga'];
            try {

                $filename = $_FILES["uploadfile"]["name"];
                $temp_name = $_FILES["uploadfile"]["tmp_name"];
                $folder = "img/".$filename;
                move_uploaded_file($temp_name, $folder);
                $insert = mysqli_query($connection, "INSERT INTO produk VALUES(NULL,'$nama_produk', '$deskripsi_produk', '$harga', '$filename')");


            } catch (Exception $e) {
                $insert = mysqli_query($connection, "INSERT INTO produk VALUES(NULL,'$nama_produk', '$deskripsi_produk', '$harga', NULL)");
            }

            if ($insert) {
                header("Location: tabel_produk.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Produk</title>
    <style>
        table {
            max-width: 100%;
            margin: auto;
        }
        input {
            width: 100%;
        }
        textarea {
            width: 100%;
        }
        button {
            width: 100px;
        }
        .container {
            width: 70%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <label for="nama_produk">Nama Produk</label>
                </td>
                <td>
                    <input type="text" name="nama_produk" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="deskripsi_produk">Deskripsi Produk</label>
                </td>
                <td>
                    <textarea name="deskripsi_produk" id="" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="harga">Harga Produk</label></td>
                <td>
                    <input type="number" name="harga" id="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="inputImage">Select Image</label>
                </td>
                <td>
                <input type="file" name="uploadfile">
                </td>
            </tr>
            <tr>
                <td>
                    <button type="reset">Reset</button>
                </td>
                <td style="text-align: end">
                    <button type="submit" name="submit">Submit</button>
                </td>
            </tr>
        </table>

    </form>
    </div>
</body>
</html>