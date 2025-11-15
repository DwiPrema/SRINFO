<?php
    include "../koneksi.php";

    // =========================== DATA GURU =========================== //
    $queryGuru = mysqli_query($koneksi, "SELECT COUNT(*) AS total_guru FROM guru");
    $dataGuru = mysqli_fetch_assoc($queryGuru);

    // =========================== DATA PEGAWAI =========================== //
    $queryPegawai = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pegawai FROM pegawai");
    $dataPegawai = mysqli_fetch_assoc($queryPegawai);

    // =========================== DATA SISWA =========================== //
    $querySiswa = mysqli_query($koneksi, "SELECT COUNT(*) AS total_siswa FROM siswa");
    $dataSiswa = mysqli_fetch_assoc($querySiswa);

    // =========================== TOTAL GURU, PEGAWAI, SISWA =========================== //
    $total_guru = $dataGuru['total_guru'];
    $total_pegawai = $dataPegawai['total_pegawai'];
    $total_siswa = $dataSiswa['total_siswa'];
?>

<div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
    <div class="overlay">
        <h1>Dashboard Admin</h1>
        <p>Akses Informasi Sesuai Dengan Kebutuhan Anda!</p>
    </div>
</div>

<div class="card-container">
    <div class="card">
        <i class='bx bx-male-female'></i>
        <h1>Jumlah Guru</h1>
        <p><?= $total_guru ?></p>
    </div>

    <div class="card">
        <i class='bx bxs-group'></i>
        <h1>Jumlah Pegawai</h1>
        <p><?= $total_pegawai ?></p>
    </div>

    <div class="card">
        <i class='bx bx-child'></i>
        <h1>Jumlah Siswa</h1>
        <p><?= $total_siswa ?></p>
    </div>
</div>