<?php 
session_start();
include('../inc/config.php');
include('../inc/function.php');
include ('../chart/chart.inc.php');

//memanggil status login 
update_status_login("0",$_SESSION['idpelanggan']);
$ip=getip();
$x=mysqli_query($konek,"delete from id where ip='$ip'");
session_destroy();
	echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../index.php'>";
					exit();
//header("location:../index.php");
?>