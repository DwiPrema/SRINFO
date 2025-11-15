<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_jurusan = $_POST['nama_jurusan'];
    $singkatan    = $_POST['singkatan'];

    mysqli_query($koneksi, "INSERT INTO jurusan (nama_jurusan, singkatan) VALUES ('$nama_jurusan','$singkatan')");
    header("Location: index.php?page=jurusan&pesan=tambah");
    exit;
}
?>

<div class="container-tambah">
    <h2>Tambah Jurusan</h2>

    <form method="post">
        <div class="input-section">
            <label class="form-label">Nama Jurusan</label>
            <input type="text" maxlength="50" name="nama_jurusan" required>
        </div>

        <div class="input-section">
            <label class="form-label">Singkatan</label>
            <input type="text" name="singkatan" maxlength="5" required>
        </div>

        <div class="btn-container">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php?page=jurusan" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>