<br>
<a href="<?php echo config_item('base_url').'admin/api/add'?>">Add New Api</a>
<?php if(isset($apis)):?>
<table>
<thead>
<th>API Key</th>
<th>API Password</th>
<th>API Version</th>
<th>Actions</th>
</thead>
<tbody>
<?php foreach($apis as $api):?>
<tr>
<td><?php echo $api['api_key']?></td>
<td><?php echo $api['api_password']?></td>
<td><?php echo $api['versionName']?></td>
<td><a href="<?php echo config_item('base_url').'admin/api/edit/'.$api['id']?>">Edit</a><a href="<?php echo config_item('base_url').'admin/api/delete/'.$api['id']?>">Delete</a></td>
</tr>
<?php endforeach;?>
<tbody>
</table>
<?php endif;?>
