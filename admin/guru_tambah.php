<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $alamat    = $_POST['alamat'];
    $telp    = $_POST['telp'];
    $username    = $_POST['username'];
    $password    = md5($_POST['password']);

    mysqli_query($koneksi, "INSERT INTO guru (nama_guru, tgl_lahir, alamat, telp, username, password) VALUES ('$nama_guru','$tgl_lahir', '$alamat', '$telp', '$username', '$password')");
    header("Location: index.php?page=guru&pesan=tambah");
    exit;
}
?>

<div class="container-tambah">
    <h2>Tambah Data Guru</h2>

    <form method="post">
        <div class="input-section">
            <label class="form-label">Nama Guru</label>
            <input type="text" maxlength="100" name="nama_guru" required>
        </div>

        <div class="input-section">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" required>
        </div>

        <div class="input-section">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" required>
        </div>

        <div class="input-section">
            <label class="form-label">Telepon</label>
            <input type="number" name="telp" maxlength="15" required>
        </div>

        <div class="input-section">
            <label class="form-label">Username</label>
            <input type="text" name="username" maxlength="20" required>
        </div>

        <div class="input-section">
            <label class="form-label">Password</label>
            <input type="text" name="password" required>
        </div>

        <div class="btn-container">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>