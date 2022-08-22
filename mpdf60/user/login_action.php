<?php
session_start();
if(isset($_POST)){
include ('../chart/chart.inc.php');
include ('../inc/config.php');
include('../inc/function.php');

	
$email = $_POST['email'];
$password = md5(trim($_POST['password']));

$sql = "select * from pelanggan where email='$email' and password='$password'";
//echo $sql;

$sql_login = mysqli_query($konek,$sql) or die(mysqli_error());
$hasil = mysqli_fetch_object($sql_login);

if (mysqli_num_rows($sql_login) > 0) { 
	$_SESSION['email'] = $email;
	$_SESSION['nama'] = $hasil->nama;
	$_SESSION['idpelanggan'] = $hasil->idpelanggan;
//	echo 'ID Pelanggan:'.$hasil->idpelanggan;
	//Simpan Data
	$ip=getip();
	$x=mysqli_query($konek,"delete from id where ip='$ip'");
	$x=mysqli_query($konek, "insert into id (ip, idpelanggan) values ('$ip',$hasil->idpelanggan)");
	
	
//memanggil status login
    update_status_login("1",$_SESSION['idpelanggan']);
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?mod=user&pg=profil">';
exit;    
	//header("Location:../index.php?mod=user&pg=profil");

}else {
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?mod=user&pg=register&loginerror=1">';
    exit;    
    //header("Location:../index.php?mod=user&pg=register&loginerror=1");
}
}
?>
