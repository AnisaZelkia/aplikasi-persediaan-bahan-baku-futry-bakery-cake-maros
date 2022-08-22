<?php
session_start();
$_SESSION['idpelanggan']=$idpelanggan;
$total_bayar = $_SESSION['totalbayar'];
include '../inc/config.php';
include ('../inc/function.php');
include ('../chart/chart.inc.php');

//data dari pelanggan
if(isset($_POST)){
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$telp = $_POST['telp'];
$kodepos = $_POST['kodepos'];
$kelamin = $_POST['kelamin'];
$aksi = $_POST['aksi'];
//$id = $_POST['id'];
$kota = $_POST['kota'];


if ($aksi == 'register') {
	$sql = "insert into pelanggan(nama,alamat,kelamin,
	kodepos,email,telp,password,tanggal_daftar,kota)
		values('$nama',
		'$alamat','$kelamin','$kodepos','$email','$telp','$password',curdate(),'$kota')";
} else if ($aksi == 'edit') {

	$sql = "update pelanggan set nama='$nama',
	,kodepos='$kodepos',email='$email',alamat='$ikategori',telp='$telp',password='$password'
	where idpelanggan='$id'";

}

$result = mysqli_query($konek,$sql) or die(mysqli_error());
$sql="select * from pelanggan where password='$password' and email='$email'";
$sql = mysqli_query($konek,$sql) or die(mysqli_error());
$row=mysqli_fetch_array($sql);
$idpelanggan=$row['idpelanggan'];
//echo 'Id Pelanggan :'.$idpelanggan;

$kd_transaksi = kd_transaksi();
$ip=getip();
$sql="select * from temp where ip='$ip'";
$sql = mysqli_query($konek,$sql);
$pesan=mysqli_fetch_array($sql);
$total_bayar = $pesan['total_bayar'];

insertToDB($kd_transaksi,$idpelanggan,$total_bayar);
update_status_login("1",$idpelanggan);


unset($_SESSION['chart']);
//check if query successful
if ($result) {

$sql = "select * from pelanggan where email='$email' and password='$password'";
$sql_login = mysqli_query($konek,$sql) or die(mysqli_error());
$hasil = mysqli_fetch_object($sql_login);

if (mysqli_num_rows($sql_login) > 0) { 
    session_start();
	$_SESSION['idpelanggan'] = $hasil->idpelanggan;
	$ip=getip();
	$x=mysqli_query($konek,"delete from id where ip='$ip'");
	$x=mysqli_query($konek, "insert into id (ip, idpelanggan) values ('$ip',$hasil->idpelanggan)");
}
    

    
//	header('location:../index.php?mod=user&pg=input_biodata&status=0');
$link="../index.php?mod=chart&pg=finish&total_bayar=$total_bayar&kd_transaksi=$kd_transaksi&sts=finish";
	echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../index.php?mod=chart&pg=finish&total_bayar=$total_bayar&kd_transaksi=$kd_transaksi&sts=finish'>";
					exit();
header($link);
} else {
    	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php?user&pg=input_biodata&status=1">';
					exit();
					
	//header('location:../index.php?user&pg=input_biodata&status=1');
//    header("Location:../index.php?mod=user&pg=profil");

}
}
?>
