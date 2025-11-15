<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM siswa WHERE id_siswa=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Ambil nama_kelas dari GET agar bisa dipakai di redirect
    $nama_kelas = isset($_GET['nama_kelas']) ? $_GET['nama_kelas'] : '';

    header("Location: index.php?page=siswa&nama_kelas=" . urlencode($nama_kelas) . "&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=siswa");
    exit;
}
?>
