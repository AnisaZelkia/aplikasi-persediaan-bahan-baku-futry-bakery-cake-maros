<title>Toko Bina Daya</title>

<?php
error_reporting(0);
session_start();

include('inc/function.php');
include('inc/config.php');
include('inc/header-front.php'); 

$pg = '';
//echo 'YESEEEEEE'; 
/*
 * PHP Code untuk mendapatkan halaman view masing masing tabel
 */
if ( !isset($_GET['pg']) ) 
{
	//echo 'sdfsdfsdfsdfsdf';
	$x=updatestok();
	include('page/produk.php');
} 
else 
{   
	$mod = $_GET['mod'];
	$pg  = $_GET['pg'];
	$file=$mod."/". $pg . ".php";
	//echo $sfile;
	include  $file;
	
}

include('inc/footer-front.php');
?>
