<?php 
// Memanggil koneksi database
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Apotek Mini</title>
    <link rel="stylesheet" href="style.css">
    <!-- Menggunakan font Google agar tampilan lebih profesional -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- SIDEBAR NAVIGASI -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>Apotek Mini</h3>
            </div>
            <ul class="nav-links">
                <li class="active"><a href="index.php">Dashboard</a></li>
                <li><a href="tambah.php">Tambah Stok</a></li>
                <!-- Menu ini bisa dikembangkan nanti -->
                <li><a href="#" onclick="alert('Fitur Laporan segera hadir!')">Laporan Stok</a></li>
            </ul>
            <div class="sidebar-footer">
                <p>Informatika UM PKU Surakarta</p>
            </div>
        </nav>

        <!-- KONTEN UTAMA -->
        <main class="content">
            <header>
                <div class="header-title">
                    <h1>Katalog Obat</h1>
                    <p>Manajemen stok dan tanggal kedaluwarsa</p>
                </div>
                <div class="user-profile">
                    <span>Admin Apotek</span>
                </div>
            </header>

            <!-- STATISTIK RINGKAS -->
            <section class="stats-cards">
                <div class="card">
                    <h3>Total Produk</h3>
                    <?php 
                    $res = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM obat");
                    $data_total = mysqli_fetch_assoc($res);
                    echo "<p>".$data_total['total']."</p>";
                    ?>
                </div>
                <div class="card warning">
                    <h3>Kategori Terbanyak</h3>
                    <?php 
                    $res_kat = mysqli_query($koneksi, "SELECT kategori, COUNT(*) as jml FROM obat GROUP BY kategori ORDER BY jml DESC LIMIT 1");
                    $data_kat = mysqli_fetch_assoc($res_kat);
                    echo "<p>".($data_kat['kategori'] ?? '-')."</p>";
                    ?>
                </div>
            </section>

            <!-- TABEL DATA OBAT -->
            <div class="table-container">
                <div class="table-header">
                    <!-- Fitur Filter Kategori Sesuai Modifikasi Dosen -->
                    <form method="GET" action="" class="filter-form">
                        <select name="filter" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            <option value="Sirup" <?php if(isset($_GET['filter']) && $_GET['filter']=='Sirup') echo 'selected'; ?>>Sirup</option>
                            <option value="Tablet" <?php if(isset($_GET['filter']) && $_GET['filter']=='Tablet') echo 'selected'; ?>>Tablet</option>
                            <option value="Kapsul" <?php if(isset($_GET['filter']) && $_GET['filter']=='Kapsul') echo 'selected'; ?>>Kapsul</option>
                        </select>
                    </form>
                    <a href="tambah.php" class="btn-add">+ Input Stok Baru</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Tanggal Kadaluwarsa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Logika Filter
                        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
                        $query = "SELECT * FROM obat";
                        if($filter) {
                            $query .= " WHERE kategori='$filter'";
                        }
                        
                        $sql = mysqli_query($koneksi, $query);
                        $no = 1;
                        
                        if(mysqli_num_rows($sql) > 0) {
                            while($data = mysqli_fetch_array($sql)){
                                // Cek jika stok tipis untuk penanda visual
                                $stok_class = ($data['stok'] < 10) ? "text-danger" : "";
                                
                                echo "<tr>
                                    <td>".$no++."</td>
                                    <td><b>".$data['nama_obat']."</b></td>
                                    <td><span class='badge'>".$data['kategori']."</span></td>
                                    <td class='$stok_class'>".$data['stok']."</td>
                                    <td>".$data['tgl_kadaluwarsa']."</td>
                                    <td>
                                        <a href='edit.php?id=".$data['id']."' class='btn-edit'>Jual</a>
                                        <a href='hapus.php?id=".$data['id']."' class='btn-delete' onclick='return confirm(\"Hapus data obat ini?\")'>Hapus</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data obat.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>