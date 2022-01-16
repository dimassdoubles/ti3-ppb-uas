<?php 

define('HOST', 'localhost');
define('USER', 'id18291186_root');
define('PASS', 'pDAqFZB-X**3FvDD');
define('DB', 'id18291186_uas_ppb');

$connection = mysqli_connect(HOST, USER, PASS, DB);

if ($connection) {
    $pesan = "Koneksi berhasil";
} else {
    $pesan = "Koneksi gagal";
};


?>