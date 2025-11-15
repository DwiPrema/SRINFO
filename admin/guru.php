<div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
    <div class="overlay">
        <h1>Data Guru</h1>
        <p>Akses data guru yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
    </div>
</div>

<?php
include "../koneksi.php";
// Cek apakah ada pencarian
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM guru 
                                      WHERE nama_guru LIKE '%$cari%' 
                                      ORDER BY id_guru DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY id_guru DESC");
}

if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {
    ob_clean();
    $no = 1;
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
          <td>" . $no++ . "</td>
          <td>{$row['nama_guru']}</td>
          <td>{$row['tgl_lahir']}</td>
          <td>{$row['alamat']}</td>
          <td>{$row['telp']}</td>
          <td>{$row['username']}</td>
          <td>
              <a href='index.php?page=guru&action=edit-guru&id={$row['id_guru']}' class='btn btn-warning' title='edit'><i class='bx bxs-edit'></i></a>
              <a href='guru_hapus.php?id={$row['id_guru']}'
                  class='btn btn-danger'
                  onclick=\"return confirm('Yakin ingin menghapus data guru ini?')\" title='hapus'><i class='bx bxs-trash'></i></a>
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
            if ($_GET['pesan'] == 'tambah') echo "✅ Data guru berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data guru berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data guru berhasil dihapus!";
            ?>
            <button type="button" title="close" class="close-popup"><i class='bx bx-x'></i></button>
        </div>
    <?php endif; ?>

    <?php
    if (isset($_GET['page']) && $_GET['page'] == 'guru') {
        if (isset($_GET['action']) && $_GET['action'] == 'tambah-guru') {
            include "guru_tambah.php";
        } else if (isset($_GET['action']) && $_GET['action'] == 'edit-guru') {
            include "guru_edit.php";
        } else {
    ?>

            <!-- Pencarian + Tombol Tambah -->
            <div class="top-bar">

                <form id="searchForm">
                    <input type="hidden" name="page" value="guru">
                    <input type="search" id="searchInput" name="cari" placeholder="Cari guru..." value="<?= htmlspecialchars($cari) ?>">
                </form>

                <a href="index.php?page=guru&action=tambah-guru">+ Tambah Data Guru</a>
            </div>

            <!-- Tabel Data -->
            <div class="table-container">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
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
                                    <td><?= $row['nama_guru'] ?></td>
                                    <td><?= $row['tgl_lahir'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td>
                                        <a href="index.php?page=guru&action=edit-guru&id=<?= $row['id_guru'] ?>" class="btn btn-warning" title="edit"><i class='bx bxs-edit'></i></a>
                                        <a href="guru_hapus.php?id=<?= $row['id_guru'] ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data guru ini?')" title="hapus"><i class='bx bxs-trash' ></i></a>
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