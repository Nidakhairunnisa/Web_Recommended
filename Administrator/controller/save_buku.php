<?php
include "database.php";

if (isset ($_POST['nomor_id'])){
	$nomor_id = $_POST['nomor_id'];
} else {
	$nomor_id = "" ;
}

$judul_buku = $_POST['judul_buku'];
$pengarang_buku = $_POST['pengarang_buku'];
$isbn = $_POST['isbn'];
$penerjemah_buku = $_POST['penerjemah_buku'];
$penyunting_buku = $_POST['penyunting_buku'];
$penerbit_buku = $_POST['penerbit_buku'];
$kota_penerbit = $_POST['kota_penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];

$harga_sewa = 0;
$harga_denda = 0;
$abstraksi = $_POST['abstraksi'];

$jumlah_buku = $_POST['jumlah_buku'];


$sqlupdate = "UPDATE data_buku SET judul_buku = '$judul_buku', pengarang_buku = '$pengarang_buku',
isbn = '$isbn', penerjemah_buku = '$penerjemah_buku', penyunting_buku ='$penyunting_buku', 
penerbit = '$penerbit_buku', kota_terbit = '$kota_penerbit', tahun_terbit ='$tahun_terbit',
harga_sewa = '$harga_sewa', abstraksi = '$abstraksi', harga_denda = '$harga_denda', 
jumlah_buku = '$jumlah_buku', file_buku = '$namaDoang' WHERE id=$nomor_id";


$sqlinsert = "INSERT INTO data_buku (id_buku, judul_buku, pengarang_buku, isbn, penerjemah_buku,
penyunting_buku, penerbit, kota_terbit, tahun_terbit, abstraksi, 
jumlah_buku, file_buku)
VALUES (null, '$judul_buku', '$pengarang_buku', '$isbn', '$penerjemah_buku','$penyunting_buku', 
'$penerbit_buku', '$kota_penerbit', '$tahun_terbit', '$abstraksi',  
'$jumlah_buku', '$namaDoang')";

echo '<br/>'.$sqlinsert;

if ($nomor_id == ""){
	$sql=$sqlinsert;
} else {
	$sql=$sqlupdate;
}


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	session_start();
	$alamatDituju = "home.php?a=listbuku";
    include ('forwardfast.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>