<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jurnal WHERE id_jurnal=$id"));

if (isset($_POST['update'])) {
    $tgl_mengajar    = $_POST['tgl_mengajar'];
    $id_kelas = $_POST['id_kelas'];
    $materi = $_POST['materi'];
    $keterangan   = $_POST['keterangan'];


    mysqli_query($koneksi, "UPDATE jurnal SET 
    tgl_mengajar ='$tgl_mengajar',
    id_kelas ='$id_kelas',
    materi = '$materi',
    ket = '$keterangan'
    WHERE id_jurnal=$id");
    header("Location: index.php");
    exit;
}
?>
<div class="container-tambah">

    <h2>Edit Data Jurnal</h2>

    <form method="post">

        <div class="input-section">
            <label class="form-label">Tanggal Mengajar</label>
            <input
                type="date"
                name="tgl_mengajar"
                class="form-control"
                value="<?= $data['tgl_mengajar'] ?>"
                required="required">
        </div>

        <div class="input-section">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-control" required="required">
                <option value="">-- Pilih Kelas --</option>
                <?php
                $id_kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                while ($row = mysqli_fetch_assoc($id_kelas)) {
                    $selected = ($row['id_kelas'] == $data['id_kelas']) ? "selected" : "";
                    echo "<option value='{$row['id_kelas']}' $selected>{$row['nama_kelas']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="input-section">
            <label class="form-label">Materi</label>
            <input
            maxlength="100"
                type="text"
                name="materi"
                class="form-control"
                value="<?= $data['materi'] ?>"
                required="required">
        </div>

        <div class="input-section">
            <label class="form-label">Keterangan</label>
            <input
            maxlength="100"
                type="text"
                name="keterangan"
                class="form-control"
                value="<?= $data['ket'] ?>"
                required="required">
        </div>

        <div class="btn-container">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>