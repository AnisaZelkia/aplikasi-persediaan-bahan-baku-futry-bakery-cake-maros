<?php
session_start();
include 'koneksi.php';
include 'kumproc.php';
$idbahan=$_GET['idbahan'];
$lead=$_GET['lead'];
$bc="select * from vbahan where id='$idbahan'"; 
$nt=mysqli_fetch_array(mysqli_query($konek,$bc));
$stok=$nt['fakhir'];
$satuan=$nt['fsatuan'];
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
                    <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-12">&nbsp;</div>
                    <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0" align='center'><font color='blue'><b>IMPLEMENTASI MIN-MAX INVENTORI</b></font></h5>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                          
										  
                                            <tr>                                                
                                                <td colspan='2'>Nama Bahan Baku</td>
                                                <td colspan='2'><?=$nt['bahan'];?></td>                               
											</tr>
                                            <tr>                                                
                                                <td colspan='2'>Lead Time (C)</td>
                                                <td colspan='2'><?=round($_GET['lead']*30,0);?> Hari</td>                               
											</tr>
                                            <tr>                                                
                                                <td colspan='2'>Stok </td>
                                                <td colspan='2'><?=$nt['fakhir'];?> <?=$nt['fsatuan'];?> </td>                               
											</tr>
										  
                                            <tr><td align='center'  colspan='3'>&nbsp;</td></tr>
                                            <tr>
                                                <td align='center'><b>No.</b></td>
                                                <td align='center'><b>No. Produksi</b></td>
                                                <td align='center'><b>Tanggal Pemakaian</b></td>
                                                <td align='center'><b>Jumlah</b></td>                                         
											</tr>
                                        <tbody>
										<?php
											include 'koneksi.php';
											$bc="select * from totpakai where idbahan='$idbahan'";
											
											$exe=mysqli_query($konek, $bc);
											$no=1;
											$tot=0;
											$maks=0;
											$C=$lead;
											while($rec=mysqli_fetch_array($exe))
											{ 	
												$jpakai=number_format($rec['jpakai'],2);
												$satuanbahan=$rec['satuanbahan'];
												if($rec['jpakai']>$maks)
													$maks=$rec['jpakai'];
												echo "<tr>
													 <td align='center' width='5%'>$no.</td>
													 <td width='30%' align='center' >$rec[notaproduksi]</td>
													 <td width='35%' align='center' >".tglindo($rec['ftgl'])."</td>
													 <td width='30%' align='center'>$jpakai $rec[satuanbahan]</td></tr>";
													 
													$no++;	
													$tot+=$rec['jpakai'];
											
											}
												$rata=$tot/($no-1);
												$R=round(($maks-$rata)*$C,2);
												$min=$rata*$C+$R;
												$max=2*$rata*$C;
											?>
                                 
                                        </tbody>
										<tfoot>
										<tr>
											<td colspan='3'>Pemakaian Maksimum </td>
											<td align='center'><?=number_format($maks,2);?> <?=$satuan;?></td>
										</tr>
										<tr>
											<td colspan='3'>Rata-rata Pemakaian (T)</td>
											<td align='center'><?=number_format($rata,2);?> <?=$satuanbahan;?></td>
										</tr>
										<tr>
											<td colspan='2'>Safety Stock (R)</td>
											<td colspan='2'>=&emsp;(Pemakaian Maksimum - T) x C<br>
											= &emsp;(<?=number_format($maks,2);?> - <?=number_format($rata,2);?>) x <?=$C;?> = <?=number_format($R,2);?> <?=$satuanbahan;?></td>
										</tr>
										<tr>
											<td colspan='2'>Minimum Inventory</td>
											<td colspan='2'>=&emsp;(T x C) + R<br>
											= &emsp;(<?=number_format($rata,2);?> x <?=number_format($C,0);?>) + <?=$R;?> = <?=number_format($min,2);?> <?=$satuanbahan;?></td>
										</tr>
										<tr>
											<td colspan='2'>Maximum Inventory</td>
											<td colspan='2'>=&emsp;2 x (T x C) <br>
											= &emsp;(2 x <?=number_format($rata,2);?> x <?=number_format($C,0);?>) = <?=number_format($max,2);?> &emsp;<?=$satuanbahan;?></td>
										</tr>
										<tr>
											<td colspan='2'>Jumlah Pengadaan</td>
											<td colspan='2'>Jika Stok < Minimum Inventory Maka Beli=Maximum Inventory - Stok  <br>
															Jika Stok = Minimum Inventory Maka Beli=Maximum Inventory - Minimum Inventory<br>  
															<?php 
																if($stok<$min)
																echo "Karena $stok (Stok) < ".number_format($min,2)." (Minimum Inventory) Maka Beli= ".number_format($max,2)." - ".number_format($stok,2)." =".number_format($max-$stok,2).' '.$satuanbahan;
															else 
																echo "Karena $stok (Stok) = ".number_format($min,2)." (Minimum Inventory) Maka Beli= ".number_format($max,2)." - ".number_format($min,2)." =".number_format($max-$min,2).' '.$satuanbahan;
															?>
											
										</tr>
										<tr>
										<td colspan='6' align='center'>
											
											<a href='min_max.php' <button type='button' class='btn btn-danger btn-xs'><span class='fa fa-times'></span>Tutup</button></a>
										</td>
										</tr>
										</tfoot>
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