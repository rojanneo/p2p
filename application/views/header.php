<!doctype html>
<html>
<head>
<title>Ad Manager</title>
</head>
<body>
<?php if($this->session->userdata('logged_in')):?>
<p>Dashboard</p>
<p><?php echo $this->session->userdata('role')?></p>
<a href="<?php echo config_item("base_url")."admin/dashboard/logout"?>">Logout</a>

<?php endif;?>