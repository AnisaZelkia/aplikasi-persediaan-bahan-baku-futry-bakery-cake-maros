<?php
session_start();
$nama=$_SESSION['nama'];
$level=$_SESSION['level'];
include 'koneksi.php';
$dt=mysqli_fetch_array(mysqli_query($konek,"select * from bahan"));
$lead=$dt['lt'];
?>   
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Futry Bakery & Cake</title>
   <link rel="icon" type="images/jpg" href="assets/images/logo.jpg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
	
	
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
    
		<?php include 'kop.php';?>
       
       <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                   <?php include 'menu_admin.php';
				   ?>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
               
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- data table multiselects  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0" align='center'><font color='blue'><b>INFORMASI PEMBELIAN BAHAN BAKU</b></font></h5>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                                                  
								 <div class="form-group">
								 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" align='center'>
								   <a href='home.php'> <button type='button' class='btn btn-danger btn-xs' id='ttp'> <span class='fa fa-print'></span> Tutup</i></button></a>
								 </div>
								 </div>
											
													
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
											
											$exe=mysqli_query($konek, "select * from vbahan order by bahan");
											$no=1;
											while($rec=mysqli_fetch_array($exe))
											{  
												echo "<tr>
													 <td align='center' width='5%'>$no.</td>
													 <td width='35%' >$rec[bahan]</td>
													 <td width='10%' align='center'>$rec[fsatuan]</td>
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
									
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end data table multiselects  -->
                    <!-- ============================================================== -->
                </div>
            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    
</body>
 
</html>

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