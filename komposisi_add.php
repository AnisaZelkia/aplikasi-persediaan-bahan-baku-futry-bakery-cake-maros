<?php
session_start();
include 'koneksi.php';
$aksi=$_GET['aksi'];
$idproduk=$_GET['idproduk']; 
$produk=$_GET['produk']; 
$komposisi='';
$idbahan='';

$id='';
if($aksi=='Edit')
{  $id=$_GET['id'];
	$sql="select * from vkomposisi  where id='$id'";
//echo $sql;
   $rec=mysqli_fetch_array(mysqli_query($konek,$sql)); 
   $komposisi=$rec['komposisi'];   
   $idbahan=$rec['idbahan'];    
	
}
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
                    <div class="col-xl-2"></div>
                    <div class="col-xl-7">
                       
                        <!-- ============================================================== -->
                        <!-- basic form  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
								<form action="#" id="basicform" data-parsley-validate="" method="post" nctype="multipart/form-data">
                                    <h3 class="card-header" align='center'><?=$aksi;?> Komposisi Bahan Baku <font color='red'> <?=$produk;?></font> </h3>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
												<div class="col-sm-10">
                                                <label for="inputText3" class="col-form-label">Roti <?=$idbahan;?></label>
												
													<input name="idproduk" type="text" class="form-control" placeholder=' ' readonly value='<?=$produk;?>'>
												</div>	
                                            </div> 
                                            <div class="form-group">
												<div class="col-sm-10">
                                                <label for="inputText3" class="col-form-label">Bahan Baku</label>												
													<select name="idbahan" id='idbahan' class="form-control" required  autofocus>
														<option value=''>-----Pilih Bahan Baku-----</option>
														<?php
															$bhn=mysqli_query($konek,"select * from bahan order by bahan asc;");
															while($dt=mysqli_fetch_array($bhn))
															{
														?>
														<option value="<?=$dt['id'];?>" <?php if($idbahan==$dt['id']) echo 'selected';?>><?=$dt['bahan'];?></option>	 
														<?php
															}
														?>	
													</select>
												</div>	
                                            </div>
											
											
                                            <div class="form-group" id='stn' style="display:'none'"> 
                                            </div>
											
                                            <div class="form-group">
												<div class="col-sm-3">
                                                <label for="inputText3" class="col-form-label">Jumlah</label>
												
													<input name="komposisi" type="text" class="form-control" placeholder=' ' required value='<?=$komposisi;?>'>
												</div>	
                                            </div>
											
											<div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="submit" id="simpan" name='simpan' class="btn btn-success btn-xs"><span class='fa fa-save'></span>&emsp;Simpan</button>
                                                    <a href='komposisi.php?idproduk=<?=$idproduk;?>&produk=<?=$produk;?>' <button type='button' class='btn btn-danger btn-xs'><span class='fa fa-times'></span>&emsp;Tutup</button></a>
                                                </p>
                                            </div>
                                        </div>
										<script>
														$("#idbahan").click(function(){														
														var idbahan=$("#idbahan").val(); 
														//alert (idbahan);
														document.getElementById('stn').style.display = 'block'; 
														$.ajax({
															type: "POST",
															dataType: "html",
															url: "getbahan.php",										
															data: "idbahan="+idbahan,
															success: function(data){
															   $("#stn").html(data);
															}
														});
													});

												</script>
									<?php	
									if(isset($_POST['simpan']))
									{
										
										$idbahan=$_POST['idbahan'];
										$komposisi=$_POST['komposisi']; 
										if($aksi=='Tambah')
											$sql="insert into komposisi(idproduk,komposisi,idbahan) values('$idproduk','$komposisi','$idbahan') on duplicate key update komposisi='$komposisi'; ";
										else
											$sql="update komposisi set idproduk='$idproduk', komposisi='$komposisi', idbahan='$idbahan' where id='$id'";
										//echo $sql;
										$x=mysqli_query($konek,$sql);
						
										if($x>0)										
										echo"<div class='panel-body'>
												<div class='modal-wrapper'>
												<div class='modal-icon'>
														<i class='fa fa-check'></i>
													</div>
													<div class='modal-text'>
														<h4>Sukses</h4>
														<p> Simpan Data Komposisi Bahan Baku</p>
													</div>
												</div>
											</div>
											<footer class='panel-footer'>
												<div class='row'>
													<div class='col-md-12 text-right'>
														<a href='komposisi.php?idproduk=$idproduk&produk=$produk'><button class='btn btn-success modal-dismiss' type='button'>OK</button></a>
														
													</div>
												</div>
											</footer>";	
											else
										echo"<div class='panel-body'>
												<div class='modal-wrapper'>
												<div class='modal-icon'>
														<i class='fa fa-check'></i>
													</div>
													<div class='modal-text'>
														<h4>Gagal </h4>
														<p>Simpan Data Komposisi Bahan Baku</p>
													</div>
												</div>
											</div>
											<footer class='panel-footer'>
												<div class='row'>
													<div class='col-md-12 text-right'>
														<a href='Komposisi_add.php?id=$id&aksi=$aksi&idproduk=$idproduk&produk=$produk'><button class='btn btn-success modal-dismiss' type='button'>OK</button></a>													
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
    <script>
    $(function(e) {
        "use strict";
        $(".date-inputmask").inputmask("dd/mm/yyyy"),
            $(".phone-inputmask").inputmask("(999) 999-9999"),
            $(".international-inputmask").inputmask("+9(999)999-9999"),
            $(".xphone-inputmask").inputmask("(999) 999-9999 / x999999"),
            $(".purchase-inputmask").inputmask("aaaa 9999-****"),
            $(".cc-inputmask").inputmask("9999 9999 9999 9999"),
            $(".ssn-inputmask").inputmask("999-99-9999"),
            $(".isbn-inputmask").inputmask("999-99-999-9999-9"),
            $(".currency-inputmask").inputmask("$9999"),
            $(".percentage-inputmask").inputmask("99%"),
            $(".decimal-inputmask").inputmask({
                alias: "decimal",
                radixPoint: "."
            }),

            $(".email-inputmask").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
                greedy: !1,
                onBeforePaste: function(n, a) {
                    return (e = e.toLowerCase()).replace("mailto:", "")
                },
                definitions: {
                    "*": {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            })
    });
    </script>
</body>
 
</html>
