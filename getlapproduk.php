<?php
session_start();
include 'kumproc.php';
include 'koneksi.php';
$nama=$_SESSION['nama'];
$level=$_SESSION['level'];
include 'koneksi.php'; 
$tgl=$_POST['tgl'];
?>                                 
							
										
								 <?php
								 $nfile='lapproduk'.rand();
								 error_reporting(0);
									define('_MPDF_PATH','mpdf60/'); // Tentukan folder dimana anda menyimpan folder mpdf
									include(_MPDF_PATH."mpdf.php"); // Arahkan ke file mpdf.php didalam folder mpdf
									$mpdf=new mPDF('utf-8', 'A4', 10, 'Tahoma',15, 15, 10, 15, 8, 8); // Membuat file mpdf baru
									ob_start();
								?>	
								 <table width='700' border='0'>
									<tr>
										<td width='700' align='center'><img src="assets/images/kop.jpg" height="20%" width='100%'/>
										</td>
									</tr>	
									<tr>
										<td>&nbsp;</td> 
									</tr>
									<tr>
										<td width='700' align='center'><b>DAFTAR PRODUKSI ROTI</b>
										</td>
									</tr>
									<tr>
										<td width='700' align='center'><b>TANGGAL: <?=ftgl1($tgl);?></b>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td> 
									</tr>
								
								</table>
								
								 <table width='700' border='1' cellspacing="-1">
                                          <thead> 
                                            <tr bgcolor='#DCDCDC'>
                                                <th height='30'>No.</th>
                                                <th>Nama Produk</th>
                                                <th>Satuan</th> 
                                                <th>Qty</th>                                          
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											
											$exe=mysqli_query($konek, "select * from dtproduksi where tgl='$tgl' order by produk");
											$no=1;
											while($rec=mysqli_fetch_array($exe))
											{  
												echo "<tr>
													 <td align='center' width='5%' height='30'>$no.</td>
													 <td width='35%' >$rec[produk]</td>
													 <td width='35%' align='center'>$rec[satuan]</td>
													 <td width='35%' align='center'>$rec[produksi]</td></tr>"; 
													 $no++;
											}
											?>                                 
                                        </tbody> 
										
                                    </table>
									
									
								<table width='700'>
								<tr><td colspan='2'>&nbsp;</td></tr>
								<tr>
									<td width='50%'>Maros, <?=$ctgl;?> </td>
									<td width='50%'>&nbsp;</td>
								</tr>	
								<tr>
									<td width='50%'><?=$level;?>,</td>
									<td width='50%' align='center'>&nbsp;</td>
								</tr>	
								<tr><td colspan='2'>&nbsp;</td></tr>
								<tr><td colspan='2'>&nbsp;</td></tr>
								<tr><td colspan='2'>&nbsp;</td></tr>
								<tr>
									<td width='50%'><u><b>(<?=strtoupper($nama);?>)<b/></u></td>
									<td width='50%' align='center'>&nbsp;</td>
								</tr>	
								
								</table>
								
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
///$mpdf->setFooter('{PAGENO}');
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nfile.".pdf" ,'F');
$nfile=$nfile.".pdf";
?>
<embed src="<?php echo $nfile;?>" type='application/pdf' width='100%' height='700px'/>
<?php
//echo "<iframe src='$nama' style='width: 100%;height: 750 ;border: none'></iframe>";
exit;
?>															