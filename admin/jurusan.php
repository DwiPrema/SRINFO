<div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
    <div class="overlay">
        <h1>Data Jurusan</h1>
        <p>Akses data jurusan yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
    </div>
</div>

<?php
include "../koneksi.php";
// Cek apakah ada pencarian
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM jurusan 
                                      WHERE nama_jurusan LIKE '%$cari%' 
                                         OR singkatan LIKE '%$cari%' 
                                      ORDER BY id_jurusan DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY id_jurusan DESC");
}

if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {
    ob_clean();
    $no = 1;
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
        <td>" . $no++ . "</td>
        <td>" . $row['nama_jurusan'] . "</td>
        <td>" . $row['singkatan'] . "</td>
        <td>
            <a href='index.php?page=jurusan&action=edit-jurusan&id=" . $row['id_jurusan'] . "' class='btn btn-warning' title='edit'><i class='bx bxs-edit'></i></a>
            <a href='jurusan_hapus.php?id=" . $row['id_jurusan'] . "' 
               class='btn btn-danger'  title='hapus'
               onclick=\"return confirm('Yakin ingin menghapus jurusan ini?')\"><i class='bx bxs-trash'></i></a>
        </td>
      </tr>";;
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>⚠️ Data tidak ditemukan</td></tr>";
    }
    exit;
}

?>

<div class="container">

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="popup">
            <?php
            if ($_GET['pesan'] == 'tambah') echo "✅ Data jurusan berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data jurusan berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data jurusan berhasil dihapus!";
            ?>
            <button type="button" title="close" class="close-popup"><i class='bx bx-x'></i></button>
        </div>
    <?php endif; ?>

    <?php
    if (isset($_GET['page']) && $_GET['page'] == 'jurusan') {
        if (isset($_GET['action']) && $_GET['action'] == 'tambah-jurusan') {
            include "jurusan_tambah.php";
        } else if (isset($_GET['action']) && $_GET['action'] == 'edit-jurusan') {
            include "jurusan_edit.php";
        } else {

    ?>

            <!-- Pencarian + Tombol Tambah -->
            <div class="top-bar">

                <form method="get" action="" id="searchForm">
                    <input type="hidden" name="page" value="jurusan">
                    <input type="search" name="cari" id="searchInput" placeholder="Cari jurusan..." value="<?= htmlspecialchars($cari) ?>">
                </form>

                <a href="index.php?page=jurusan&action=tambah-jurusan">+ Tambah Jurusan</a>
            </div>

            <!-- Tabel Data -->
            <div class="table-container">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            <th>Singkatan</th>
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
                                    <td><?= $row['nama_jurusan'] ?></td>
                                    <td><?= $row['singkatan'] ?></td>
                                    <td>
                                        <a href="index.php?page=jurusan&action=edit-jurusan&id=<?= $row['id_jurusan'] ?>" class="btn btn-warning" title="edit"><i class='bx bxs-edit'></i></a>
                                        <a href="jurusan_hapus.php?id=<?= $row['id_jurusan'] ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus jurusan ini?')" title="hapus"><i class='bx bxs-trash' ></i></a>
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
</div>