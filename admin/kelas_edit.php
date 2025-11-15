<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=kelas");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas=$id"));

if (isset($_POST['update'])) {
    $nama_kelas = $_POST['nama_kelas'];
    $id_guru = $_POST['id_guru'];
    $id_jurusan = $_POST['id_jurusan'];

    mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama_kelas', id_guru='$id_guru' WHERE id_guru=$id, id_jurusan='$id_jurusan' WHERE id_jurusan='$id'");
    header("Location: index.php?page=jurusan&pesan=edit");
    exit;
}

?>

<div class="container-tambah">
    <h2>Edit Data Kelas</h2>
    <form method="post">
        <div class="input-section">
            <label class="form-label">Nama Kelas</label>
            <input type="text" maxlength="12" name="nama_kelas" value="<?= $data['nama_kelas'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Jurusan</label>
            <select name="id_jurusan" class="form-select" required>
                <option value="">-- Pilih Jurusan --</option>
                <?php
                $qJurusan = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
                while ($jurusan = mysqli_fetch_assoc($qJurusan)) {
                    $selected = ($jurusan['id_jurusan'] == $data['id_jurusan']) ? "selected" : "";
                    echo "<option value='{$jurusan['id_jurusan']}' $selected>{$jurusan['nama_jurusan']}</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="input-section">
            <label class="form-label">Guru</label>
            <select name="id_guru" class="form-select" required>
                <option value="">-- Pilih Guru --</option>
                <?php
                $qGuru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");
                while ($guru = mysqli_fetch_assoc($qGuru)) {
                    $selected = ($guru['id_guru'] == $data['id_guru']) ? "selected" : "";
                    echo "<option value='{$guru['id_guru']}' $selected>{$guru['nama_guru']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="index.php?page=kelas" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>