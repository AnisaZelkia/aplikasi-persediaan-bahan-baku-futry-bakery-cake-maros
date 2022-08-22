
<section class="main-content">
				<div class="row">
				
					<div class="span7">
						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
						<?php
						//jika login gagal
						if(isset($_GET['status'])){
							if($_GET['status']==0){
								echo "<h5 class='text-success'>Proses Registrasi berhasil, Silahkan login!</h5>";
							}else {
							echo "<h5 class='text-error'>Proses Registrasi  gagal!</h5>";
							}						}	?>
						<form action="user/register_action.php"  id='form2' method="post" class="form-horizontal">
							<fieldset>
									<div class="control-group">
		<label class="control-label" for="nama">Nama pelanggan</label>
		<div class="controls">
			<input type="text" name='nama' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Jenis kelamin</label>
		<div class="controls">
			<select name='kelamin' >
				<option value='L'>Laki laki</option>
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
		<label class="control-label" >telp</label>
		<div class="controls">
			<input type="text" name='telp' id='telp' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Kota</label>
		<div class="controls">
			<input type="text" name='kota' id='kota' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Kode Post</label>
		<div class="controls">
			<input type="text" name='kodepos' id='kodepos' class='required'
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
		<div class="controls">
			<button type="submit" class="btn btn-success" name='aksi'value='register'>
				Register
			</button>
		</div>
	</div>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
