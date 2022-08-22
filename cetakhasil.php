<?php
session_start();
$nama=$_SESSION['nama'];
$level=$_SESSION['level'];
include 'koneksi.php';
$dt=mysqli_fetch_array(mysqli_query($konek,"select * from lap"));
$lead=$dt['lt'];
?>                                 
								 <div class="form-group">
								 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" align='center'>
								   <button type='button' class='btn btn-danger btn-xs' id='ttp'> <span class='fa fa-print'></span> Tutup</i></button>
								 </div>
								 </div>
											<script>
														$("#ttp").click(function(){	
														document.getElementById('hasil').style.display = 'block'; 
														document.getElementById('cetak').style.display = 'none';
														document.getElementById('ld').style.display = 'block';
																									
														
													});

													</script>	
													
								 <?php
								 $nfile='minmax'.rand();
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
										<td width='700' align='center'><b>LAPORAN HASIL FORECASTING PENGADAAN BAHAN BAKU</b>
										</td>
									</tr>
									<tr>
										<td width='700' align='center'><b>LEAD TIME: <?=$lead;?> HARI</b>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td> 
									</tr>
								
								</table>
								
								 <table width='700' border='1' cellspacing="-1">
                                          <thead> 
                                            <tr bgcolor='#DCDCDC'>
                                                <th>No.</th>
                                                <th>Bahan Baku</th>
                                                <th>Satuan</th> 
                                                <th>Stok</th>                                              
                                                <th>Safety Stok</th>                                              
                                                <th>Min Inventory</th>                                              
                                                <th>Max Inventori </th>                                              
                                                <th>Beli </th>                                              
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											
											$exe=mysqli_query($konek, "select * from lap order by bahan");
											$no=1;
											while($rec=mysqli_fetch_array($exe))
											{  
												echo "<tr>
													 <td align='center' width='5%'>$no.</td>
													 <td width='35%' >$rec[bahan]</td>
													 <td width='10%' align='center'>$rec[satuan]</td>
													 <td width='10%' align='center'>".number_format($rec['fakhir'],1)."</td>
													 <td width='10%' align='center'>".number_format($rec['safety'],1)."</td>
													 <td width='10%' align='center'>".number_format($rec['minstok'],1)."</td>
													 <td width='10%' align='center'>".number_format($rec['maksstok'],1)."</td>
													 <td width='10%' align='center'>".number_format($rec['jbeli'],1)."</td></tr>";
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