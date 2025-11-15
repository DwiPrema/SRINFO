<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$detail = mysqli_query($koneksi, "SELECT * FROM jurnal, kelas WHERE id_jurnal = '$id' AND jurnal.id_kelas = kelas.id_kelas");
$data = mysqli_fetch_assoc($detail);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<div class="detail-jurnal">
    <h3>Detail Jurnal</h3>
    <p><b>Tanggal:</b> <?= $data['tgl_mengajar'] ?></p>
    <p><b>Kelas:</b> <?= $data['nama_kelas'] ?></p>
    <p><b>Materi:</b> <?= $data['materi'] ?></p>
    <p><b>Keterangan:</b> <?= $data['ket'] ?></p>
</div>
<div class="btn-container">
    <a href="index.php?page=edit-jurnal&id=<?= $data['id_jurnal'] ?>" class="btn btn-warning-detail" title="edit"><i class='bx bxs-edit'></i></a>
    <a href="jurnal_hapus.php?id=<?= $data['id_jurnal'] ?>"
        class="btn btn-danger detail" onclick="closePopup()"
        title="hapus"><i class='bx bxs-trash'></i></a>
</div>
<button class="btn btn-cancel detail" onclick="closePopup()">Tutup</button>