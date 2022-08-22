<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "futri";

$konek = new mysqli($db_host, $db_user, $db_pass, $db_name);

 if($konek->connect_error){
//	  echo 'Koneksi berhasil Mas';
	  echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
      die("connection failed:".$konek->connect_error);
	
}else{
//echo 'Koneksi berhasil Mas';
mysqli_select_db($konek,$db_name); 
}



	
?>