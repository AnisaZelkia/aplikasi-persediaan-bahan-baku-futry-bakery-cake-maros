													<div class="col-sm-10">
													<label for="inputText3" class="col-form-label">Tanggal Laporan</label>
													 <select name='tgl' id='tgl' class="form-control" required >
													 <option value=''>-------Pilih Tanggal Laporan-----</option> 
													  <?php
														include 'koneksi.php';
													     $lap=$_POST['lap'];
														 if($lap=='beli')
														 $kueri=mysqli_query($konek,"select * from vbeli group by tgl order by tgl desc");
														 else
														 $kueri=mysqli_query($konek,"select * from dtproduksi group by tgl order by tgl desc");
														 while ($dt=mysqli_fetch_array($kueri))
														 {
													?>
													<option value="<?=$dt['tgl'];?>"><?=$dt['ftgl'];?></option>	
													<?php
														 }
													 ?>	
													 </select>
													
													</div>
													
													<script>
														$("#tgl").click(function(){														
														var lap=$("#lap").val();   
														var tgl=$("#tgl").val();   
													
														if(lap=='beli') 
														{	
														$.ajax({															
															type: "POST",
															dataType: "html",
															url: "getlapbeli.php",										
															data: "tgl="+tgl,
															success: function(data){
															   $("#laporan").html(data);
															}
														});
														}
														else  
														{	
														$.ajax({															
															type: "POST",
															dataType: "html",
															url: "getlapproduk.php",										
															data: "tgl="+tgl,
															success: function(data){
															   $("#laporan").html(data);
															}
														});	
														}														
													});
													</script>