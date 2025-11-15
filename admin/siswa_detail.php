<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$detail = mysqli_query($koneksi, "SELECT * FROM siswa, kelas WHERE id_siswa = '$id' AND siswa.id_kelas = kelas.id_kelas");
$data = mysqli_fetch_assoc($detail);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<div class="popup-detail">
    <div class="popup-container-detail">
        <div class="detail siswa">
            <h3>Detail Siswa</h3>
            <p><b>Nama: </b> <?= $data['nama_siswa'] ?></p>
            <p><b>No Absen: </b> <?= $data['no_absen'] ?></p>
            <p><b>Kelas: </b> <?= $data['nama_kelas'] ?></p>
            <p><b>NIS: </b> <?= $data['nis'] ?></p>
            <p><b>NISN: </b> <?= $data['nisn'] ?></p>
            <p><b>No Telepon: </b> <?= $data['telp'] ?></p>
            <p><b>Tanggal Lahir: </b> <?= $data['tgl_lahir'] ?></p>
            <p><b>Alamat: </b> <?= $data['alamat'] ?></p>
        </div>
        <div class="btn-container">
            <button onclick="window.history.back()" class="btn btn-warning"><p>Kembali</p></button>
        </div>
    </div>
</div>