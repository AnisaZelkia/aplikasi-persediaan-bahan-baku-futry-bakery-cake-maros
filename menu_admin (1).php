<?php
if(!isset($_SESSION['nama']))
session_start();
	$level=$_SESSION['level'];
if(isset($_SESSION['jbeli']))
	$jbeli=$_SESSION['jbeli'];
else $jbeli=0;

?>	
<div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="home.php" data-toggle="" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-home"></i>Dashboard <span class="badge badge-success"></span></a>
                                
                            </li>
							<?php
								if($level=='Admin')
								{
							?>		
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#master" aria-controls="submenu-2"><i class="fa fa-fw fa-list"></i>File Master</a>
                                <div id="master" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="admin.php"><i class="fas fa-fw fa-file"></i>Data Admin </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="bahan.php"><i class="fas fa-fw fa-file"></i>Data Bahan Baku</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="produk.php"><i class="fas fa-fw fa-file"></i>Data Produk Roti </a>
                                        </li>
										
                                        <li class="nav-item">
                                            <a class="nav-link" href="supplier.php"><i class="fas fa-fw fa-file"></i>Data Supplier</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#transaksi" aria-controls="submenu-2"><i class="fa fa-fw fa-list"></i>Data Transaksi</a>
                                <div id="transaksi" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="notabeli.php"><i class="fas fa-fw fa-file"></i>Pembelian Bahan Baku </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="notaproduksi.php"><i class="fas fa-fw fa-file"></i>Produksi Roti </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="min_max.php"><i class="fas fa-fw fa-file"></i>Min-Max Inventory </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
						<?php
						    if($jbeli>0)
							{
								echo "<li class='nav-item'>
                                            <a class='nav-link' href='info.php'><i class='fas fa-fw fa-file'></i>Info Pembelian  
											<span class='label label-danger text-normal pull-right'>$jbeli Bahan</span></a>
                                 </li>";	
							}	
							}
							else
							{
						?>
							
                                        <li class="nav-item">
                                            <a class="nav-link" href="min_max.php"><i class="fas fa-fw fa-file"></i>Min-Max Inventory </a>
                                        </li> 
										<li class="nav-item">
                                            <a class="nav-link" href="laporan.php"><i class="fas fa-fw fa-file"></i>Cetak Laporan</a>
                                        </li>
						<?php
							}
							?>
							
								
							
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.php"><i class="fas fa-fw fa-file"></i>Log Out </a>
                                        </li>
                        </ul>
                    </div>