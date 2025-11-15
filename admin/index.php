<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- boxicons -->
    <link rel="stylesheet" href="../lib/boxicons/css/boxicons.min.css">

    <!-- css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/main-container.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/page-tambah.css">
    <link rel="stylesheet" href="../css/switch-mode.css">

    <title>Dashboard Admin</title>

</head>

<body>
    <?php include "../switch-mode.php"; ?>
    <div class="left-sidebar">
        <div class="logo">
            <img src="../assets/logo-ssri.png" alt="logo-ssi">
            <div class="logo-text">
                <h1>SRINFO</h1>
                <p>SSRI Information</p>
            </div>
        </div>

        <div class="line"></div>

        <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home' ?>

        <div class="menu">
            <a href="index.php?page=home" class="menu-btn <?php echo ($page == 'home') ? 'active' : ""; ?>">
                <i class='bx bx-home'></i>
                <p>Home</p>
            </a>

            <a href="index.php?page=guru" class="menu-btn <?php echo ($page == 'guru') ? 'active' : ""; ?>">
                <i class='bx bx-male-female'></i>
                <p>Data Guru</p>
            </a>

            <a href="index.php?page=pegawai" class="menu-btn <?php echo ($page == 'pegawai') ? 'active' : ""; ?>">
                <i class='bx bxs-group'></i>
                <p>Data Pegawai</p>
            </a>

            <a href="index.php?page=siswa" class="menu-btn <?php echo ($page == 'siswa') ? 'active' : ""; ?>">
                <i class='bx bx-child'></i>
                <p>Data Siswa</p>
            </a>

            <a href="index.php?page=jurusan" class="menu-btn <?php echo ($page == 'jurusan') ? 'active' : ""; ?>">
                <i class='bx bxs-graduation'></i>
                <p>Data Jurusan</p>
            </a>

            <a href="index.php?page=kelas" class="menu-btn <?php echo ($page == 'kelas') ? 'active' : ""; ?>">
                <i class='bx bxs-school'></i>
                <p>Data Kelas</p>
            </a>

            <a href="index.php?page=jurnal-guru" class="menu-btn <?php echo ($page == 'jurnal-guru' || $page == 'cek-jurnal') ? 'active' : ""; ?>">
                <i class='bx bxs-school'></i>
                <p>Jurnal Guru</p>
            </a>
        </div>

        <div class="line"></div>

        <div class="setting">
            <a href="#">
                <i class='bx bxs-cog'></i>
                <p>Setting</p>
            </a>

            <a href="logout.php" id="logout">
                <i class='bx bx-log-out'></i>
                <p>Logout</p>
            </a>

        </div>
    </div>

    <div class="content">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'home':
                    include "home.php";
                    break;
                case 'guru':
                    include "guru.php";
                    break;
                case 'pegawai':
                    include "pegawai.php";
                    break;
                case 'jurusan':
                    include "jurusan.php";
                    break;
                case 'siswa':
                    include "siswa.php";
                    break;
                case 'kelas':
                    include "kelas.php";
                    break;
                case 'jurnal-guru':
                    include "jurnal_guru.php";
                    break;
                case 'cek-jurnal':
                    include "jurnal_cek.php";
                    break;
                default:
                    echo '<Center><h3>Maaf, Halaman Tidak Ditemukan</h3></Center>';
            }
        } else {
            include "home.php";
        }
        ?>
    </div>

    <script src="../js/switchMode.js"></script>
    <script src="./js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const tableBody = document.getElementById("tableBody");
            const searchForm = document.getElementById("searchForm");

            if (searchInput) {
                searchInput.addEventListener("keyup", function() {
                    const formData = new FormData(searchForm);
                    formData.append("ajax", "1");

                    fetch("index.php?" + new URLSearchParams(formData), {
                            method: "GET"
                        })
                        .then(res => res.text())
                        .then(data => {
                            tableBody.innerHTML = data;
                        })
                        .catch(err => console.error(err));
                });
            }


            const searchGuru = document.getElementById("searchGuru");
            const guruData = document.getElementById("guruData");

            if (searchGuru && guruData) {
                function loadGuru(cari = "") {
                    fetch(`jurnal_guru.php?ajax=guru&cari=${encodeURIComponent(cari)}`)
                        .then(res => res.text())
                        .then(html => {
                            guruData.innerHTML = html;
                        });
                }

                searchGuru.addEventListener("keyup", () => loadGuru(searchGuru.value));
                loadGuru();
            }



            const searchJurnal = document.getElementById("searchJurnal");
            const jurnalData = document.getElementById("jurnalData");

            if (searchJurnal && jurnalData) {
                function loadJurnal(cari = "") {
                    fetch(`jurnal_cek.php?ajax=jurnal&id_guru=<?= $id_guru ?? 0 ?>&cari=${encodeURIComponent(cari)}`)
                        .then(res => res.text())
                        .then(html => {
                            jurnalData.innerHTML = html;
                        });
                }

                searchJurnal.addEventListener("keyup", () => loadJurnal(searchJurnal.value));
                loadJurnal();
            }
        });
    </script>

</body>

</html>