<?php
session_start();
if(isset($_POST)){
include ('../inc/config.php');
include('../inc/function.php');
include ('../chart/chart.inc.php');

$email = $_POST['email'];
$password = md5(trim($_POST['password']));
$ip=getip();
$sql="select * from temp where ip='$ip'";
$sql = mysqli_query($konek,$sql);
$pesan=mysqli_fetch_array($sql);
$total_bayar = $pesan['total_bayar'];


$sql = "select * from pelanggan where email='$email' and password='$password'";
$sql_login = mysqli_query($konek,$sql) or die(mysqli_error());
$hasil = mysqli_fetch_object($sql_login);

if (mysqli_num_rows($sql_login) > 0) { 
    session_start();
	$_SESSION['idpelanggan'] = $hasil->idpelanggan;
	$ip=getip();
	$x=mysqli_query($konek,"delete from id where ip='$ip'");
	$x=mysqli_query($konek, "insert into id (ip, idpelanggan) values ('$ip',$hasil->idpelanggan)");
	$kd_transaksi = kd_transaksi();
//	$total_bayar = $_SESSION['totalbayar'];
	insertToDB($kd_transaksi,$hasil->idpelanggan,$total_bayar);
	update_status_login("1",$hasil->idpelanggan);
	unset($_SESSION['chart']);
	$link="../index.php?mod=chart&pg=finish&total_bayar=$total_bayar&kd_transaksi=$kd_transaksi&sts=finish";
	//$link="index.php?mod=chart&pg=finish&total_bayar=$total_bayar&kd_transaksi=$kd_transaksi";

    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=$link'>";
    exit;    
//	header($link);
} else {
	
//	header("location:../index.php?mod=user&pg=biodata&loginerror=1");
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?mod=user&pg=biodata&loginerror=1">';
    exit;  	
}
}
?>
