<script language='javascript'>
function validAngka(a)
{
    if(!/^[0-9.]+$/.test(a.value))
    {
    a.value = a.value.substring(0,a.value.length-1000);
    }
}
</script>

<section class="main-content">
				<div class="row">
				
					<div class="span7">
						<h4 class="title"><span class="text"><strong>Input Biodata</strong> Pelanggan</span></h4>
						<?php
						//jika login gagal
						if(isset($_GET['status'])){
							if($_GET['status']==0){
								//echo "<h5 class='text-success'>Proses Registrasi berhasil, Silahkan login!</h5>";
							}else {
							echo "<h5 class='text-error'>Proses Registrasi  gagal!</h5>";
							}						}	?>
						<form action="user/register_action.php"  id='form2' method="post" class="form-horizontal">
							<fieldset>
									<div class="control-group">
		<label class="control-label" for="nama">Nama Pelanggan</label>
		<div class="controls">
			<input type="text" name='nama' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Jenis Kelamin</label>
		<div class="controls">
			<select name='kelamin' >
				<option value='L'>Laki-laki</option>
				<option value='P'>Perempuan</option>
			</select>

		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Email</label>
		<div class="controls">
			<input type="text" name='email' id='email' class='required email'>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Password</label>
		<div class="controls">
			<input type="password" name='password' id='password' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Telp</label>
		<div class="controls">
			<input type="text" name='telp' id='telp' 
			class='required' onkeyup="validAngka(this)"
			>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="alamat">Alamat</label>
		<div class="controls">
			<textarea name='alamat' class="input-xlarge required"></textarea>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" >Kota</label>
		<div class="controls">
			<input type="text" name='kota' id='kota' class='required'
			value='Makassar' readonly
			>
		</div>
	</div>

		<div class="control-group">
		<label class="control-label" >Kelurahan</label>
		<div class="controls">
		    
			<?php  
                include 'koneksi.php';
                $sql="select * from kelurahan order by kelurahan asc";
   //             echo $sql;
                $result = mysqli_query($konek,$sql);  
                $jsArray = "var kel = new Array();\n";  
                echo '<select name="kelurahan" onchange="changeValue(this.value)">';  
                echo '<option>--Pilih Kelurahan--</option>';  
                while ($row = mysqli_fetch_array($result)) {  
                     echo '<option value="' . $row['idkelurahan'] . '">' . $row['kelurahan'] . '</option>';  
                    $jsArray .= "kel['" . $row['idkelurahan'] . "'] = {kelurahan:'" . addslashes($row['kelurahan']) . "',kodepos:'".addslashes($row['kodepos'])."'};\n";  
                    }  
                echo '</select>';  
            ?>  
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" >Kode Post</label>
		<div class="controls">
			<input type="text" name='kodepos' id='kodepos' class='required' readonly
			
			>
		</div>
	</div>

<script type="text/javascript">  
<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('kodepos').value = kel[id].kodepos;
};
</script>


	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-success" name='aksi'value='register'>
				Kirim Biodata
			</button>
		</div>
	</div>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
