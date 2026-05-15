<?php
$koneksi = mysqli_connect("localhost", "root", "", "apotek_mini");
if (!$koneksi) { die("Koneksi gagal: " . mysqli_connect_error()); }
?>