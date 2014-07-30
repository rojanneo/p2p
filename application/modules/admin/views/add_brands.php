<h1>Add New Brand</h1>
<?php if(!isset($brand)):?>
<?php echo form_open('admin/brands/addpost/'); ?>
<?php else:?>
<?php echo form_open('admin/brands/addpost/1'); ?>
<input type = "hidden" name="brand_id" value="<?php echo (isset($brand))?$brand['id']:null?>"/>
<?php endif;?>
<label for = "brand_name">Brand Name: </label>
<input type = "text" name="brand_name" value="<?php echo (isset($brand))?$brand['brandName']:null?>"/>
<label for = "brand_des">Brand Description: </label>
<input type = "text" name="brand_des" value="<?php echo (isset($brand))?$brand['brandDes']:null?>"/>
<label for = "brand_category">Brand Categories: </label>
<input type = "text" name="brand_category" value="<?php echo (isset($brand))?$brand['brandCategories']:null?>"/>
<label for = "brand_status">Brand Status: </label>
<select name="brand_status">
	<option <?php echo (isset($brand) and ($brand['status'] == 0))?'"selected"':null?> value="0">Disabled</option>
	<option <?php echo (isset($brand) and ($brand['status'] == 1))?'"selected"':null?> value="1">Enabled</option>
</select>


<input type = "submit" value="Save"/>
<?php echo form_close()?>