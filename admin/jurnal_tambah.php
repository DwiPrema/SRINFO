<?php
if (isset($_POST['simpan'])) {

    $tgl_mengajar = $_POST['tgl_mengajar'];
    $id_kelas     = $_POST['id_kelas'];
    $materi       = $_POST['materi'];
    $ket          = $_POST['ket'];
    $id_guru      = $_GET['id_guru'] ?? null;

    mysqli_query(
        $koneksi,
        "INSERT INTO jurnal (id_guru, tgl_mengajar , id_kelas, materi, ket)
         VALUES ('$id_guru', '$tgl_mengajar', '$id_kelas', '$materi', '$ket')"
    );

    header("Location: index.php?page=cek-jurnal&id_guru=" . urlencode($id_guru) . "&pesan=tambah");
    exit;
}
?>

<div class="container-tambah">

    <h2>Tambah jurnal</h2>

    <form method="post">

        <div class="input-section">
            <label class="form-label">tanggal mengajar</label>
            <input type="date" name="tgl_mengajar" class="form-control" required>
        </div>

        <div class="input-section">
            <label class="form-label">kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="">-- Pilih kelas --</option>
                <?php
                $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                while ($row = mysqli_fetch_assoc($kelas)) { ?>
                    <option value="<?= $row['id_kelas']; ?>">
                        <?= $row['nama_kelas']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="input-section">
            <label class="form-label">Materi</label>
            <input maxlength="100" name="materi" class="form-control" required>
        </div>

        <div class="input-section">
            <label class="form-label">Keterangan</label>
            <input maxlength="100" name="ket" class="form-control" required>
        </div>

        <div class="btn-container">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>