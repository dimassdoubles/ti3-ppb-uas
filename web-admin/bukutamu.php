<?php  
include "mysqli_koneksi.php";  //jika ditekan tombol submit  
if(isset($_POST['submit'])) {  
 $nama  = addslashes($_POST['nama']);  
	$email  = addslashes($_POST['email']);  
	$situs = addslashes($_POST['situs']);  
	$pesan  = addslashes(strip_tags($_POST['pesan']));  
 //jika nama dan pesan tidak kosong  
 if(!empty($nama) && !empty($pesan)) {  
 	$sql	=	mysqli_query($conn,"INSERT INTO bukutamu(nama,situs,email,pesan,waktu) VALUES('$nama','$situs','$email','$pesan',NOW())");  
 	if($sql) {  
	?>  
 		<script language="JavaScript">  
		alert('Terima kasih. Anda telah mengisi buku tamu');  
 		document.location='lihat_bukutamu.php';  
	</script>  
	<?php  
 	} else {  
 		echo "Error: " . $sql . "<br>" . mysqli_error($conn);;  }  
 } else {  
  ?>  
	<script language="JavaScript">alert('Nama dan pesan harus diisi');</script>  
	<?php  
	}
}	
?>  
<html>  
<head>  
<title>Buku Tamu</title>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">  
<link href="style.css" rel="stylesheet" type="text/css">  
</head>  
<body onLoad="document.frmguest.nama.focus()">  
<div align="center">  
  <table width="481" border="0" cellpadding="0" cellspacing="0">  
    <!--DWLayoutTable-->  
    <form action="" method="post" name="frmguest">  
      <tr>   
        <td height="21" colspan="2" align="center" valign="middle" class="header">ISI BUKU TAMU</td>        </tr>  
      <tr>   
        <td height="15" colspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>  
      </tr>  
      <tr>   
        <td width="101" height="18" valign="middle">&nbsp;Nama*</td>  
        <td width="378" valign="middle">:   
          <input name="nama" type="text" id="nama" size="20" maxlength="20"> </td>  
      </tr>  
      <tr>   
        <td height="18" valign="middle">&nbsp;Email</td>  
        <td valign="middle">:   
          <input name="email" type="text" id="email" size="30" maxlength="30"></td>  
      </tr>  
      <tr>   
        <td height="18" valign="middle">&nbsp;Situs</td>  
        <td valign="middle">:   
          <input  name="situs"  type="text"	id="situs"	value="http://"	size="50"  maxlength="50"></td>        </tr>  
      <tr>   
        <td height="101" valign="top">&nbsp;Pesan*</td>  
        <td  valign="top">  &nbsp;  <textarea name="pesan" cols="60" rows="7"  id="pesan"></textarea>           </td>  
      </tr>  
      <tr>   
        <td height="13" colspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>  
      </tr>  
      <tr>   
        <td height="18" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>  
        <td  valign="top"><input  name="submit" type="submit" id="submit" value="Isi  Bukutamu">             <input type="reset" name="Reset" value="Batal">            &nbsp;<a href="lihat_bukutamu.php">Lihat Bukutamu</a></td>        </tr>  
      <tr>   
        <td height="14"></td>  
        <td></td>  
      </tr>  
    </form>  
  </table>  
</div>  
</body>  
</html>  
