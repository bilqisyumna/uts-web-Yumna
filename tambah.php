<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content" style="max-width: 500px; margin: auto; padding: 50px;">
        <h2>Tambah Stok Baru</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Obat" required class="input-form">
            <select name="kat" class="input-form">
                <option value="Sirup">Sirup</option>
                <option value="Tablet">Tablet</option>
                <option value="Kapsul">Kapsul</option>
                <option value="Salep">Salep</option>
            </select>
            <input type="text" name="produsen" placeholder="Nama PT Pembuat" required class="input-form">
            <input type="number" name="stok" placeholder="Jumlah" required class="input-form">
            <input type="date" name="tgl" required class="input-form">
            <button type="submit" name="simpan" class="btn-add" style="width:100%">Simpan</button>
            <a href="index.php" style="display:block; text-align:center; margin-top:10px;">Batal</a>
        </form>
    </div>
    
    <?php
    if(isset($_POST['simpan'])){
        $n = $_POST['nama']; $k = $_POST['kat']; $p = $_POST['produsen']; $s = $_POST['stok']; $t = $_POST['tgl'];
        mysqli_query($koneksi, "INSERT INTO obat (nama_obat, kategori, produsen, stok, tgl_kadaluwarsa) VALUES ('$n', '$k', '$p', '$s', '$t')");
        echo "<script>window.location='index.php';</script>";
    }
    ?>
</body>
</html>