<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbnm = "psp3";
$conn = mysql_connect ($host, $user, $pass);
if ($conn) {
	$buka = mysql_select_db ($dbnm);
if (!$buka) {
	die ("Database tidak dapat dibuka");
	}
else
{
	//echo "Sukses buka database";
}
} else {
die ("Server MySQL tidak terhubung");
}
?>