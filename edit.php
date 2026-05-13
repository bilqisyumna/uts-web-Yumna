<?php 
include 'koneksi.php';
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE id='$id'");
$d = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content" style="max-width: 500px; margin: auto;">
        <h2>Obat Terjual: <?php echo $d['nama_obat']; ?></h2>
        <p>Stok saat ini: <?php echo $d['stok']; ?></p>
        <form method="POST">
            <input type="number" name="jual" max="<?php echo $d['stok']; ?>" placeholder="Jumlah Terjual" required><br><br>
            <button type="submit" name="upd" class="btn-add">Update Stok</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
    <?php
    if(isset($_POST['upd'])){
        $baru = $d['stok'] - $_POST['jual'];
        mysqli_query($koneksi, "UPDATE obat SET stok='$baru' WHERE id='$id'");
        header("location:index.php");
    }
    ?>
</body>
</html>