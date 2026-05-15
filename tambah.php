<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Obat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content" style="max-width: 500px; margin: auto; padding-top: 50px;">
        <div class="table-container">
            <h2>Input Stok Masuk</h2>
            <form method="POST">
                <input type="text" name="nama" placeholder="Nama Obat" required style="width:100%; padding:10px; margin:10px 0;">
                <select name="kat" style="width:100%; padding:10px; margin:10px 0;">
                    <option value="Sirup">Sirup</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Kapsul">Kapsul</option>
                </select>
                <input type="text" name="produsen" placeholder="Nama PT Pembuat (Produsen)" required style="width:100%; padding:10px; margin:10px 0;">
                <input type="number" name="stok" placeholder="Jumlah Stok" required style="width:100%; padding:10px; margin:10px 0;">
                <label>Tanggal Kadaluwarsa:</label>
                <input type="date" name="tgl" required style="width:100%; padding:10px; margin:10px 0;">
                
                <button type="submit" name="save" class="btn-add" style="width:100%;">Simpan Obat</button>
                <a href="index.php" style="display:block; text-align:center; margin-top:15px;">Kembali</a>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['save'])){
        $n = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $k = $_POST['kat'];
        $p = mysqli_real_escape_string($koneksi, $_POST['produsen']);
        $s = $_POST['stok'];
        $t = $_POST['tgl'];
        
        mysqli_query($koneksi, "INSERT INTO obat (nama_obat, kategori, produsen, stok, tgl_kadaluwarsa) VALUES ('$n', '$k', '$p', '$s', '$t')");
        header("location:index.php");
    }
    ?>
</body>
</html>