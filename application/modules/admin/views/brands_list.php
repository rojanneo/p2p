<br>
<a href="<?php echo config_item('base_url').'admin/brands/add'?>">Add Brands</a>
<?php if(isset($brands)):?>
<table>
<thead>
<th>Brand Name</th>
<th>Brand Descrption</th>
<th>Brand Categories</th>
<th>Brand Status</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach($brands as $brand):?>
<tr>
<td><?php echo $brand['brandName']?></td>
<td><?php echo $brand['brandDes']?></td>
<td><?php echo $brand['brandCategories']?></td>
<td><?php echo ($brand['status'] == 0)?'Disabled':'Enabled'?></td>
<td><a href="<?php echo config_item('base_url').'admin/brands/edit/'.$brand['id']?>">Edit</a><a href="<?php echo config_item('base_url').'admin/brands/delete/'.$brand['id']?>">Delete</a></td>
</tr>
<?php endforeach;?>
<tbody>
</table>
<?php endif;?>
