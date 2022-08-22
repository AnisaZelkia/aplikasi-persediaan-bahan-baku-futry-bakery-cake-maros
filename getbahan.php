<?php
include 'koneksi.php';
	$idbahan=$_POST['idbahan'];
	$dt=mysqli_fetch_array(mysqli_query($konek,"select * from bahan where id='$idbahan'"));
	$satuan=$dt['satuan'];
?>
<div class="col-sm-4">
<label for="inputText3" class="col-form-label">Satuan</label>												
<input name="satuan" type="text" class="form-control"  value='<?=$satuan;?>' readonly>
</div>	