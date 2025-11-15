<?php
session_start();
include "../koneksi.php";

$idGuru = (int)$_SESSION['id_guru'];

$filter = $_GET['filter'] ?? "all";
$cari   = $_GET['cari'] ?? "";

$filterQuery = "";
if ($filter == "yesterday") {
    $filterQuery .= " AND DATE(tgl_mengajar) = CURDATE() - INTERVAL 1 DAY";
} else if ($filter == "this_week") {
    $filterQuery .= " AND WEEK(tgl_mengajar) = WEEK(CURDATE()) AND YEAR(tgl_mengajar) = YEAR(CURDATE())";
} else if ($filter == "this_month") {
    $filterQuery .= " AND MONTH(tgl_mengajar) = MONTH(CURDATE()) AND YEAR(tgl_mengajar) = YEAR(CURDATE())";
}

$searchQuery = "";
if (!empty($cari)) {
    $cari = mysqli_real_escape_string($koneksi, $cari);
    $searchQuery .= " AND (
        jurnal.materi LIKE '%$cari%' OR 
        jurnal.ket LIKE '%$cari%' OR 
        kelas.nama_kelas LIKE '%$cari%'
    )";
}

$query = "
    SELECT * FROM jurnal
    JOIN kelas ON jurnal.id_kelas = kelas.id_kelas
    WHERE jurnal.id_guru = $idGuru
    $filterQuery
    $searchQuery
    ORDER BY jurnal.id_jurnal DESC
";

$result = mysqli_query($koneksi, $query);

$no = 1;

if (mysqli_num_rows($result) > 0) {
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
            </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>⚠️ Data tidak ditemukan</td></tr>";
}
