<?php
include "../koneksi.php";

// ==========================
// CEK id_guru
// ==========================
$id_guru = $_GET['id_guru'] ?? null;

// Ambil data guru
$guruData = mysqli_query($koneksi, "SELECT nama_guru FROM guru WHERE id_guru = '$id_guru'");
$guru = mysqli_fetch_assoc($guruData) ?? ['nama_guru' => 'Tidak ditemukan'];


// AJAX Jurnal
if (isset($_GET['ajax']) && $_GET['ajax'] == "jurnal") {

    $cari = $_GET['cari'] ?? "";

    $query = "
        SELECT * FROM jurnal
        JOIN guru ON jurnal.id_guru = guru.id_guru
        WHERE jurnal.id_guru = '$id_guru'
    ";

    if ($cari != "") {
        $query .= " AND jurnal.materi LIKE '%$cari%'";
    }

    $query .= " ORDER BY jurnal.id_jurnal DESC";

    $result = mysqli_query($koneksi, $query);

    $no = 1;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>$no</td>
                <td>{$row['tgl_mengajar']}</td>
                <td>{$row['materi']}</td>
                <td>{$row['ket']}</td>
                <td>
                    <a href='index.php?page=cek-jurnal&id_guru=$id_guru&action=edit-jurnal&id={$row['id_jurnal']}' class='btn btn-warning'><i class='bx bxs-edit'></i></a>
                    <a href='jurnal_hapus.php?id_guru=$id_guru&id={$row['id_jurnal']}' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus data jurnal ini?')\"><i class='bx bxs-trash'></i></a>
                </td>
            </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>Data tidak ditemukan</td></tr>";
    }
    exit;
}
?>


<div class="container">

    <div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
        <div class="overlay">
            <h1>Data Jurnal Guru</h1>
            <h1><?= $guru['nama_guru']; ?></h1>
            <p>Akses data jurnal guru yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
        </div>
    </div>



    <?php
    if (isset($_GET['page']) && $_GET['page'] == 'cek-jurnal') {
        if (isset($_GET['action']) && $_GET['action'] == 'isi-jurnal') {
            include "jurnal_tambah.php";
        } else if (isset($_GET['action']) && $_GET['action'] == 'edit-jurnal') {
            include "jurnal_edit.php";
        } else {
    ?>

            <?php if (isset($_GET['pesan'])): ?>
                <div class="popup">
                    <?php
                    if ($_GET['pesan'] == 'tambah') echo "✅ Data jurnal berhasil ditambahkan!";
                    if ($_GET['pesan'] == 'edit') echo "✅ Data jurnal berhasil diperbaharui!";
                    if ($_GET['pesan'] == 'hapus') echo "✅ Data jurnal berhasil dihapus!";
                    ?>
                    <button type="button" title="close" class="close-popup"><i class='bx bx-x'></i></button>
                </div>
            <?php endif; ?>

            <div class="top-bar">
                <input type="text" id="searchJurnal" placeholder="Cari...">

                <a href="index.php?page=cek-jurnal&id_guru=<?= $id_guru ?>&action=isi-jurnal">+ Isi Jurnal</a>
            </div>

            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Materi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="jurnalData"></tbody>
            </table>
</div>


<?php
        }
    }

?>