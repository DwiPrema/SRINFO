<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php?page=cek-jurnal");
    exit;
}

$id = $_GET['id'];

// Ambil data jurnal berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM jurnal WHERE id_jurnal = $id
"));

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $tgl_mengajar = $_POST['tgl_mengajar'];
    $materi = $_POST['materi'];
    $ket = $_POST['ket'];
    $id_kelas = $_POST['id_kelas'];

    // Update ke database
    mysqli_query($koneksi, "
        UPDATE jurnal SET
            tgl_mengajar = '$tgl_mengajar',
            materi = '$materi',
            ket = '$ket',
            id_kelas = '$id_kelas'
        WHERE id_jurnal = $id
    ");

    $guru = strtolower(str_replace(' ', '-', $_GET['id_guru']));
    header("Location: index.php?page=cek-jurnal&id_guru=$guru&pesan=edit");
    exit;
}
?>

<div class="container-tambah">
    <h2>Edit Data Jurnal</h2>
    <form method="post">
        <div class="input-section">
            <label class="form-label">Tanggal Mengajar</label>
            <input type="date" name="tgl_mengajar" class="form-control" 
                   value="<?= $data['tgl_mengajar'] ?>" required>
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

        <div class="input-section">
            <label class="form-label">Materi</label>
            <input type="text" name="materi" maxlength="100" class="form-control"
                   value="<?= htmlspecialchars($data['materi']) ?>" required>
        </div>

        <div class="input-section">
            <label class="form-label">Keterangan</label>
            <input name="ket" class="form-control" required value="<?= htmlspecialchars($data['ket']) ?>">
        </div>

        <div class="btn-container">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="index.php?page=jurnal" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
