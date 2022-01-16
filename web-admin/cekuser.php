<?php
include "mysqli_koneksi.php";
session_start();
if (isset($_POST['submit'])) {
	// if (isset($_POST['username'])) {
	// 	$userid = $_POST['username'];
	// 	$passwd=$_POST['password'];
	// }
	// else {
	// 	die ("Error. No Id Selected! ");
	// }
	// if($userid=="") {
	// 	header("Location:login.php?cannotLogin");
	// }
	// else { $query = "SELECT * from user WHERE user_id='$userid'";
	// 	$sql = mysqli_query ($con,$query);
	// 	if($sql) { 	$hasil = mysqli_fetch_array ($sql);
	// 		$username = $hasil['user_id'];
	// 		$userpass = $hasil['password'];
	// 		if($username==$userid && $userpass=MD5($passwd)){
	// 			$_SESSION['namauser'] = $username;
	// 			header("Location:index.php");
	// 		}
	// 		else {	header("Location:login.php?UserSalah");
	// 		}
	// 	} else {
	// 		header("Location:login.php?CannotLogin");
	// 	}
	// }
	header("Location:index.php");
}
else {
	// header("Location:login.php");
	header("Location:index.php");
}
?>