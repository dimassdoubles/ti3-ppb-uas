<?php  
include "mysqli_koneksi.php";  ?>  
<html>  
<head>  
<title>Lihat bukutamu</title>  
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">  
<link href="style.css" rel="stylesheet" type="text/css">  
!-->
</head>  
<body>  
<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Masters</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-laptop"></i>Buku Tamu</li>						  	
					</ol>
				</div>
			</div>
<div align="center">  
  <table width="594" border="0" cellpadding="0" cellspacing="0">  
    <!--DWLayoutTable-->  
    <tr>   
      <td width="592" height="20" align="center" valign="middle" class="header">LIHAT           BUKUTAMU</td>      </tr>  
    <tr>   
      <td height="13" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>  
    </tr>  
    <tr>   
      <td height="20" valign="top">&nbsp;<a href="index.php">ISI BUKU TAMU</a></td>  
    </tr>  
    <tr>   
      <td height="110" valign="top"> <p>   
        <ol>  
          <?php  
  $sql = mysqli_query($con,"SELECT * FROM bukutamu ORDER BY id DESC");    
  while($hasil = mysqli_fetch_array($sql)) {     	
  $nama  = stripslashes($hasil['nama']);  
 	$email = stripslashes($hasil['email']);  
 	$situs = stripslashes($hasil['situs']);  
 	$pesan = stripslashes($hasil['pesan']);  
 $time  = $hasil['waktu'];   
  ?>  
          <li> <strong><font color="#FF0000"><?php echo $nama;?></font></strong>               -  <strong>email</strong>:<a  href="mailto:<?php echo $email ?>"><?php echo $email?>  </a>               -  <strong>situs</strong>:<a  href="<?php echo $situs ?>" target="_blank"><?php echo  $situs ?> </a>               - <?php echo $time ?><br>              <?php echo nl2br($pesan); ?> <br>  
            <br>  
            <?php } ?>  
        </ol></p>  
        </td>  
    </tr>  
    <tr>   
      <td 	height="15" 	align="center" 	valign="middle">created 	by 	<a  href="http://ajibsusanto.blogspot.com">Mr Jj</a></td>      </tr>  
    <tr>  
      <td height="6"></td>  
    </tr>  
  </table>  
</div>  
</body>  
</html>  
 
