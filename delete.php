<?php
session_start();

include "koneksi.php";
include "kumproc.php";
$id	= $_GET["id"];
$ntabel=$_GET["tabel"];
$file=$_GET["file"];

$sql="delete from $ntabel where id='$id'";

$delete = mysqli_query ($konek, $sql);
if($ntabel=='jadwal') 
{   $nidn=$_GET['nidn'];
	$file=$_GET["file"]."?nidn=$nidn";
}	
if($ntabel=='saran') 
{   $ket=$_GET['ket'];
	$id=$_GET['id2'];
	$file=$_GET["file"]."?ket=$ket&id=$id";
}	
$stok=stokbahan();
//echo $file;
echo "<META HTTP-EQUIV='Refresh' Content='0; URL=$file'>"; 
exit();


?>