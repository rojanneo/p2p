<p>Menu</p>
<?php $role = $this->session->userdata('role');
$rating = getRoleRating($role);
?>
<?php if($rating >= 1):?>
<a href="<?php echo config_item('base_url').'admin/api/'?>">API Keys</a>
<?php endif;?>
<a href="<?php echo config_item('base_url').'admin/interests/'?>">Interests</a>
<?php if($rating >= 1):?>
<a href="<?php echo config_item('base_url').'admin/incentive/'?>">Incentive Methods</a>
<?php endif;?>
<a href="#">Ad Banners</a>
<a href="#">Brands</a>
<a href="#">Users</a>