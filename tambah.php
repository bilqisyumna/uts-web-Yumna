<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Obat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content" style="max-width: 500px; margin: auto;">
        <h2>Tambah Stok Masuk</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Obat" required><br><br>
            <select name="kat">
                <option value="Sirup">Sirup</option>
                <option value="Tablet">Tablet</option>
            </select><br><br>
            <input type="number" name="stok" placeholder="Jumlah" required><br><br>
            <input type="date" name="tgl" required><br><br>
            <button type="submit" name="save" class="btn-add">Simpan</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
    <?php
    if(isset($_POST['save'])){
        $n = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $k = $_POST['kat'];
        $s = $_POST['stok'];
        $t = $_POST['tgl'];
        mysqli_query($koneksi, "INSERT INTO obat (nama_obat, kategori, stok, tgl_kadaluwarsa) VALUES ('$n', '$k', '$s', '$t')");
        header("location:index.php");
    }
    ?>
</body>
</html>