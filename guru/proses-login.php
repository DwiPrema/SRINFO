<?php
session_start();
include "../koneksi.php";

$username = $_POST['username'];
$password = md5($_POST["password"]);

//Query cek data
$sql = "SELECT * FROM guru WHERE username = '$username' AND password = '$password'";

$query = mysqli_query($koneksi, $sql);
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    //Simpan Session
    $_SESSION['login'] = true;
    $_SESSION['id_guru'] = $data['id_guru'];
    $_SESSION['nama_guru'] = $data['nama_guru'];

    echo "<script>
        window.location.href = 'index.php';
    </script>";
} else {
    include "login.php";
    echo "<script>
            const popupFalse = document.getElementById('false');

        popupFalse.style.display = 'flex';
        </script>";
}