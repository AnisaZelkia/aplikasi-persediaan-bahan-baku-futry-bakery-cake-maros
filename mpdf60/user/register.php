
<section class="main-content">
				<div class="row">
					<div class="span6" >
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<?php
						//jika login gagal
						if($_GET['loginerror']){
							echo "<h5 class='text-error'>Kombinasi email dan password tidak sesuai</h5>";
													}	?>
						<form id='form1' action="user/login_action.php"  method="post" class=''>
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
										<input type="text" name='email' placeholder="Masukan email" id="email" class="input-xlarge required email">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" placeholder="masukan password" id="password" class="input-xlarge required" name='password' >
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-danger" type="submit" value="Sign into your account">
									<hr>
                                        
								</div>
							</fieldset>
						</form>
                        <!--div class="control-group">
                            <a href="index.php?mod=user&pg=daftar"><button class="btn btn-info" >Belum Punya Account</button></a>
                        </div-->    
					</div>
					
				</div>
			</section>
