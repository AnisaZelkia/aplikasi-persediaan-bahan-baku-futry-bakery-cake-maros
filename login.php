<?php
	session_start();
?>
<?=include 'kumproc.php';?>
<?php
 $stok=stokbahan();
 ?>
<!doctype html>
<html lang="en">

 
<head>
     <?=include 'header.php';?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
         <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
         <div class="dashboard-header">
			<?=include 'kop.php';?>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                   <?=include 'menu.php';
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
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
             
                   
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- basic form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12"></div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header" align='center'><font size='4' color='blue'><b>FORM LOGIN</b></font></h5>
                                <div class="card-body">
                                    <form action="#" id="basicform" data-parsley-validate="" method="post" nctype="multipart/form-data">
									
									
                                        <div class="form-group">
                                            <label for="inputUserName">User Name</label>
                                            <input id="inputUserName" type="text" name="akun" data-parsley-trigger="change" required="" placeholder=" " autocomplete="off" class="form-control">
                                        </div> 
                                        <div class="form-group">
                                            <label for="inputPassword">Password</label>
                                            <input id="inputPassword" name="password" type="password" placeholder=" " required="" class="form-control">
                                        </div>
                                        <!--div class="form-group">
                                            <label for="inputPassword">Level</label>
                                            <select name='level' required="" class="form-control">
											<option value='' selected>----------Klik Pilihan Login Sebagai----------</option> 
											<option value='Admin'>Admin</option>
											<option value='Direktur'>Direktur</option>
											</select>
                                        </div-->
										
                                        <div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="submit" id="simpan" name='simpan' class="btn btn-primary">Login</button>
                                                    <a href='index.php' <button type="button" class="btn btn-space btn-danger">Tutup</button></a>
                                                </p>
                                            </div>
                                        </div>
									<?php
					if(isset($_POST['simpan']))
					{ include 'koneksi.php';
						
					  $akun=$_POST['akun'];
					  $password=$_POST['password'];
					  $sql="select * from admin where akun='$akun' and password='$password'";
					  
					  $jml=mysqli_num_rows(mysqli_query($konek,$sql)); 
					  if($jml<1)
						  {	echo"<div class='panel-body'>
														<div class='modal-wrapper'>
														<div class='modal-icon'>
																<i class='fa fa-check'></i>
															</div>
															<div class='modal-text'>
																<h4>Maaf Akun atau Password Tidak Valid</h4> 
														</div>
														</div>
													</div>
													<footer class='panel-footer'>
														<div class='row'>
															<div class='col-md-12 text-right'>
																<a href='login.php'><button class='btn btn-success modal-dismiss' type='button'>OK</button></a>
																
															</div>
														</div>
													</footer>";
						}		
										  
					  else
					  {
						$dt=mysqli_fetch_array(mysqli_query($konek,$sql));
						$_SESSION['nama']=$dt['nama'];
						$_SESSION['level']=$dt['level'];
						echo "<META HTTP-EQUIV='Refresh' Content='0; URL=home.php'>";
					  }	  
				}
				?>   	
										
                                    </form>
                                </div>
                            </div>
                        </div>
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
    <script src="assets/vendor/parsley/parsley.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
  
</body>
 
</html>