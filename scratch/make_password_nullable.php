<?php
require 'app/Config/Constants.php';
require 'system/bootstrap.php';

$db = \Config\Database::connect();
$db->query("ALTER TABLE utilisateurs MODIFY password VARCHAR(255) NULL");
echo "Password column is now nullable.\n";
