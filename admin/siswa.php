<?php
session_start();
include "../koneksi.php";

if (isset($_GET['nama_kelas'])) {
    $_SESSION['nama_kelas'] = $_GET['nama_kelas'];
}

$namaKelas = $_SESSION['nama_kelas'] ?? "";

// Ambil daftar kelas
$kelasQuery = mysqli_query($koneksi, "SELECT * FROM kelas, jurusan WHERE kelas.id_jurusan = jurusan.id_jurusan ORDER BY nama_kelas ASC");


$cari = isset($_GET['cari']) ? trim($_GET['cari']) : "";
$pageCek = isset($_GET['action']) ? $_GET['action'] : "";
$cekResult = null;

if ($pageCek == "") {
    unset($_SESSION['nama_kelas']);
}
// Query dasar action
if (isset($_GET['page']) && $_GET['page'] == 'siswa' && $pageCek != "") {

    $baseQuery = "SELECT * FROM siswa 
              JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
              WHERE 1=1";

    if (isset($_GET['kelas']) && $_GET['kelas'] != "") {
        $kelas = mysqli_real_escape_string($koneksi, $_GET['kelas']);
        $baseQuery .= " AND kelas.nama_kelas = '$kelas'";
        $namaKelas = $kelas;
        $_SESSION['nama_kelas'] = $kelas;
    }

    if ($cari != "") {
        $baseQuery .= " AND siswa.nama_siswa LIKE '%$cari%'";
    }

    $baseQuery .= " ORDER BY siswa.no_absen DESC";
    $cekResult = mysqli_query($koneksi, $baseQuery);
}


// Jika request AJAX -> hanya tampilkan baris tabel (tbody isi)
if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {
    ob_clean();
    if ($cekResult && mysqli_num_rows($cekResult) > 0) {
        while ($row = mysqli_fetch_assoc($cekResult)) {
            echo "<tr>
                    <td>{$row['no_absen']}</td>
                    <td>{$row['nama_siswa']}</td>
                    <td>{$row['nama_kelas']}</td>
                    <td>
                        <a href='index.php?page=siswa&action=edit-siswa&id={$row['id_siswa']}' class='btn btn-warning' title='edit'><i class='bx bxs-edit'></i></a>
                        <a href='siswa_hapus.php?id={$row['id_siswa']}' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus data siswa ini?')\" title='hapus'><i class='bx bxs-trash'></i></a>
                        <a href='index.php?page=siswa&action=detail-siswa&id={$row['id_siswa']}' class='btn btn-detail' title='detail'><i class='bx bxs-detail'></i></a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>⚠️ Data tidak ditemukan</td></tr>";
    }
    exit;
}

?>

<div class="container">
    <?php if ($pageCek == ""): ?>
        <!-- Jika belum pilih kelas -->
        <div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
            <div class="overlay">
                <h1>Data Siswa</h1>
                <p>Akses data kelas yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
            </div>
        </div>

        <div class="card-container">
            <?php if (mysqli_num_rows($kelasQuery) > 0): ?>
                <?php while ($k = mysqli_fetch_assoc($kelasQuery)): ?>
                    <div class="card data-siswa">
                        <h1><?= htmlspecialchars($k['nama_kelas']) ?></h1>
                        <p><?= htmlspecialchars($k['nama_jurusan']) ?></p>
                        <a href="index.php?page=siswa&action=filter&kelas=<?= urlencode($k['nama_kelas']) ?>">
                            Cek Data Siswa
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada data kelas.</p>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <!-- Jika sudah pilih kelas -->
        <div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
            <div class="overlay">
                <h1>Data Siswa <?= $namaKelas ?></h1>
                <p>Akses data siswa yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
            </div>
        </div>

        <?php if (isset($_GET['pesan'])): ?>
            <div class="popup">
                <?php
                if ($_GET['pesan'] == 'tambah') echo "✅ Data siswa berhasil ditambahkan!";
                if ($_GET['pesan'] == 'edit') echo "✅ Data siswa berhasil diperbaharui!";
                if ($_GET['pesan'] == 'hapus') echo "✅ Data siswa berhasil dihapus!";
                ?>
                <button type="button" title="close" class="close-popup"><i class='bx bx-x'></i></button>
            </div>
        <?php endif; ?>

        <?php
        if (isset($_GET['page']) && $_GET['page'] == 'siswa') {
            if (isset($_GET['action']) && $_GET['action'] == 'tambah-siswa') {
                include "siswa_tambah.php";
            } else if (isset($_GET['action']) && $_GET['action'] == 'edit-siswa') {
                include "siswa_edit.php";
            } else if (isset($_GET['action']) && $_GET['action'] == 'detail-siswa') {
                include "siswa_detail.php";
            } else {

        ?>

                <div class="top-bar">
                    <form id="searchForm">
                        <input type="hidden" name="page" value="siswa">
                        <input type="hidden" name="action" value="<?= htmlspecialchars($pageCek) ?>">
                        <input type="hidden" name="kelas" value="<?= htmlspecialchars($namaKelas) ?>">
                        <input type="search" id="searchInput" name="cari" placeholder="Cari siswa.." value="<?= htmlspecialchars($cari) ?>">
                    </form>
                    <a href="index.php?page=siswa&action=tambah-siswa">+ Tambah Data Siswa</a>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>No. Absen</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            if ($cekResult && mysqli_num_rows($cekResult) > 0) {
                                while ($row = mysqli_fetch_assoc($cekResult)) { ?>
                                    <tr>
                                        <td><?= $row['no_absen'] ?></td>
                                        <td><?= $row['nama_siswa'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td>
                                            <a href="index.php?page=siswa&action=edit-siswa&id=<?= $row['id_siswa'] ?>&nama_kelas=<?= urlencode($row['nama_kelas']) ?>" class="btn btn-warning" title="edit"><i class='bx bxs-edit'></i></a>
                                            <a href="siswa_hapus.php?id=<?= $row['id_siswa'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data siswa ini?')" title="hapus"><i class='bx bxs-trash'></i></a>
                                            <a href="index.php?page=siswa&action=detail-siswa&id=<?= $row['id_siswa'] ?>" class="btn btn-detail" title="detail"><i class='bx bxs-detail'></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">⚠️ Data tidak ditemukan</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        <?php

            }
        }
        ?>
    <?php endif; ?>

</div>