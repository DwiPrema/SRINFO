<?php
if (isset($_POST['simpan'])) {

    $tgl_mengajar = $_POST['tgl_mengajar'];
    $id_kelas     = $_POST['id_kelas'];
    $materi       = $_POST['materi'];
    $ket          = $_POST['ket'];
    $id_guru      = $_SESSION['id_guru'];

    mysqli_query(
        $koneksi,
        "INSERT INTO jurnal (id_guru, tgl_mengajar , id_kelas, materi, ket)
         VALUES ('$id_guru', '$tgl_mengajar', '$id_kelas', '$materi', '$ket')"
    );

    header("Location: index.php");
    exit;
}

