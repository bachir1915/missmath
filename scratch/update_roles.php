<?php
require 'app/Config/Constants.php';
require 'system/bootstrap.php';

$db = \Config\Database::connect();
$db->table('admins')->where('username', 'admin')->update(['role' => 'admin']);
$db->table('admins')->where('username', 'staff1')->update(['role' => 'staff']);
$db->table('admins')->where('username', 'staff2')->update(['role' => 'staff']);
echo "Roles updated successfully.";
