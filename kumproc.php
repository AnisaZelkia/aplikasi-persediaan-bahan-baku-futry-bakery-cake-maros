<?php
//$x=upkuisioner();

//$exe=trend();
//echo $exe;
function min_max()
{ include 'koneksi.php';
  $exe=mysqli_query($konek,"update bahan set maks=0, rata=0, fakhir=0, lt=6");
  $sql="update bahan pt, maks p SET pt.maks = p.maks,  pt.rata=p.rata where pt.id = p.idbahan"; 
  $exe=mysqli_query($konek,$sql); 
  $exe=mysqli_query($konek,"update bahan set fakhir=ROUND(IF(((`bahan`.`satuan` = 'Gram') OR (`bahan`.`satuan` = 'Cc')),(`bahan`.`akhir` / 1000),IF((`bahan`.`satuan` = 'Ml'),(`bahan`.`akhir` / 1000),`bahan`.`akhir`)),2)");
  $exe=mysqli_query($konek,"update bahan set safety=round((maks-rata)*(lt/30),1)");
  $exe=mysqli_query($konek,"update bahan set minstok=round((rata*lt/30)+safety,1)");
  $exe=mysqli_query($konek,"update bahan set maksstok=round(2*rata*lt/30,1)");
  $exe=mysqli_query($konek,"update bahan set jbeli=if(minstok>fakhir,maksstok-fakhir,if(minstok=fakhir,maksstok-minstok,0))");
  $jml=mysqli_num_rows(mysqli_query($konek,"select * from bahan where jbeli>0"));
  return $jml;  
}

