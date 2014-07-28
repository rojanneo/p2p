<h1>Add New Api Key</h1>
<?php echo form_open('admin/api/addpost/'); ?>
<label for = "api_key">API Key: </label>
<input type = "text" name="api_key"/>
<label for = "api_pass">API Password: </label>
<input type = "password" name="api_pass"/>
<label for = "api_version">API Version: </label>
<input type = "text" name="api_version"/>
<input type = "submit" value="Save"/>
<?php echo form_close()?>