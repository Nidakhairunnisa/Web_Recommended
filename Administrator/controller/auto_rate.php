<?php
include "database.php";


$sql = "SELECT * FROM pinjam_buku";
$result = $conn->query($sql);

$id_pinjam = array();
$nim = array();
$angka_acak = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$id_pinjam[] = $row['id_pinjam'];
		$nim[] = $row['nim'];
		$angka_acak[] = rand(1,5);
		
    }
} else {
    echo "0";
}

$jumlahdata = sizeof($nim);


for ($index= 0; $index<$jumlahdata; $index++){
	$id_pinjamSatuan = $id_pinjam[$index];
	$nimSatuan = $nim[$index];
	$angka_acakSatuan = $angka_acak[$index];
	
	include ("auto_rate2.php");

}
echo  "telah tersimpan " . $jumlahdata;


?>