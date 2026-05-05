<?php
$conn = mysqli_connect("localhost", "root", "", "mismath_bd");
if (!$conn) die("Failed");
mysqli_query($conn, "DROP TABLE IF EXISTS migrations");
mysqli_query($conn, "DROP TABLE IF EXISTS admins");
mysqli_query($conn, "DROP TABLE IF EXISTS invites");
mysqli_query($conn, "DROP TABLE IF EXISTS logs");
echo "Tables dropped";
mysqli_close($conn);
