<h1>Add New Intrerest</h1>
<?php if(!isset($interest)):?>
<?php echo form_open('admin/interests/addpost/'); ?>
<?php else:?>
<?php echo form_open('admin/interests/addpost/1'); ?>
<input type = "hidden" name="interest_id" value="<?php echo (isset($interest))?$interest['id']:null?>"/>
<?php endif;?>
<label for = "interest_name">Interest Name: </label>
<input type = "text" name="interest_name" value="<?php echo (isset($interest))?$interest['interestName']:null?>"/>
<input type = "submit" value="Save"/>
<?php echo form_close()?>