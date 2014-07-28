<br>
<a href="<?php echo config_item('base_url').'admin/incentive/add'?>">Add Incentives</a>
<?php if(isset($incentives)):?>
<table>
<thead>
<th>Incentive Name</th>
<th>Incentive Description</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach($incentives as $incentive):?>
<tr>
<td><?php echo $incentive['incentive_name']?></td>
<td><?php echo $incentive['incentive_des']?></td>
<td><a href="<?php echo config_item('base_url').'admin/incentive/edit/'.$incentive['id']?>">Edit</a><a href="<?php echo config_item('base_url').'admin/incentive/delete/'.$incentive['id']?>">Delete</a></td>
</tr>
<?php endforeach;?>
<tbody>
</table>
<?php endif;?>
