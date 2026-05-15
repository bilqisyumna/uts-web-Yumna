<?php include 'koneksi.php'; 
$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM obat WHERE id='$id'"));
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="content" style="max-width: 400px; margin: auto; padding: 50px;">
        <h3>Penjualan Obat</h3>
        <p>Nama: <?php echo $d['nama_obat']; ?> (<?php echo $d['produsen']; ?>)</p>
        <p>Stok: <?php echo $d['stok']; ?></p>
        <form method="POST">
            <input type="number" name="jual" max="<?php echo $d['stok']; ?>" required class="input-form" placeholder="Jumlah Terjual">
            <button type="submit" name="upd" class="btn-add">Update</button>
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