function bulan($x)
{
	$bln = array("JANUARI", "PEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
	return $bln[$x];
}
function kpk($a, $b) { 
  return ( $a / gcf($a,$b)) * $b; 
}

function gcf($a, $b) { 
  return ( $b == 0 ) ? ($a):( gcf($b, $a % $b) ); 
}

function format_tgl($tgl)
{ return substr($tgl,6,4).'-'.substr($tgl,0,2).'-'.substr($tgl,3,2);
}



function tanggal()
{ $tgl=date('d');
  $bln=date('m');		
  $thn=date('Y');		
  if($bln=='01') $cbln=' Januari '; 
  if($bln=='02') $cbln=' Pebruari '; 
  if($bln=='03') $cbln=' Maret '; 
  if($bln=='04') $cbln=' April '; 
  if($bln=='05') $cbln=' Mei '; 
  if($bln=='06') $cbln=' Juni '; 
  if($bln=='07') $cbln=' Juli '; 
  if($bln=='08') $cbln=' Agustus '; 
  if($bln=='09') $cbln=' September '; 
  if($bln=='10') $cbln=' Oktober '; 
  if($bln=='11') $cbln=' November '; 
  if($bln=='12') $cbln=' Desember '; 
  return $tgl.$cbln.$thn;
}

function tglindo($x)
{ $tgl=substr($x,0,2);
  $bln=substr($x,3,2);		
  $thn=substr($x,6,4);		
  if($bln=='01') $cbln=' Januari '; 
  if($bln=='02') $cbln=' Pebruari '; 
  if($bln=='03') $cbln=' Maret '; 
  if($bln=='04') $cbln=' April '; 
  if($bln=='05') $cbln=' Mei '; 
  if($bln=='06') $cbln=' Juni '; 
  if($bln=='07') $cbln=' Juli '; 
  if($bln=='08') $cbln=' Agustus '; 
  if($bln=='09') $cbln=' September '; 
  if($bln=='10') $cbln=' Oktober '; 
  if($bln=='11') $cbln=' November '; 
  if($bln=='12') $cbln=' Desember '; 
  return $tgl.$cbln.$thn;
}

function kdbahan()
{ include 'koneksi.php';
  $dt=mysqli_fetch_array(mysqli_query($konek,"select kdbahan+1 as nm from bahan order by kdbahan desc"));
  $nm=$dt['nm'];
  if(empty($nm)) $nm='01';  
  else
  { if($nm<10) $nm='0'.$nm; 
  }
 
  return $nm;	
}



function rnd($x)
{ $desimal=substr($x,2,6);
  //Mencari Nilai > 0
  $posisi=0;
  $pjg=strlen($desimal);
  $i=0; 
  while($i<$pjg) 
  { $cr=substr($desimal,$i,1); 
    if($cr>=1)
	  $posisi=$i+1; 
	$i++;
  }
  
  $titik='';
  $int='';
  $i=0;
  while ($titik!='.')
  { $int+=substr($x,$i,1);
	if(substr($x,$i,1)=='.')
		$titik='.';
    $i++;
	  
  }	  
  if($posisi==0 and $int==0)
	$desimal='-';
  else if($posisi==0)	  
    $desimal=$int;
  else if($int>0)
	  $desimal=$int.substr($desimal,0,$posisi);
  else	  
    $desimal=$int.'.'.substr($desimal,0,$posisi);
  return $desimal;
  //return $nm;	
}


function kdproduk()
{ include 'koneksi.php';
   $sql="select substring(kdproduk,3,2)+1 as nm from produk order by substring(kdproduk,3,2) desc";	
   echo $sql;
  $dt=mysqli_fetch_array(mysqli_query($konek,$sql));
  $nm=$dt['nm'];
  if(empty($nm)) $nm='P-'.'01';  
  else
  { if($nm<10) $nm='P-'.'0'.$nm; 
  }
 
  return $nm;	
}

function notabeli()
{ include 'koneksi.php';
   $thn=date('Y');
   $sql="select substring(notabeli,9,4)+1 as nm from notabeli where year(tgl)='$thn' order by substring(notabeli,9,4) desc";	
	 
  $dt=mysqli_fetch_array(mysqli_query($konek,$sql));
  $nm=$dt['nm'];
  if(empty($nm)) $nm='0001';  
  else
  { if($nm<10) $nm='000'.$nm; 
    else if($nm<100) $nm='00'.$nm; 
	else if($nm<1000) $nm='0'.$nm; 
  }
  $nm='FB-'.$thn.'-'.$nm;
  return $nm;	
  
}function notaproduksi()
{ include 'koneksi.php';
   $thn=date('Y');
   $sql="select substring(notaproduksi,9,4)+1 as nm from notaproduksi where year(tgl)='$thn' order by substring(notaproduksi,9,4) desc";	
	 
  $dt=mysqli_fetch_array(mysqli_query($konek,$sql));
  $nm=$dt['nm'];
  if(empty($nm)) $nm='0001';  
  else
  { if($nm<10) $nm='000'.$nm; 
    else if($nm<100) $nm='00'.$nm; 
	else if($nm<1000) $nm='0'.$nm; 
  }
  $nm='FP-'.$thn.'-'.$nm;
  return $nm;	
}

function ftgl($x)
{   
   $thn=substr($x,6,4);
   $bln=substr($x,3,2);
   $day=substr($x,0,2);
   $tgl=$thn.'-'.$bln.'-'.$day;
  return $tgl;	
}
function ftgl1($x)
{ 
   $thn=substr($x,0,4);
   $bln=substr($x,5,2);
   $day=substr($x,8,2);
   $tgl=$day.'-'.$bln.'-'.$thn;
  return $tgl;	
}

function stokbahan()
{  include 'koneksi.php';
   //Baca Pakai
   $bhn="select * from bahan";
   $bhn=mysqli_query($konek,$bhn);
   while($pk=mysqli_fetch_array($bhn))
   {   $idbahan=$pk['id'];
	 //Baca Beli
	   $sql="select sum(beli) as beli from beli where idbahan='$idbahan'";
	  
	   $bl=mysqli_fetch_array(mysqli_query($konek,$sql));
	   $beli=$bl['beli'];          
	   //Baca Pakai
	   $cr="select sum(pakai) as pakai from pakai where idbahan='$idbahan'";	   
	   // echo $cr;
       $bc=mysqli_query($konek,$cr);
	   $bc=mysqli_fetch_array($bc);
	   $pakai=$bc['pakai'];
	   $x=mysqli_query($konek,"update bahan set beli='$beli', pakai='$pakai', akhir=stok+beli-pakai where id='$idbahan'");   
   }
}


function pakai($kdproduk)
{  include 'koneksi.php';
   //Baca Beli
   $sql="select sum(qty) as beli from beli where kdbahan='$x'";
   $bl=mysqli_fetch_array(mysqli_query($konek,$sql));
   $beli=$bl['beli'];
   //Pemakaian
   $sql="select sum(qty) as pakai from pakaibahan where kdbahan='$x'";
   $bl=mysqli_fetch_array(mysqli_query($konek,$sql));
   $pakai=$bl['pakai'];   
   $x=mysqli_query($konek,"update bahan set beli='$beli', pakai='$pakai', akhir=stok+beli-pakai where kdbahan='$x'");   
}


function upkuisioner()
{
	
}


?>

