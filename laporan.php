<?php
session_start();
$nama=$_SESSION['nama'];
include 'koneksi.php';
include 'kumproc.php';
$tgl=date('m-d-Y');
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Futry Bakery & Cake</title>
   <link rel="icon" type="images/jpg" href="assets/images/logo.jpg">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
    <link rel="stylesheet" href="assets/vendor/inputmask/css/inputmask.css" />
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />	
</head>
<script src="jquery.min.js"></script>
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
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <!--div class="col-xl-1"></div-->
                    <div class="col-xl-12">
                       
                        <!-- ============================================================== -->
                        <!-- basic form  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
								<form action="#" id="basicform" data-parsley-validate="" method="post" nctype="multipart/form-data">
                                    <h3 class="card-header" align='left'>CETAK LAPORAN</h3>
                                    <div class="card-body">
                                        <form>
										<table width='100%'>
											<tr>
												<td width='50%'>
													<div class="form-group">
													<div class="col-sm-10">
													<label for="inputText3" class="col-form-label">Laporan</label>
													 <select name='lap' id='lap' class="form-control" required />
													 <option value=''>-------Pilih Laporan-----</option> 
													 <option value='beli'>--Pembelian Bahan Baku--</option> 
													 <option value='produk'>--Produksi Roti--</option> 
													 
													 </select>
													
													</div>
												</div>
												</td>
												<td width='50%'>
													<div class="form-group" id='tanggal'>
													
												</div>
												</td>
											</tr>
										</table>
										
										<div class="form-group" id='laporan' >
											
										</div>
											<script>
														$("#lap").click(function(){														
														var lap=$("#lap").val();   
														
													
														$.ajax({															
															type: "POST",
															dataType: "html",
															url: "gettanggal.php",										
															data: "lap="+lap,
															success: function(data){
															   $("#tanggal").html(data);
															}
														});
																										
													});
													
													
									
													
													
													</script>		
												
												
															
									<form>
                    </div>
                     
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
		<div class="col-xl-2"></div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script src="assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>

    <script src="assets/vendor/datepicker/moment.js"></script>
    <script src="assets/vendor/datepicker/tempusdominus-bootstrap-4.js"></script>
    <script src="assets/vendor/datepicker/datepicker.js"></script>	
</body>
 
</html>
