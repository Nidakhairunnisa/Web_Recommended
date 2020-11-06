

<?php
include "controller/database.php";

 $sql = "SELECT * FROM `data_buku` WHERE id = $nomor_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$judul_buku = $row['judul_buku'];
		$pengarang_buku = $row['pengarang_buku'];
		$isbn = $row['isbn'];
		$penerjemah_buku = $row['penerjemah_buku'];
		$penyunting_buku = $row['penyunting_buku'];
		$penerbit_buku = $row['penerbit_buku'];
		$kota_penerbit = $row['kota_penerbit'];
		$tahun_terbit = $row['tahun_terbit'];
		$harga_sewa = $row['harga_sewa'];
		$abstraksi = $row['abstraksi'];
		$harga_denda = $row['harga_denda'];
		$jumlah_buku = $row['jumlah_buku'];
		$file_buku = $row['file_buku'];
    }
} else {
    echo "0 results";
}
$conn->close();

?>
