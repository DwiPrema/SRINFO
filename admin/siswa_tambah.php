<?php
include "../koneksi.php";

$qKelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");

if (isset($_POST['simpan'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $no_absen = $_POST['no_absen'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $id_kelas   = $_POST['id_kelas'];

    $query = "INSERT INTO siswa (nama_siswa, no_absen, tgl_lahir, alamat, telp, nis, nisn, id_kelas)
              VALUES ('$nama_siswa', '$no_absen', '$tgl_lahir', '$alamat', '$telp', '$nis', '$nisn', '$id_kelas')";
    mysqli_query($koneksi, $query);
    
    $kelas = mysqli_query($koneksi, "SELECT nama_kelas FROM kelas WHERE id_kelas = $id_kelas");
    $kelasData = mysqli_fetch_assoc($kelas);
    $nama_kelas = $kelasData['nama_kelas'];
    header("Location: index.php?page=siswa&action=filter&kelas=" . urlencode($nama_kelas) . "&pesan=tambah");
    exit;
}
?>

<div class="container-tambah">
    <h2>Tambah Data Siswa</h2>

    <form method="post">
        <div class="input-section">
            <label class="form-label">No Absen</label>
            <input type="text" name="no_absen" required>
        </div>

        <div class="input-section">
            <label class="form-label">Nama Siswa</label>
            <input type="text" maxlength="100" name="nama_siswa" required>
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
            <input type="text" name="telp" maxlength="15" required>
        </div>

        <div class="input-section">
            <label class="form-label">NIS</label>
            <input type="number" name="nis" maxlength="5" required>
        </div>

        <div class="input-section">
            <label class="form-label">NISN</label>
            <input type="number" name="nisn" maxlength="15" required>
        </div>

        <div class="input-section">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <?php while ($kelas = mysqli_fetch_assoc($qKelas)) { ?>
                    <option value="<?= $kelas['id_kelas'] ?>">
                        <?= htmlspecialchars($kelas['nama_kelas']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <button onclick="window.history.back()"  class="btn btn-secondary">Kembali</button>
        </div>
    </form>
</div>