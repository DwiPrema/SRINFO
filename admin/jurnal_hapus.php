<?php
include "../koneksi.php";
$id_guru = $_GET['id_guru'] ?? null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM jurnal WHERE id_jurnal=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=cek-jurnal&id_guru=$id_guru&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=cek-jurnal&id_guru=$id_guru");
    exit;
}

?>