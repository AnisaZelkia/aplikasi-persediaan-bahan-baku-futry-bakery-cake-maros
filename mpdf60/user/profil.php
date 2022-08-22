<?php
$ip=getip();
$sql="select * from id where ip='$ip'";
$x=mysqli_query($konek,$sql);
$dt=mysqli_fetch_array($x);
$idpelanggan=$dt['idpelanggan'];

cek_status_login($idpelanggan);
?>
<section class="main-content">

	<div class="row">
		<div class="span12">
	<h2 id="headings"> Profile</h2>
	<!--<a href='index.php?mod=pelanggan&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		
		<tbody>
<?php
$id=$idpelanggan;
$query="select pelanggan.*
 from pelanggan
 where idpelanggan='$id'";
$result=mysqli_query($konek,$query) or die(mysqli_error());
$no=1;
//proses menampilkan data
while($rows=mysqli_fetch_object($result)){

			?>
		
			
				<tr><td>Nama </td><td><?php echo $rows->nama; ?></td></td></tr>
			
			<tr><td>Email </td><td><?php echo $rows->email; ?></td></td></tr>
				<tr><td>Telepon </td><td><?php echo $rows->telp; ?></td></td></tr>
					<tr><td>Alamat </td><td><?php echo $rows->alamat; ?></td></td></tr>
						<tr><td>Kota </td><td><?php echo $rows->kota; ?></td></td></tr>
							<tr><td>Kode Post </td><td><?php echo $rows->kodepos; ?></td></td></tr>
								<tr><td> Tanggal Daftar</td><td><?php echo tampil_tanggal($rows->tanggal_daftar); ?></td></td></tr>
			
			
			
			</tr>
			<?php	$no++;
				}
			?>

			
		</tbody>
	</table>

	
</div>
<?php
//include('inc/sidebar-front.php');
?>
	</div>
</section>	