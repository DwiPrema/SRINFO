<div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
    <div class="overlay">
        <h1>Data Kelas</h1>
        <p>Akses data kelas yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
    </div>
</div>

<?php
include "../koneksi.php";
// Cek apakah ada pencarian
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM kelas
        JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
JOIN guru ON kelas.id_guru = guru.id_guru
WHERE (nama_kelas LIKE '%$cari%' 
    OR nama_jurusan LIKE '%$cari%')
ORDER BY id_kelas DESC
");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM kelas, jurusan, guru WHERE kelas.id_jurusan = jurusan.id_jurusan AND kelas.id_guru = guru.id_guru ORDER BY id_kelas DESC");
}

if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {
    ob_clean();
    $no = 1;
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
        <td>" . $no++ . "</td>
        <td>" . $row['nama_kelas'] . "</td>
        <td>" . $row['nama_jurusan'] . "</td>
        <td>" . $row['nama_guru'] . "</td>
        <td>
            <a href='index.php?page=kelas&action=edit-kelas&id=" . $row['id_kelas'] . "' class='btn btn-warning' title='edit'><i class='bx bxs-edit'></i></a>
            <a href='kelas_hapus.php?id=" . $row['id_kelas'] . "' 
               class='btn btn-danger' 
               onclick=\"return confirm('Yakin ingin menghapus kelas ini?')\" title='hapus'><i class='bx bxs-trash' ></i></a>
        </td>
      </tr>";
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
            if ($_GET['pesan'] == 'tambah') echo "✅ Data kelas berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data kelas berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data kelas berhasil dihapus!";
            ?>
            <button type="button" title="close" class="close-popup"><i class='bx bx-x'></i></button>
        </div>
    <?php endif; ?>

    <?php
    if (isset($_GET['page']) && $_GET['page'] == 'kelas') {
        if (isset($_GET['action']) && $_GET['action'] == 'tambah-kelas') {
            include "kelas_tambah.php";
        } else if (isset($_GET['action']) && $_GET['action'] == 'edit-kelas') {
            include "kelas_edit.php";
        } else {

    ?>

            <!-- Pencarian + Tombol Tambah -->
            <div class="top-bar">

                <form id="searchForm">
                    <input type="hidden" name="page" value="kelas">
                    <input type="search" id="searchInput" name="cari" placeholder="Cari kelas..." value="<?= htmlspecialchars($cari) ?>">
                </form>

                <a href="index.php?page=kelas&action=tambah-kelas">+ Tambah Kelas</a>
            </div>

            <!-- Tabel Data -->
            <div class="table-container">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Guru</th>
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
                                    <td><?= $row['nama_kelas'] ?></td>
                                    <td><?= $row['nama_jurusan'] ?></td>
                                    <td><?= $row['nama_guru'] ?></td>
                                    <td>
                                        <a href="index.php?page=kelas&action=edit-kelas&id=<?= $row['id_kelas'] ?>" class="btn btn-warning" title="edit"><i class='bx bxs-edit'></i></a>
                                        <a href="kelas_hapus.php?id=<?= $row['id_kelas'] ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus kelas ini?')" title="hapus"><i class='bx bxs-trash'></i></a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5" class="text-center">⚠️ Data tidak ditemukan</td>
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