<?php 
include 'koneksi.php';

// Pastikan ID aman dari SQL Injection
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE id='$id'");
$d = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Penjualan - Apotek Mini</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content" style="max-width: 500px; margin: auto; padding-top: 50px;">
        <h2>Update Stok (Penjualan)</h2>
        
        <form method="POST" class="card" style="padding: 20px;">
            <!-- BAGIAN YANG DITAMBAHKAN DARI image_e728a6.png -->
            <p>Nama Obat: <b><?php echo $d['nama_obat']; ?></b></p>
            <p>Produsen: <i><?php echo $d['produsen']; ?></i></p> 
            <p>Stok saat ini: <?php echo $d['stok']; ?></p>
            <hr>
            <!-- END BAGIAN TAMBAHAN -->

            <label>Jumlah Terjual:</label><br>
            <input type="number" name="jual" max="<?php echo $d['stok']; ?>" min="1" placeholder="Masukkan angka..." required style="width: 100%; padding: 10px; margin: 10px 0;">
            
            <button type="submit" name="upd" class="btn-add">Update Stok</button>
            <a href="index.php" style="display: block; text-align: center; margin-top: 10px;">Batal</a>
        </form>
    </div>

    <?php
    if(isset($_POST['upd'])){
        $terjual = $_POST['jual'];
        $stok_baru = $d['stok'] - $terjual;
        
        $update = mysqli_query($koneksi, "UPDATE obat SET stok='$stok_baru' WHERE id='$id'");
        
        if($update){
            echo "<script>alert('Stok berhasil diperbarui!'); window.location='index.php';</script>";
        }
    }
    ?>
</body>
</html>