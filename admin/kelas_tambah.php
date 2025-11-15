<?php
include "../koneksi.php";

$qJurusan = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
$qGuru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");

if (isset($_POST['simpan'])) {
    $nama_kelas = $_POST['nama_kelas'];
    $id_guru = $_POST['id_guru'];
    $id_jurusan = $_POST['id_jurusan'];

    mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas, id_guru, id_jurusan) VALUES ('$nama_kelas','$id_guru', '$id_jurusan')");
    header("Location: index.php?page=kelas&pesan=tambah");
    exit;
}
?>

<div class="container-tambah">
    <h2>Tambah Kelas</h2>

    <form method="post">
        <div class="input-section">
            <label class="form-label">Nama Kelas</label>
            <input type="text" maxlength="12" name="nama_kelas" required>
        </div>

        <div class="input-section">
            <label class="form-label">Jurusan</label>
            <select name="id_jurusan" class="form-select" required>
                <option value="">-- Pilih Jurusan --</option>
                <?php while ($jurusan = mysqli_fetch_assoc($qJurusan)) { ?>
                    <option value="<?= $jurusan['id_jurusan'] ?>">
                        <?= htmlspecialchars($jurusan['nama_jurusan']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="input-section">
            <label class="form-label">Guru Wali</label>
            <select name="id_guru" class="form-select" required>
                <option value="">-- Nama Guru Wali --</option>
                <?php while ($guru = mysqli_fetch_assoc($qGuru)) { ?>
                    <option value="<?= $guru['id_guru'] ?>">
                        <?= htmlspecialchars($guru['nama_guru']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php?page=kelas" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>