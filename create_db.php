<?php
$conn = mysqli_connect("localhost", "root", "");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE DATABASE IF NOT EXISTS mismath_bd";
if (mysqli_query($conn, $sql)) {
    echo "Success";
} else {
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
