<br>
<a href="<?php echo config_item('base_url').'admin/interests/add'?>">Add Interest</a>
<?php if(isset($interests)):?>
<table>
<thead>
<th>Interest Name</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach($interests as $interest):?>
<tr>
<td><?php echo $interest['interestName']?></td>
<td><a href="<?php echo config_item('base_url').'admin/interests/edit/'.$interest['id']?>">Edit</a><a href="<?php echo config_item('base_url').'admin/interests/delete/'.$interest['id']?>">Delete</a></td>
</tr>
<?php endforeach;?>
<tbody>
</table>
<?php endif;?>
