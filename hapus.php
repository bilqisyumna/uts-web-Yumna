<?php
include 'koneksi.php';
mysqli_query($koneksi, "DELETE FROM obat WHERE id='".$_GET['id']."'");
header("location:index.php");
?>