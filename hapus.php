<?php
include 'koneksi.php';

// Keamanan: Memastikan ID adalah angka dan dibersihkan
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

if(isset($id)){
    $query = "DELETE FROM obat WHERE id='$id'";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
    }
}
?>