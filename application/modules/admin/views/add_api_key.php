<h1>Add New Api Key</h1>
<?php if(!isset($api)):?>
<?php echo form_open('admin/api/addpost/'); ?>
<?php else:?>
<?php echo form_open('admin/api/editpost/'); ?>
<input type = "hidden" name="api_id" value="<?php echo (isset($api))?$api['id']:null?>"/>
<?php endif;?>
<label for = "api_key">API Key: </label>
<input type = "text" name="api_key" value="<?php echo (isset($api))?$api['api_key']:null?>"/>
<label for = "api_pass">API Password: </label>
<input type = "password" name="api_pass" />
<label for = "api_version">API Version: </label>
<input type = "text" name="api_version" value="<?php echo (isset($api))?$api['versionName']:null?>"/>
<input type = "submit" value="Save"/>
<?php echo form_close()?>