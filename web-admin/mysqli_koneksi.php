<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'uas_ppb');

$con = mysqli_connect(HOST, USER, PASS, DB);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//  echo "Connection success";
// mysqli_close($con);
 ?> 