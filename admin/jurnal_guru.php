<?php
include "../koneksi.php";


if (isset($_GET['ajax']) && $_GET['ajax'] == "guru") {
    $cari = $_GET['cari'] ?? "";

    $query = "SELECT * FROM guru WHERE nama_guru LIKE '%$cari%' ORDER BY id_guru ASC";
    $result = mysqli_query($koneksi, $query);

    $no = 1;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>$no</td>
                <td>{$row['nama_guru']}</td>
                <td>{$row['telp']}</td>
                <td>{$row['username']}</td>
                <td>
                    <a href='index.php?page=cek-jurnal&id_guru={$row['id_guru']}' class='btn btn-warning'>
                        Cek Jurnal
                    </a>
                </td>
            </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
    }
    exit;
}
?>



<div class="container">
    <div class="hero-section" style="background-image: url(../assets/hero-img3.jpg); background-repeat: no-repeat; background-size: cover; background-position: center">
        <div class="overlay">
            <h1>Data Jurnal Guru</h1>
            <p>Akses data jurnal guru yang ada di SMKN 1 Sukawati sesuai kebutuhan Anda.</p>
        </div>
    </div>

    <div class="top-bar">
            <input type="text" id="searchGuru" placeholder="Cari guru...">
    </div>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>No.Telp</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="guruData"></tbody>
    </table>
</div>