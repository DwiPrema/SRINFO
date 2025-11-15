<div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
    <div class="overlay">
        <h1>Data Pegawai</h1>
        <p>Akses data pegawai yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
    </div>
</div>

<?php
include "../koneksi.php";
// Cek apakah ada pencarian
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM pegawai 
                                      WHERE nama_pegawai LIKE '%$cari%' 
                                      ORDER BY id_pegawai DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY id_pegawai DESC");
}

if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {
    ob_clean();
    $no = 1; // bersihkan output buffer (biar tidak ada HTML lain)
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_pegawai']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tgl_lahir']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telp']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>
        <a href='index.php?page=pegawai&action=edit-pegawai&id=" . $row['id_pegawai'] . "' class='btn btn-warning' title='edit'><i class='bx bxs-edit'></i></a>
        <a href='pegawai_hapus.php?id=" . $row['id_pegawai'] . "'
           class='btn btn-danger'
           onclick=\"return confirm('Yakin ingin menghapus data pegawai ini?')\" title='hapus'><i class='bx bxs-trash'></i></a>
      </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>⚠️ Data tidak ditemukan</td></tr>";
    }
    exit;
}
?>

<div class="container">

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="popup">
            <?php
            if ($_GET['pesan'] == 'tambah') echo "✅ Data pegawai berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data pegawai berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data pegawai berhasil dihapus!";
            ?>
            <button type="button" title="close" class="close-popup"><i class='bx bx-x'></i></button>
        </div>
    <?php endif; ?>

    <?php
    if (isset($_GET['page']) && $_GET['page'] == 'pegawai') {
        if (isset($_GET['action']) && $_GET['action'] == 'tambah-pegawai') {
            include "pegawai_tambah.php";
        } else if (isset($_GET['action']) && $_GET['action'] == 'edit-pegawai') {
            include "pegawai_edit.php";
        } else {

    ?>

            <!-- Pencarian + Tombol Tambah -->
            <div class="top-bar">

                <form id="searchForm">
                    <input type="hidden" name="page" value="pegawai">
                    <input type="search" id="searchInput" name="cari" placeholder="Cari pegawai..." value="<?= htmlspecialchars($cari) ?>">
                </form>

                <a href="index.php?page=pegawai&action=tambah-pegawai">+ Tambah Data Pegawai</a>
            </div>

            <!-- Tabel Data -->
            <div class="table-container">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No.Telp</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_pegawai'] ?></td>
                                    <td><?= $row['tgl_lahir'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td>
                                        <a href="index.php?page=pegawai&action=edit-pegawai&id=<?= $row['id_pegawai'] ?>" class="btn btn-warning" title="edit"><i class='bx bxs-edit'></i></a>
                                        <a href="pegawai_hapus.php?id=<?= $row['id_pegawai'] ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data pegawai ini?')" title="hapus"><i class='bx bxs-trash' ></i></a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-center">⚠️ Data tidak ditemukan</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    <?php

        }
    }
    ?>
</div>