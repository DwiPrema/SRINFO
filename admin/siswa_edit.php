<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=siswa");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa=$id"));

if (isset($_POST['update'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $no_absen = $_POST['no_absen'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $id_kelas   = $_POST['id_kelas'];

    mysqli_query($koneksi, "UPDATE siswa SET 
        nama_siswa='$nama_siswa',
        no_absen='$no_absen',
        tgl_lahir='$tgl_lahir',
        alamat='$alamat',
        telp='$telp',
        nis='$nis',
        nisn='$nisn',
        id_kelas='$id_kelas'
        WHERE id_siswa=$id");

    $kelas = strtolower(str_replace(' ', '-', $_SESSION['nama_kelas']));
    header("Location: index.php?page=siswa&action=$kelas&pesan=edit");
    exit;
}
?>

<div class="container-tambah">
    <h2>Edit Data Siswa</h2>
    <form method="post">
        <div class="input-section">
            <label class="form-label">No Absen</label>
            <input type="number" name="no_absen" value="<?= $data['no_absen'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Nama Siswa</label>
            <input type="text" maxlength="100" name="nama_siswa" value="<?= $data['nama_siswa'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">No Telp</label>
            <input type="text" name="telp" maxlength="15" class="form-control" value="<?= $data['telp'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">NIS</label>
            <input type="number" name="nis" maxlength="5" class="form-control" value="<?= $data['nis'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">NISN</label>
            <input type="text" name="nisn" maxlength="15" class="form-control" value="<?= $data['nisn'] ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <?php
                $qKelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                while ($kelas = mysqli_fetch_assoc($qKelas)) {
                    $selected = ($kelas['id_kelas'] == $data['id_kelas']) ? "selected" : "";
                    echo "<option value='{$kelas['id_kelas']}' $selected>{$kelas['nama_kelas']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="index.php?page=siswa" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>