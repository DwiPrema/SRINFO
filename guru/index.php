<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['id_guru']) || $_SESSION['id_guru'] == "") {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "jurnal_tambah.php";

$namaGuru = $_SESSION['nama_guru'];
$idGuru   = (int)$_SESSION['id_guru'];



$cari = "";
$searchQuery = "";

if (!empty($_GET['cari'])) {
    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $searchQuery .= " 
        AND (
            jurnal.materi LIKE '%$cari%' OR 
            jurnal.ket LIKE '%$cari%' OR 
            kelas.nama_kelas LIKE '%$cari%'
        )";
}




$query = "
    SELECT * FROM jurnal
    JOIN kelas ON jurnal.id_kelas = kelas.id_kelas
    WHERE jurnal.id_guru = $idGuru
    $searchQuery
    ORDER BY jurnal.id_jurnal DESC
";

$result = mysqli_query($koneksi, $query);




if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {

    ob_clean();
    $no = 1;

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $id     = (int)$row['id_jurnal'];
            $tgl    = htmlspecialchars($row['tgl_mengajar']);
            $kelas  = htmlspecialchars($row['nama_kelas']);
            $materi = htmlspecialchars($row['materi']);
            $ket    = htmlspecialchars($row['ket']);

            echo "
            <tr>
                <td>{$no}</td>
                <td class='col-tgl-mengajar'>{$tgl}</td>
                <td class='col-nama-kelas'>{$kelas}</td>
                <td class='col-materi'>{$materi}</td>
                <td class='col-keterangan'>{$ket}</td>
                <td class='col-btn'>
                    <a href='index.php?page=edit-jurnal&id={$id}' class='btn btn-warning'><i class='bx bxs-edit'></i></a>
                    <a href='jurnal_hapus.php?id={$id}' class='btn btn-danger'><i class='bx bxs-trash'></i></a>
                    <button class='btn btn-detail' data-id='{$id}'><i class='bx bxs-detail'></i></button>
                </td>
            </tr>
            ";
            $no++;
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>⚠️ Data tidak ditemukan</td></tr>";
    }

    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Guru</title>

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- boxicons v2.1.4 -->
    <link rel="stylesheet" href="../lib/boxicons/css/boxicons.min.css">

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/switch-mode.css">

</head>

<body>
    <?php
    include "../switch-mode.php";
    ?>

    <div class="left-sidebar">
        <div class="logo">
            <img src="../assets/logo-ssri.png" alt="logo-ssri">
        </div>

        <a class="box logout" title="Logout" href="logout.php">
            <i class='bx bx-log-out'></i>
        </a>
    </div>

    <section class="point-content">

        <div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">

            <div class="overlay">
                <div class="date">
                    <p><?= date("l, d M Y") ?></p>
                </div>
                <h1>Hai <?= $namaGuru ?></h1>
                <p>Silahkan isi jurnal anda hari ini !</p>
            </div>
        </div>

        <div class="container">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                switch ($page) {
                    case 'edit-jurnal':
                        include "jurnal_edit.php";
                        break;
                    default:
                        echo "<h1>Halaman tidak ditemukan !</h1>";
                        break;
                }
            } else {
            ?>

                <?php if (isset($_GET['pesan'])): ?>
                    <div class="popup">
                        <?php
                        if ($_GET['pesan'] == 'tambah') echo "✅ Berhasil mengisi jurnal!";
                        if ($_GET['pesan'] == 'edit') echo "✅ Data jurnal berhasil diperbaharui!";
                        if ($_GET['pesan'] == 'hapus') echo "✅ Data jurnal berhasil dihapus!";
                        ?>
                        <button type="button" title="close" class="close-popup"><i class='bx bx-x'></i></button>
                    </div>
                <?php endif; ?>

                <div class="top-bar">
                    <form id="searchForm">
                        <input type="search" id="searchInput" name="cari" placeholder="Cari data jurnal..." value="<?= htmlspecialchars($cari) ?>">
                    </form>

                    <form class="filter" method="get">
                        <select id="filterSelect">
                            <option value="all">Semua</option>
                            <option value="yesterday">Kemarin</option>
                            <option value="this_week">Minggu ini</option>
                            <option value="this_month">Bulan ini</option>
                        </select>
                    </form>
                </div>

                <!-- Tabel Data -->
                <div class="table-container">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th class="col-tgl-mengajar">Tanggal Mengajar</th>
                                <th class="col-nama-kelas">Nama Kelas</th>
                                <th class="col-materi">Materi</th>
                                <th class="col-keterangan">Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="tableBody">
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td class="col-tgl-mengajar"><?= $row['tgl_mengajar'] ?></td>
                                        <td class="col-nama-kelas"><?= $row['nama_kelas'] ?></td>
                                        <td class="col-materi"><?= $row['materi'] ?></td>
                                        <td class="col-keterangan"><?= $row['ket'] ?></td>
                                        <td class="col-btn">
                                            <a href="index.php?page=edit-jurnal&id=<?= $row['id_jurnal'] ?>" class="btn btn-warning" title="edit"><i class='bx bxs-edit'></i></a>
                                            <a href="jurnal_hapus.php?id=<?= $row['id_jurnal'] ?>"
                                                class="btn btn-danger"
                                                title="hapus"><i class='bx bxs-trash'></i></a>
                                            <button class="btn btn-detail" data-id="<?= $row['id_jurnal'] ?>"><i class='bx bxs-detail'></i></button>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center">⚠️ Data tidak ditemukan</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <button id="toggleTable" class="btn btn-see-all">
                        <p>Tampilkan Semua</p>
                        <i class='bx bxs-chevrons-down'></i>
                    </button>
                </div>
            <?php
            }
            ?>

        </div>

    </section>

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

    <div id="popup-root"></div>

    <div id="popup-detail">
        <div class="popup">
            <div class="popup-container-detail">

            </div>
        </div>
    </div>


    <script src="../js/switchMode.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const tableBody = document.getElementById("tableBody");

            if (searchInput) {
                searchInput.addEventListener("keyup", function() {

                    const cari = searchInput.value;
                    const url = "index.php?ajax=1&cari=" + encodeURIComponent(cari);

                    fetch(url)
                        .then(res => res.text())
                        .then(data => {
                            tableBody.innerHTML = data;
                        })
                        .catch(err => console.error(err));
                });
            }
        });
    </script>
    <script src="js/script.js"></script>

</body>

</html>