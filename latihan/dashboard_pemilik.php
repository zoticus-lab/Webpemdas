<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rental Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <div class="menu-item" onclick="showContent('dataMobil')">Data Mobil</div>
        <div class="menu-item" onclick="showContent('dataPenyewaan')">Data Penyewaan</div>
        <div class="menu-item" onclick="showContent('laporan')">Laporan</div>
        <div class="menu-item" onclick="showContent('dataPengembalian')">Data Pengembalian</div>
    </div>

    <div class="dashboard">
        <div class="header">
            <h1>Dashboard Pemilik Rental Mobil</h1>
            <button class="logout-btn" onclick="window.location.href='formlogin.php'">Logout</button>
        </div>

        <div id="dataMobil" class="content active">
            <h2>Data Mobil</h2>
            <button class="add-btn" onclick="openModal('add', null)">Tambah Kendaraan</button>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>No Plat</th>
                        <th>Tipe Kendaraan</th>
                        <th>Status</th>
                        <th>Harga Sewa</th>
                        <th>Nama Cabang</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                        $conn = new mysqli('localhost', 'root', '', 'rental_mobil');
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT kendaraan.nama, kendaraan.no_plat, kendaraan.tipe_kendaraan, 
                                       kendaraan.status, kendaraan.harga_sewa, cabang.nama_cabang 
                                FROM kendaraan 
                                JOIN cabang ON kendaraan.id_cabang = cabang.id_cabang";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["no_plat"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["tipe_kendaraan"]) . "</td>";
                                echo "<td>" . ($row['status'] && $row['status'] == 'Tersedia' ? 'Tersedia' : 'Dibooking') . "</td>";
                                echo "<td>" . number_format($row["harga_sewa"], 0, ',', '.') . "</td>";
                                echo "<td>" . htmlspecialchars($row["nama_cabang"]) . "</td>";
                                echo "<td><button onclick=\"openModal('edit', '" . $row['no_plat'] . "')\">Edit</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Data tidak tersedia</td></tr>";
                        }

                        $conn->close();
                    ?>
                </table>
            </div>
        </div>

        <!-- Modal untuk Tambah dan Edit Data Mobil -->
        <div id="modal" class="modal">
            <div class="modalContent">
                <h2 id="modalTitle">Tambah Data Kendaraan</h2>
                <form id="modalForm">
                    <input type="hidden" id="modalNoPlat" name="no_plat">
                    
                    <label>No Plat:</label>
                    <input type="text" id="modalNoPlatInput" name="no_plat"><br>
                    
                    <label>Nama Kendaraan:</label>
                    <input type="text" id="modalNama" name="nama"><br>
                    
                    <label>Tipe Kendaraan:</label>
                    <input type="text" id="modalTipeKendaraan" name="tipe_kendaraan"><br>
                    
                    <label>Status:</label>
                    <select id="modalStatus" name="status">
                        <option value="1">Tersedia</option>
                        <option value="0">Tidak Tersedia</option>
                    </select><br>
                    
                    <label>Harga Sewa:</label>
                    <input type="text" id="modalHargaSewa" name="harga_sewa"><br>
                    
                    <label>Cabang:</label>
                    <select id="modalCabang" name="id_cabang">
                        <?php
                            $conn = new mysqli('localhost', 'root', '', 'rental_mobil');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT id_cabang, nama_cabang FROM cabang";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id_cabang'] . "'>" . htmlspecialchars($row['nama_cabang']) . "</option>";
                                }
                            }
                            $conn->close();
                        ?>
                    </select><br>
                    
                    <button type="submit">Simpan</button>
                    <button type="button" onclick="closeModal()">Batal</button>
                </form>
            </div>
        </div>

        <!-- Konten untuk menu lainnya (Data Penyewaan, Data Pelanggan, Laporan) -->
        <div id="dataPenyewaan" class="content">
            <h2>Data Penyewaan</h2>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Nama Customer</th>
                        <th>Nama Kendaraan</th>
                        <th>Nama Cabang</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                        $conn = new mysqli('localhost', 'root', '', 'rental_mobil');
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT p.id_sewa, k.id_kendaraan, u.nama AS nama_customer, k.nama AS nama_kendaraan, 
                                       c.nama_cabang, p.tgl_pinjam, p.tgl_kembali 
                                FROM penyewaan AS p
                                JOIN user AS u ON p.id_user = u.id_user
                                JOIN kendaraan AS k ON p.id_kendaraan = k.id_kendaraan
                                JOIN cabang AS c ON p.id_cabang = c.id_cabang";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["nama_customer"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["nama_kendaraan"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["nama_cabang"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["tgl_pinjam"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["tgl_kembali"]) . "</td>";
                                echo "<td><button onclick=\"openValidationModal('" . $row['id_sewa'] . "', '" . $row['id_kendaraan'] . "')\">Validasi Pengembalian</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Data tidak tersedia</td></tr>";
                        }

                        $conn->close();
                    ?>
                </table>
            </div>
        </div>
        <div id="validationModal" class="modal">
        <div class="modalContent">
            <h2>Validasi Pengembalian</h2>
            <form id="validationForm">
                <input type="hidden" id="validationIdSewa" name="id_sewa">
                <input type="hidden" id="validationIdKendaraan" name="id_kendaraan">
                
                <label>Tanggal Kembali:</label>
                <input type="date" id="validationTglKembali" name="tgl_kembali" required><br>

                <label>Denda:</label>
                <input type="number" id="validationDenda" name="denda" placeholder="Isi jika ada denda"><br>

                <label>Kondisi:</label>
                <textarea id="validationKondisi" name="kondisi" placeholder="Masukkan kondisi kendaraan"></textarea><br>

                <button type="submit">Simpan</button>
                <button type="button" onclick="closeValidationModal()">Batal</button>
            </form>
        </div>
    </div>

        <div id="dataPengembalian" class="content">
            <h2>Data Pengembalian Kendaraan</h2>
            <div class="table-container">
                <table>
                    <tr>
                        <th>ID Pengembalian</th>
                        <th>ID Sewa</th>
                        <th>Nama Kendaraan</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Kondisi</th>
                        <th>Denda</th>
                    </tr>
                    <?php
                        $conn = new mysqli('localhost', 'root', '', 'rental_mobil');
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT pengembalian.id_pengembalian, pengembalian.id_sewa, kendaraan.nama AS nama_kendaraan, 
                                       pengembalian.tgl_kembali, pengembalian.kondisi, pengembalian.denda 
                                FROM pengembalian 
                                JOIN kendaraan ON pengembalian.id_kendaraan = kendaraan.id_kendaraan";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["id_pengembalian"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["id_sewa"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["nama_kendaraan"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["tgl_kembali"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["kondisi"]) . "</td>";
                                echo "<td>" . number_format($row["denda"], 0, ',', '.') . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Data tidak tersedia</td></tr>";
                        }

                        $conn->close();
                    ?>
                </table>
            </div>
        </div>
    
    <div id="laporan" class="content">
    <h2>Laporan Rental Mobil</h2>
    <h3>Laporan Penyewaan Bulanan</h3>
    <div class="table-container">
        <table>
            <tr>
                <th>Bulan</th>
                <th>Jumlah Penyewaan</th>
            </tr>
            <?php
                $conn = new mysqli('localhost', 'root', '', 'rental_mobil');
                $sql = "SELECT YEAR(tgl_pinjam) AS tahun, MONTH(tgl_pinjam) AS bulan, COUNT(*) AS jumlah_penyewaan
                        FROM penyewaan 
                        GROUP BY tahun, bulan";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . date("F Y", mktime(0, 0, 0, $row['bulan'], 10, $row['tahun'])) . "</td>";
                        echo "<td>" . $row['jumlah_penyewaan'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Tidak ada data</td></tr>";
                }
            ?>
        </table>
        <h3>Laporan Kendaraan Populer</h3>
        <div class="table-container">
        <table>
            <tr>
                <th>Nama Kendaraan</th>
                <th>Jumlah Penyewaan</th>
            </tr>
            <?php
                $sql = "SELECT kendaraan.nama, COUNT(penyewaan.id_kendaraan) AS jumlah_penyewaan 
                        FROM penyewaan 
                        JOIN kendaraan ON penyewaan.id_kendaraan = kendaraan.id_kendaraan 
                        GROUP BY kendaraan.nama 
                        ORDER BY jumlah_penyewaan DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . $row['jumlah_penyewaan'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Tidak ada data</td></tr>";
                }
            ?>
        </table>
        <h3>Laporan Pendapatan Bulanan</h3>
        <div class="table-container">
        <table>
            <tr>
                <th>Bulan</th>
                <th>Total Pendapatan</th>
            </tr>
            <?php
                $sql = "SELECT MONTH(p.tgl_pinjam) AS bulan, SUM(k.harga_sewa) AS total_pendapatan 
                        FROM penyewaan p 
                        JOIN kendaraan k ON p.id_kendaraan = k.id_kendaraan 
                        GROUP BY bulan";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . date("F", mktime(0, 0, 0, $row['bulan'], 10)) . "</td>";
                        echo "<td>Rp " . number_format($row['total_pendapatan'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Tidak ada data</td></tr>";
                }
            ?>
        </table>
        <h3>Laporan Kendaraan Rusak</h3>
    <div class="table-container">
        <table>
            <tr>
                <th>Nama Kendaraan</th>
                <th>Tanggal Pengembalian</th>
                <th>Kondisi</th>
                <th>Denda</th>
            </tr>
            <?php
                $sql = "SELECT k.nama, p.tgl_kembali, p.kondisi, p.denda 
                        FROM pengembalian p 
                        JOIN kendaraan k ON p.id_kendaraan = k.id_kendaraan 
                        WHERE p.kondisi = 'rusak'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama_kendaraan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal_kembali']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kondisi']) . "</td>";
                        echo "<td>Rp " . number_format($row['denda'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }
            ?>
        </table>
    </div>
    </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
