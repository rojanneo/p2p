<div class="page-title">
<h2>Login</h2>
</div>
<div class="error-login">
<?php if(isset($login_failed)):?>
<p>Login Failed. Try Again</p>
<?php endif;?>
</div>
<div class="login_form-parent">
	<form action = "<?php echo config_item('base_url').'admin/login/loginpost'?>" method = "post">
		<label for="username">Username:</label>
		<input type="text" name="username"/>
		<label for ="password">Password:</label>
		<input type="password" name="password"/>
		<input type="submit" value="Login"/>
	</form>
</div>