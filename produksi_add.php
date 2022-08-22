<?php
session_start();
include 'koneksi.php';
include 'kumproc.php';
$aksi=$_GET['aksi'];
$notaproduksi=$_GET['notaproduksi'];
$sql="select * from vnotaproduksi where notaproduksi='$notaproduksi'";
echo $sql;
$nota=mysqli_fetch_array(mysqli_query($konek,$sql));

   
$produksi='';
$id='';
$nama='';
$idproduk='';
$id='';
if($aksi=='Edit')
{  $id=$_GET['id'];
	$sql="select * from vproduksi where id='$id'";
//echo $sql;
   $rec=mysqli_fetch_array(mysqli_query($konek,$sql));
   $produksi=$rec['produksi'];   
   $notaproduksi=$rec['notaproduksi'];   
   $idproduk=$rec['idproduk'];   
	
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
                                    <h3 class="card-header" align='center'><?=$aksi;?> Data Produksi Produk Roti </h3>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
												<div class="col-sm-10">
                                                <label for="inputText3" class="col-form-label">Nota Produksi</label>
												
													<input name="nama" type="text" class="form-control"  required value='<?=$nota['notaproduksi'];?>' readonly>
												</div>	
                                            </div>
                                            <div class="form-group">
												<div class="col-sm-7">
                                                <label for="inputText3" class="col-form-label">Tanggal Produksi</label>
												
													<input name="tgl" type="text" class="form-control"  required value='<?=$nota['ftgl1'];?>'>
												</div>	
                                            </div>
                                            <div class="form-group">
												<div class="col-sm-7">
                                                <label for="inputText3" class="col-form-label">Nama Produk Roti</label>												
													<select name="idproduk"  id='idproduk' class="form-control" required>
													<option value=''>-----Silahkan Pilih Produk Roti-----</option>
													<?php
														$qr=mysqli_query($konek,"select * from produk order by produk asc");
														while($bhn=mysqli_fetch_array($qr))
														{
													?>
														<option value="<?=$bhn['id'];?>"<?php if($idproduk==$bhn['id']) echo 'selected';?>><?=$bhn['produk'];?></option> 
													<?php
														}
													?>	
													</select>
												</div>	
                                            </div>
											<div class="form-group" id='stn' style="display:'none'"> 
                                            </div>
                                            <div class="form-group">
												<div class="col-sm-7">
                                                <label for="inputText3" class="col-form-label">Jumlah Produksi</label>
												
													<input name="produksi" type="text" class="form-control"  required value='<?=$produksi;?>'>
												</div>	
                                            </div>
											<div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="submit" id="simpan" name='simpan' class="btn btn-success btn-xs"><span class='fa fa-save'></span>&emsp;Simpan</button>
                                                    <a href='notaproduksi.php?produksi=<?=$notaproduksi;?>' <button type='button' class='btn btn-danger btn-xs'><span class='fa fa-times'></span>&emsp;Tutup</button></a>
                                                </p>
                                            </div>
                                        </div>
											<script>
														$("#idproduk").click(function(){														
														var idproduk=$("#idproduk").val();  
														//alert(idproduk);
														document.getElementById('stn').style.display = 'block'; 
														$.ajax({
															type: "POST",
															dataType: "html",
															url: "getproduk.php",										
															data: "idproduk="+idproduk,
															success: function(data){
															   $("#stn").html(data);
															}
														});
													});

												</script>
												
									<?php	
									if(isset($_POST['simpan']))
									{
										
										$produksi=$_POST['produksi'];
										$idproduk=$_POST['idproduk'];
										
										if($aksi=='Tambah')
											$sql="insert into produksi(produksi,idproduk,notaproduksi ) values('$produksi','$idproduk', '$notaproduksi' ) on duplicate key update produksi='$produksi';";
										else
											$sql="update produksi set produksi='$produksi', idproduk='$idproduk', notaproduksi='$notaproduksi'  where id='$id'";
									
										$x=mysqli_query($konek,$sql);
										$stok=stokbahan();
										if($x>0)										
										echo"<div class='panel-body'>
												<div class='modal-wrapper'>
												<div class='modal-icon'>
														<i class='fa fa-check'></i>
													</div>
													<div class='modal-text'>
														<h4>Sukses</h4>
														<p> Simpan Data Produksi Roti</p>
													</div>
												</div>
											</div>
											<footer class='panel-footer'>
												<div class='row'>
													<div class='col-md-12 text-right'>
														<a href='produksi.php?notaproduksi=$notaproduksi'><button class='btn btn-success modal-dismiss' type='button'>OK</button></a>
														
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
														<p>Simpan Data  Produksi Roti</p>
													</div>
												</div>
											</div>
											<footer class='panel-footer'>
												<div class='row'>
													<div class='col-md-12 text-right'>
														<a href='produksi_add.php?id=$id&aksi=$aksi&notaproduksi=$notaproduksi'><button class='btn btn-success modal-dismiss' type='button'>OK</button></a>													
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
        $(".date-inputmask").inputmask("dd-mm-yyyy"),
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
