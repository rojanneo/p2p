<h1>Add New Incentive</h1>
<?php if(!isset($incentive)):?>
<?php echo form_open('admin/incentive/addpost/'); ?>
<?php else:?>
<?php echo form_open('admin/incentive/addpost/1'); ?>
<input type = "hidden" name="incentive_id" value="<?php echo (isset($incentive))?$incentive['id']:null?>"/>
<?php endif;?>
<label for = "incentive_name">Incentive Name: </label>
<input type = "text" name="incentive_name" value="<?php echo (isset($incentive))?$incentive['incentive_name']:null?>"/>

<label for = "incentive_des">Incentive Description: </label>
<input type = "text" name="incentive_des" value="<?php echo (isset($incentive))?$incentive['incentive_des']:null?>"/>

<input type = "submit" value="Save"/>
<?php echo form_close()?>