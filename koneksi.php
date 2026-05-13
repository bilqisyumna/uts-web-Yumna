<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "apotek_mini";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>