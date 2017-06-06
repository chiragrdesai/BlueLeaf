	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/validate.js'></script>  
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12 center login-header">
		<h2>Welcome to <?php if(isset($showsitename[0]->variable_value)) { echo $showsitename[0]->variable_value; } else { echo "Your"; } ?> admin panel</h2>
	</div>        
</div>
<div class="row">
	<div class="well col-md-5 center login-box">
		<?php //echo validation_errors(); ?>
		
			<?php
			
				if($this->session->userdata('invalid_login'))
				{
					echo '<div class="alert alert-danger">'.$this->session->userdata('invalid_login').'</div>';
					$this->session->unset_userdata('invalid_login');
				}
			?> 
			
	<div class="alert alert-info">
		Please login with  Username and Password.
	</div>
		
	<form role="form" method="post" name="login" id="login" onSubmit="return loginForm();" action="<?php echo base_url(); ?>admin/c_verifylogin" >

		<fieldset>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
				<input type="text" name='username' class="form-control" placeholder="Username">
			</div>
			<div class="clearfix"></div><br>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
				<input type="password" name='password' class="form-control" placeholder="Password">
			</div>
			<div class="clearfix"></div>

			<!--<div class="input-prepend">
				<label class="remember"  name="remember" for="remember"><input type="checkbox" name='remember_me' id="remember"> Remember me</label>
			</div>-->
			<div class="clearfix"></div>
			
			<p class="center col-md-5">
				<input type="submit" name='submit' value='Login' class="btn btn-primary">
			</p>
		</fieldset>
		</form>              
	</div>
</div>
</div>
