<?php
include "database.php";


$judul_buku = $conn->real_escape_string($judul_buku);

$sqlinsert = "INSERT INTO pinjam_buku (id_pinjam, nim,  judul_buku, tanggal_pinjam, tanggal_kembali, status, harga_sewa, denda)
VALUES (null, $nim, '$judul_buku', '$tanggal_pinjam_br', '$tanggal_kembali', '$status', $harga_sewa, $denda)";
$sql=$sqlinsert;

if ($conn->query($sql) === TRUE) {
	echo '[$nim] data tersimpan!';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>