<?php
session_start();
include 'koneksi.php';
include 'kumproc.php';
$aksi=$_GET['aksi'];
$tgl=date('m-d-Y');
$idsupplier='';
$notaproduksi='';
$id='';
$notaproduksi=notaproduksi();
if($aksi=='Edit')
{  $id=$_GET['id'];
	$sql="select * from vnotaproduksi where id='$id'"; 
   $rec=mysqli_fetch_array(mysqli_query($konek,$sql));
   $tgl=$rec['ftgl1']; 
   $notaproduksi=$rec['notaproduksi'];   
	
}
?>
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="datepicker.css">
 
 <script type="text/javascript">
        $(function(){
            $(".tgl").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
	
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
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-7">
                       
                        <!-- ============================================================== -->
                        <!-- basic form  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
								<form action="#" id="basicform" data-parsley-validate="" method="post" nctype="multipart/form-data">
                                    <h3 class="card-header" align='center'><?=$aksi;?> Data Nota Produksi Roti</h3>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
												<div class="col-sm-10">
                                                <label for="inputText3" class="col-form-label">No. Produksi </label>
												
													<input name="no" type="text" class="form-control" placeholder=' ' required value='<?=$notaproduksi;?>' readonly >
												</div>	
                                            </div>
											
                                            
											<div class="form-group">
												<div class="col-sm-10">
												<label for="inputText3" class="col-form-label">Tanggal Produksi</label>
												<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
													<input type="text" name='tgl' class="form-control tgl" data-target="#datetimepicker1" value='<?=$tgl;?>' required />
													<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
														<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
													</div>
												</div>
												</div>
											</div>
											
											
											<div class="row">&nbsp;</div> 
											<div class="row"> 
                                            <div class="col-sm-12 pl-0">
                                                <p class="text-center">
                                                    <button type="submit" id="simpan" name='simpan' class="btn btn-success btn-xs"><span class='fa fa-save'></span>&emsp;Simpan</button>
                                                    <a href='notaproduksi.php' <button type='button' class='btn btn-danger btn-xs'><span class='fa fa-times'></span>&emsp;Tutup</button></a>
                                                </p>
                                            </div>
                                        </div>
									<?php	
									if(isset($_POST['simpan']))
									{
										
										$tgl=format_tgl($_POST['tgl']); 
										if($aksi=='Tambah')
											$sql="insert into notaproduksi(notaproduksi,tgl) values('$notaproduksi','$tgl');";
										else
											$sql="update notaproduksi set  tgl='$tgl', notaproduksi='$notaproduksi' where id='$id'";
									
										$x=mysqli_query($konek,$sql);
										//echo $sql;
										if($x>0)	
										{			
										
                                          
											
										echo"<div class='panel-body'>
												<div class='modal-wrapper'>
												<div class='modal-icon'>
														<i class='fa fa-check'></i>
													</div>
													<div class='modal-text'>
														<h4>Sukses</h4>
														<p> Simpan Data Nota Produksi</p>
													</div>
												</div>
											</div>
											<footer class='panel-footer'>
												<div class='row'>
													<div class='col-md-12 text-right'>
														<a href='notaproduksi.php'><button class='btn btn-success modal-dismiss' type='button'>OK</button></a>
														
													</div>
												</div>
											</footer>";	
										}	
											else
										echo"<div class='panel-body'>
												<div class='modal-wrapper'>
												<div class='modal-icon'>
														<i class='fa fa-check'></i>
													</div>
													<div class='modal-text'>
														<h4>Gagal </h4>
														<p>Simpan Data Nota Produksi</p>
													</div>
												</div>
											</div>
											<footer class='panel-footer'>
												<div class='row'>
													<div class='col-md-12 text-right'>
														<a href='notaproduksi_add.php?id=$id&aksi=$aksi'><button class='btn btn-success modal-dismiss' type='button'>OK</button></a>													
													</div>
												</div>
											</footer>";													
									}						
								
								?>										
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
