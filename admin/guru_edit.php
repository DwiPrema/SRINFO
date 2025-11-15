<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=guru");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru=$id"));

if (isset($_POST['update'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $alamat    = $_POST['alamat'];
    $telp    = $_POST['telp'];
    $username    = $_POST['username'];
    $password    = md5($_POST['password']);

    mysqli_query($koneksi, "UPDATE guru SET nama_guru='$nama_guru', tgl_lahir='$tgl_lahir', alamat='$alamat', telp='$telp', username='$username', password='$password' WHERE id_guru=$id");
    header("Location: index.php?page=guru&pesan=edit");
    exit;
}
?>

<div class="container-tambah">
    <h2>Edit Data Guru</h2>
    <form method="post">
        <div class="input-section">
            <label class="form-label">Nama Guru</label>
            <input type="text" maxlength="100" name="nama_guru" value="<?= $data['nama_guru'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">No.Telp</label>
            <input type="number" name="telp" maxlength="15" class="form-control" value="<?= $data['telp'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Username</label>
            <input type="text" name="username" maxlength="20" class="form-control" value="<?= $data['username'] ?>" required>
        </div>

        <div class="btn-container">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>