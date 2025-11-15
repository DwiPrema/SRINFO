<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM jurnal WHERE id_jurnal=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}

?>