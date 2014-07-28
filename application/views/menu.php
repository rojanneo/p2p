<p>Menu</p>
<?php $role = $this->session->userdata('role');?>
<?php if($role == 'admin' or $role == 'superadmin'):?>
<a href="<?php echo config_item('base_url').'admin/api/'?>">API Keys</a>
<?php endif;?>
<a href="#">Interests</a>
<?php if($role == 'admin' or $role == 'superadmin'):?>
<a href="#">Incentive Methods</a>
<?php endif;?>
<a href="#">Ad Banners</a>
<a href="#">Brands</a>
<a href="#">Users</a>