                                   <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                          <thead>
										  <tr>
										  
										  </tr>
                                            <tr>
                                                <th>No.</th>
                                                <th>Bahan Baku</th>
                                                <th>Satuan</th> 
                                                <th>Stok</th>                                              
                                                <th>Safety Stok</th>                                              
                                                <th>Min Inventory</th>                                              
                                                <th>Max Inventory </th>                                              
                                                <th>Beli </th>                                              
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											include 'koneksi.php';
											$lt=$_POST['lead'];
											$lead=$_POST['lead']/30;
											$exe=mysqli_query($konek, "delete from lap");
											$exe=mysqli_query($konek, "select * from vbahan order by bahan");
											$nmr=1;
											while($rec=mysqli_fetch_array($exe))
											{  $idbahan=$rec['id'];
											   $row=mysqli_fetch_array(mysqli_query($konek,"select * from maks where idbahan='$idbahan'"));	
											   $maks=$row['maks'];
											   $rata=$row['rata'];
											   $R=($maks-$rata)*$lead;
											   $min=$rata*$lead+$R;
											   $maks=2*($rata*$lead);
											   if($rec['fakhir']<$min)
												   $beli=$maks-$rec['fakhir'];
											   else if($rec['fakhir']==$min)
													$beli=$maks-$min;
											   else $beli=0;	
											$bl=$beli;	
											if($min>=$rec['fakhir'] || $min==$rec['fakhir'])											   
												$beli=number_format($beli,1);
											else 
												$beli='';	
											$bahan=$rec['bahan'];
											$satuan=$rec['fsatuan'];
											$fakhir=$rec['fakhir'];
											 $up1="insert into lap() values ('$bahan','$satuan','$lt','$R','$min','$maks','$bl','$fakhir')";
											 //echo $up1; 	
											 $up=mysqli_query($konek,$up1); 
												echo "<tr>
													 <td align='center' width='8%'>$nmr.</td>
													 <td width='22%' >$rec[bahan]</td>
													 <td width='10%' align='center'>$rec[fsatuan]</td>
													 <td width='10%' align='center'>".number_format($rec['fakhir'],1)."</td>
													 <td width='10%' align='center'>".number_format($R,1)."</td>
													 <td width='10%' align='center'>".number_format($min,1)."</td>
													 <td width='10%' align='center'>".number_format($maks,1)."</td>
													 <td width='20%' align='center'>$beli";
															if($min>=$rec['fakhir'])
														echo "&emsp;<a href='getminmax.php?idbahan=$rec[id]&lead=$lead' <button type='button' class='btn btn-success btn-xs'> <span class='fa fa-search'></span> Lihat Detail</button></a>";
													 	
												echo "</td></tr>";
													 $nmr++;
										    		 
											}
											?>                                 
                                        </tbody> 
										<tfoot>
											<td colspan='8' align='center'>
												<button type='button' class='btn btn-danger btn-xs' id='ctk'> <span class='fa fa-print'></span> Cetak Hasil <i>Forecasting</i></button>
											</td>
										</tfoot>
                                    </table>
														<script>
														$("#ctk").click(function(){	
														document.getElementById('hasil').style.display = 'block'; 
														document.getElementById('cetak').style.display = 'block';
														document.getElementById('ld').style.display = 'none';
																									
														$.ajax({
															 
															type: "POST",
															dataType: "html",
															url: "cetakhasil.php",										
															data: "lead="+"1",
															success: function(data){
															   $("#cetak").html(data);
															}
														});
													});

													</script>	
													