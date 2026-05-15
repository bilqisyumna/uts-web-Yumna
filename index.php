<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Apotek Mini</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-header"><h3>Apotek Mini</h3></div>
            <ul class="nav-links">
                <li class="active"><a href="index.php">Dashboard</a></li>
                <li><a href="tambah.php">Tambah Stok</a></li>
            </ul>
        </nav>

        <main class="content">
            <header>
                <h1>Katalog Obat</h1>
                <div class="user-profile">Admin Apotek</div>
            </header>

            <div class="table-container">
                <div class="table-header">
                    <form method="GET">
                        <select name="filter" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            <option value="Sirup" <?php if(@$_GET['filter']=='Sirup') echo 'selected'; ?>>Sirup</option>
                            <option value="Tablet" <?php if(@$_GET['filter']=='Tablet') echo 'selected'; ?>>Tablet</option>
                            <option value="Kapsul" <?php if(@$_GET['filter']=='Kapsul') echo 'selected'; ?>>Kapsul</option>
                            <option value="Salep" <?php if(@$_GET['filter']=='Salep') echo 'selected'; ?>>Salep</option>
                        </select>
                    </form>
                    <a href="tambah.php" class="btn-add">+ Input Stok Baru</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA OBAT</th>
                            <th>KATEGORI</th>
                            <th>PRODUSEN (PT)</th>
                            <th>STOK</th>
                            <th>TANGGAL KADALUWARSA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $f = isset($_GET['filter']) ? mysqli_real_escape_string($koneksi, $_GET['filter']) : '';
                        $q = "SELECT * FROM obat";
                        if($f) $q .= " WHERE kategori='$f'";
                        
                        $sql = mysqli_query($koneksi, $q);
                        $no = 1;
                        while($d = mysqli_fetch_array($sql)){
                            $tgl = $d['tgl_kadaluwarsa'];
                            $warna = (strtotime($tgl) <= time()) ? "style='color:red; font-weight:bold;'" : "";
                            echo "<tr>
                                <td>".$no++."</td>
                                <td><b>".$d['nama_obat']."</b></td>
                                <td><span class='badge'>".$d['kategori']."</span></td>
                                <td>".$d['produsen']."</td>
                                <td>".$d['stok']."</td>
                                <td $warna>".$tgl."</td>
                                <td>
                                    <a href='edit.php?id=".$d['id']."' class='btn-edit'>Jual</a>
                                    <a href='hapus.php?id=".$d['id']."' class='btn-delete' onclick='return confirm(\"Hapus?\")'>Hapus</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>