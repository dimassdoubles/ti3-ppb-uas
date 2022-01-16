<?php 

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'uas_ppb');

$connection = mysqli_connect(HOST, USER, PASS, DB);

if ($connection) {
    $pesan = "Koneksi berhasil";
} else {
    $pesan = "Koneksi gagal";
};


?>