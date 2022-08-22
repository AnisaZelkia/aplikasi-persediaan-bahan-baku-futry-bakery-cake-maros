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
                                                <th>Max Inventori </th>                                              
                                                <th>Beli </th>                                              
											</tr>
                                        </thead>
                                        <tbody>
										<?php
											include 'koneksi.php';
											$lead=$_POST['lead'];
											$exe=mysqli_query($konek, "select * from bahan order by bahan");
											$no=1;
											while($rec=mysqli_fetch_array($exe))
											{  $idbahan=$rec['id'];
											   $row=mysqli_fetch_array(mysqli_query($konek,"select * from maks where idbahan='$idbahan'"));	
											   $maks=$row['maks'];
											   $rata=$row['rata'];
											   $R=($maks-$rata)*$lead;
											   $min=$rata*$lead+$R;
											   $maks=2*($rata*$lead);
											   if($rec['akhir']<$min)
												   $beli=$maks-$rec['akhir'];
											   else
													$beli=$maks-$min;
											if($R>=$rec['akhir'])
												$beli=number_format($beli,2);
											else $beli='';	
												echo "<tr>
													 <td align='center' width='5%'>$no.</td>
													 <td width='25%' >$rec[bahan]</td>
													 <td width='10%' align='center'>$rec[satuan]</td>
													 <td width='10%' align='center'>$rec[akhir]</td>
													 <td width='10%' align='center'>".number_format($R,2)."</td>
													 <td width='10%' align='center'>".number_format($min,2)."</td>
													 <td width='10%' align='center'>".number_format($maks,2)."</td>
													 <td width='20%' align='center'>$beli";
															if($R>=$rec['akhir'])
														echo "&emsp;<a href='getminmax.php?idbahan=$rec[id]&lead=$lead' <button type='button' class='btn btn-success btn-xs'> <span class='fa fa-search'></span> Lihat Detail</button></a>";
													 	
												echo "</td></tr>";
													 $no++;
											}
											?>                                 
                                        </tbody> 
										
                                    </table>
														